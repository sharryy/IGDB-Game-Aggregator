<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $popularGames = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= {$before}
                & first_release_date < {$after});
                sort total_rating_count desc;
                limit 12;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $recentlyReviewed = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= {$before}
                & first_release_date < {$current}
                & rating_count > 5);
                limit 3;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $mostAnticipated = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= {$before}
                & first_release_date < {$afterFourMonths});
                limit 4;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $comingSoon = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary;
                where platforms = (48,49,130,6)
                & total_rating_count != null
                & (first_release_date >= {$current});
                sort first_release_date desc;
                limit 4;
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        return view('index', compact('popularGames', 'recentlyReviewed', 'mostAnticipated', 'comingSoon'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
