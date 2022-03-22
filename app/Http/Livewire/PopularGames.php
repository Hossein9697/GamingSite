<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use function cache;

class PopularGames extends Component
{
    public $popularGames = [];

    public function loadPopularGames()
    {
        $before = Carbon::now()->subMonth(6)->timestamp;

        $unformattedGames = Cache::remember('popular-games', 60, function () use ($before) {
            return Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . cache('token')
            ])->withBody("
            fields name, slug, cover.url, platforms.abbreviation, rating;
            where
            platforms = (6,48,49,167,169,130)
            & total_rating_count > 1
            & first_release_date > {$before};
            sort total_rating_count desc;
            limit 12;
            "
                , 'text/plain')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
        $this->popularGames = $this->formatForView($unformattedGames);
        collect($this->popularGames)->filter(function ($game) {
            return $game['rating'];
        })->each(function ($game) {
            $this->emit('gameWithRatingAdded', [
                'slug' => $game['slug'],
                'rating' => $game['rating'] / 100
            ]);
        });
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating' => isset($game['rating']) ? round($game['rating']) : 0,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', ')
            ]);
        });
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}
