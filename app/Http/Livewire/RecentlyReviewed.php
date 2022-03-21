<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewedGames()
    {
        $before = Carbon::now()->subMonth(6)->timestamp;

        $unformattedGames = Cache::remember('recently-reviewed', 60, function () use ($before) {
            return Http::withHeaders([
                'Client-ID' => config('services.igdb.client_id'),
                'Authorization' => 'Bearer ' . \cache('token')
            ])->withBody("
            fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary, slug;
            where rating > 75
            & platforms = (6,48,49,167,169,130)
            & first_release_date > {$before}
            & rating_count > 5;
            sort rating_count desc;
            limit 3;
            ", 'text/plain')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });

        $this->recentlyReviewed = $this->formatForView($unformattedGames);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating' => isset($game['rating']) ? round($game['rating']) . '%' : '0%',
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', ')
            ]);
        });
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
