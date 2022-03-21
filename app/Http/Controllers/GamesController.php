<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    public function index()
    {
        Cache::remember('token', 5000000, function () {
            $response = Http::post('https://id.twitch.tv/oauth2/token', [
                'client_id' => config('services.igdb.client_id'),
                'client_secret' => config('services.igdb.client_secret'),
                'grant_type' => 'client_credentials'
            ])->json();
            return $response['access_token'];
        });

        return view('index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $game = Http::withHeaders([
            'Client-ID' => config('services.igdb.client_id'),
            'Authorization' => 'Bearer ' . cache('token')
        ])->withBody("
            fields name, cover.url, first_release_date, platforms.abbreviation, rating,
             slug, involved_companies.company.name, genres.name, aggregated_rating, summary,
              websites.*, videos.*, screenshots.*, similar_games.rating, similar_games.cover.url,
               similar_games.name, similar_games.rating, similar_games.platforms.abbreviation, similar_games.slug;
            where slug=\"{$slug}\";
            "
            , 'text/plain')
            ->post('https://api.igdb.com/v4/games')
            ->json();
        abort_if(!$game, 404);

        return view('show', [
            'game' => $game[0]
        ]);
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
