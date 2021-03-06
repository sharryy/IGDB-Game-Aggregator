<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Str;

class GameController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $games = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, slug,
                involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*, videos.*,
                screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating, similar_games.platforms.abbreviation,
                similar_games.slug;
                where slug=\"{$slug}\";
            ", "text/plain")
            ->post('https://api.igdb.com/v4/games')
            ->json();

        abort_if(!$games, 404);

        return view('show', [
            'games' => $this->formatGameForView($games[0])
        ]);
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

    private function formatGameForView($game)
    {
        return collect($game)->merge([
            'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : 'https://via.placeholder.com/264x352',
            'genres' => isset($game['genres']) ? collect($game['genres'])->pluck('name')->implode(', ') : null,
            'involvedCompanies' => isset($game['involvedCompanies']) ? $game['involved_companies'][0]['company']['name'] : null,
            'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->implode(', ') : null,
            'memberRating' => array_key_exists('rating', $game) ? round($game['rating']) : '0',
            'criticRating' => array_key_exists('aggregated_rating', $game) ? round($game['aggregated_rating']) : '0',
            'trailerLink' => isset($game['videos']) ? 'https://www.youtube.com/embed/' . $game['videos'][0]['video_id'] : null,
            'screenshots' => isset($game['screenshots']) ? collect($game['screenshots'])->map(function ($screenshot) {
                return [
                    'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                    'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                ];
            })->take(9) : null,
            'similarGames' => isset($game['similarGames']) ? collect($game['similar_games'])->map(function ($game) {
                return collect($game)->merge([
                    'coverImageUrl' => array_key_exists('cover', $game)
                        ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : 'https://via.placeholder.com/264x352',
                    'rating' => isset($game['rating']) ? round($game['rating']) : null,
                    'platforms' => array_key_exists('platforms', $game)
                        ? collect($game['platforms'])->pluck('abbreviation')->implode(', ') : null,
                ]);
            })->take(6) : null,
            'social' => [
                'website' => isset($game['websites']) ? collect($game['websites'])->first() : null,
                'facebook' => isset($game['websites']) ? collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first() : null,
                'twitter' => isset($game['websites']) ? collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first() : null,
                'instagram' => isset($game['websites']) ? collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first() : null,
            ]
        ]);
    }
}
