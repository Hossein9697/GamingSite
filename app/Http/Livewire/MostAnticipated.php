<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipatedGames()
    {
        $before = Carbon::now()->subMonth(6)->timestamp;

        $this->mostAnticipated = Cache::remember('most-anticipated', 60, function () use ($before) {
            return Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . \cache('token')
            ])
                ->withBody("
                fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary;
            where rating > 90
            & platforms = (6,48,49,167,169,130)
            & first_release_date > {$before}
            & rating_count > 5;
            sort rating_count desc;
            limit 4;"
                    , 'text/plain')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
