<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipatedGames()
    {
        $before = Carbon::now()->subMonth(1)->timestamp;

        $unformattedGames = Cache::remember('most-anticipated', 60, function () use ($before) {
            return Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . \cache('token')
            ])->withBody("
            fields name, slug, cover.url, first_release_date;
            where first_release_date > {$before}
            & aggregated_rating_count > 1;
            sort first_release_date desc;
            limit 4;
            ", 'text/plain')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

        $this->mostAnticipated = $this->formatForView($unformattedGames);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y'),
                'name' => Str::substr($game['name'], 0, 40)
            ]);
        });
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
