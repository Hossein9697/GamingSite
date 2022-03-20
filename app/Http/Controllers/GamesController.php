<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    public function index()
    {
        $response = Http::post('https://id.twitch.tv/oauth2/token', [
            'client_id' => config('services.igdb.client_id'),
            'client_secret' => config('services.igdb.client_secret'),
            'grant_type' => 'client_credentials'
        ])->json();

        $before = Carbon::now()->subMonth(6)->timestamp;

        $games = Http::withHeaders([
            'Client-ID' => config('services.igdb.client_id'),
            'Authorization' => 'Bearer ' . $response['access_token']
        ])
            ->withBody("
                fields name, cover.url, first_release_date, platforms.abbreviation, rating;
            where rating > 75
            & platforms = (6,48,49,167,169,130)
            & first_release_date > {$before};
            sort rating desc;
            limit 12;"
                , 'text/plain')
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $recentlyReviewed = Http::withHeaders([
            'Client-ID' => config('services.igdb.client_id'),
            'Authorization' => 'Bearer ' . $response['access_token']
        ])
            ->withBody("
                fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary;
            where rating > 75
            & platforms = (6,48,49,167,169,130)
            & first_release_date > {$before}
            & rating_count > 5;
            sort rating_count desc;
            limit 3;"
                , 'text/plain')
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $mostAnticipated = Http::withHeaders([
            'Client-ID' => config('services.igdb.client_id'),
            'Authorization' => 'Bearer ' . $response['access_token']
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

        $comingSoon = Http::withHeaders([
            'Client-ID' => config('services.igdb.client_id'),
            'Authorization' => 'Bearer ' . $response['access_token']
        ])
            ->withBody("
                fields name, cover.url, first_release_date, platforms.abbreviation, rating, rating_count, summary;
            where
            platforms = (6,48,49,167,169,130)
            & first_release_date > {$before};
            sort first_release_date desc;
            limit 4;"
                , 'text/plain')
            ->post('https://api.igdb.com/v4/games')
            ->json();

        return view('index', compact('games', 'recentlyReviewed', 'mostAnticipated', 'comingSoon'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
