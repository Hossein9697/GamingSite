<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropDown extends Component
{
    public $search = '';
    public $searchResults = [];

    public function render()
    {
        if ($this->search > 2) {
            $this->searchResults = Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . cache('token')
            ])->withBody("
            fields name, slug, cover.url;
             search \"{$this->search}\";
             where
            platforms = (6,48,49,167,169,130)
            & total_rating_count > 1;
             limit 9;
            "
                , 'text/plain')
                ->post('https://api.igdb.com/v4/games/')
                ->json();
        }
        return view('livewire.search-drop-down');
    }
}
