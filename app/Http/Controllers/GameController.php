<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $games = \Cache::remember('popular-games', 15, function () use ($slug) {
            return Http::withHeaders(config('services.igdb'))
                ->withBody("
                fields *;
                where slug=\"{$slug}\";
            ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

        abort_if(!$games, 404);

        return view('show', [
            'games' => $games[0]
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
}
