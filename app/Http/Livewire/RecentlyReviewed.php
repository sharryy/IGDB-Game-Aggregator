<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewedGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->recentlyReviewed = \Cache::remember('recently-reviewed', 15, function () use ($before, $current) {
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
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
