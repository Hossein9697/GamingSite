<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class ComingSoon extends Component
{
    public $comingSoon = [];

    public function loadComingSoonGames()
    {
        $current = Carbon::now()->timestamp;

        $unformattedGames = Cache::remember('coming-soon', 60, function () use ($current) {
            return Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . \cache('token')
            ])->withBody("
            fields name, slug, cover.url, first_release_date;
            where
            first_release_date > {$current};
            sort first_release_date asc;
            limit 4;
            ", 'text/plain')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
//        dd($unformattedGames);
        $this->comingSoon = $this->formatForView($unformattedGames);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y'),
                'name' => Str::substr($game['name'], '0', '40')
            ]);
        });
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
