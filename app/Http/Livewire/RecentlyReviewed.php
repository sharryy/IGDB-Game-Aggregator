<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Str;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewedGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $recentlyReviewedUnformatted = \Cache::remember('recently-reviewed', 15, function () use ($before, $current) {
            return Http::withHeaders(config('services.igdb'))
                ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary, slug;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= $before
                & first_release_date < $current
                & rating_count > 5);
                limit 3;
            ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

        $this->recentlyReviewed = $this->formatView($recentlyReviewedUnformatted);

        collect($this->recentlyReviewed)->filter(function ($game) {
            return $game['rating'];
        })->each(function ($game) {
            $this->emit('gameWithRatingAdded', [
                'slug' => 'review_' . $game['slug'],
                'rating' => $game['rating'] / 100,
            ]);
        });
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }

    private function formatView($recentlyReviewedUnformatted)
    {
        return collect($recentlyReviewedUnformatted)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating' => isset($game['rating']) ? round($game['rating']) : null,
                'platform' => collect($game['platforms'])->pluck('abbreviation')->implode(', ')
            ]);
        })->toArray();
    }
}
