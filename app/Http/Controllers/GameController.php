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

        return view('index', compact('popularGames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
