<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search;
    public $search_results = [];

    public function render()
    {
        if (strlen($this->search) > 2) {
            $this->search_results = Http::withHeaders(config('services.igdb'))
                ->withBody("
                search \"{$this->search}\";
                fields name, slug, cover.url;
                limit 6;
            ", "text/plain")
                ->post('https://api.igdb.com/v4/games')
                ->json();
        }

        return view('livewire.search-dropdown');
    }
}
