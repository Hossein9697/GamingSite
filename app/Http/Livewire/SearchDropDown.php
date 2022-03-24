<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchDropDown extends Component
{
    public $search = '';
    public $searchResults = [];

    public function render()
    {
        if (strlen($this->search) > 2) {
            $unformattedGames = Http::withHeaders([
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
                ->post('https://api.igdb.com/v4/games')
                ->json();

            $this->searchResults = $this->formatQuery($unformattedGames);
        }
        return view('livewire.search-drop-down');
    }

    private function formatQuery($unformattedGames)
    {
        return collect($unformattedGames)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_small', $game['cover']['url'])
            ]);
        });
    }
}
