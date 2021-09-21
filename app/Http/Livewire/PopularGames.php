<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Str;

class PopularGames extends Component
{
    public $popularGames = [];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $popularGamesUnformatted = \Cache::remember('popular-games', 15, function () use ($before, $after) {
            return Http::withHeaders(config('services.igdb'))
                ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, slug;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= $before
                & first_release_date < $after);
                sort total_rating_count desc;
                limit 12;
            ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

        $this->popularGames = $this->formatView($popularGamesUnformatted);
    }

    public function render()
    {
        return view('livewire.popular-games');
    }

    private function formatView($popularGamesUnformatted)
    {
        return collect($popularGamesUnformatted)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating' => isset($game['rating']) ? round($game['rating']) . '%' : null,
                'platform' => collect($game['platforms'])->pluck('abbreviation')->implode(', ')
            ]);
        })->toArray();
    }
}
