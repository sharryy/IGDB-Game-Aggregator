<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewGameTest extends TestCase
{
    public function the_game_page_shows_correct_info_test()
    {
        \Http::fake([
            'https://api.igdb.com/v4/games' => \Http::response(['foo' => 'bar'], 200),
        ]);
        $response = $this->get(route('games.show', 'animal-crossing-new-horizon'));
        $response->assertSuccessful();
    }
}
