<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingSoon extends Component
{
    public $comingSoon = [];

    public function loadComingSoonGames()
    {
        $current = Carbon::now()->timestamp;
        $after = Carbon::now()->addDay(10)->timestamp;

        $this->comingSoon = Cache::remember('coming-soon', 60, function () use ($after, $current) {
            return Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . \cache('token')
            ])
                ->withBody("
                fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary;
            where
            platforms = (6,48,49,167,169,130)
            & first_release_date > {$current}
            & first_release_date < {$after};
            sort first_release_date asc;
            limit 4;"
                    , 'text/plain')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
