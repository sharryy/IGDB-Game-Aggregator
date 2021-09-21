<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Str;

class ComingSoon extends Component
{
    public $comingSoon = [];

    public function loadComingSoonGames()
    {
        $current = Carbon::now()->timestamp;

        $comingSoonUnformatted = \Cache::remember('coming-soon', 15, function () use ($current) {
            return $this->comingSoon = Http::withHeaders(config('services.igdb'))
                ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary, slug;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= $current);
                sort first_release_date desc;
                limit 4;
            ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

        $this->comingSoon = $this->formatForView($comingSoonUnformatted);
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }

    private function formatForView($comingSoonUnformatted)
    {
        return collect($comingSoonUnformatted)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y')
            ]);
        })->toArray();
    }
}
