<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    public function __construct()
    {
        Cache::remember('token', 5000000, function () {
            $response = Http::post('https://id.twitch.tv/oauth2/token', [
                'client_id' => config('services.igdb.client_id'),
                'client_secret' => config('services.igdb.client_secret'),
                'grant_type' => 'client_credentials'
            ])->json();
            return $response['access_token'];
        });
    }

    public function index()
    {
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
        $games = Http::withHeaders([
            'Client-ID' => config('services.igdb.client_id'),
            'Authorization' => 'Bearer ' . cache('token')
        ])->withBody("
            fields name, cover.url, first_release_date, platforms.abbreviation, rating,
             slug, involved_companies.company.name, genres.name, aggregated_rating, summary,
              websites.*, videos.*, screenshots.*, similar_games.rating, similar_games.cover.url,
               similar_games.name, similar_games.rating, similar_games.platforms.abbreviation, similar_games.slug;
            where slug=\"{$slug}\";
            ", 'text/plain')
            ->post('https://api.igdb.com/v4/games')
            ->json();
        abort_if(!$games, 404);

        return view('show', [
            'game' => $this->formatForView($games[0])
        ]);
    }

    private function formatForView($game)
    {
        return collect($game)->merge([
            'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
            'genres' => collect($game['genres'])->pluck('name')->implode(', '),
            'involvedCompanies' => isset($game['involved_companies']) ? collect($game['involved_companies'])->pluck('company')->pluck('name')->implode(', ') : 'Unknown Companies',
            'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
            'memberRating' => isset($game['rating']) ? round($game['rating']) : 0,
            'criticRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']) : 0,
            'trailer' => isset($game['videos']) ? 'https://youtube.com/embed/' . $game['videos'][0]['video_id'] : '',
            'screenshots' => isset($game['screenshots']) ? collect($game['screenshots'])->map(function ($screenshot) {
                return [
                    'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                    'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url'])
                ];
            })->take(9) : null,
            'similar_games' => collect($game['similar_games'])->map(function ($similarGame) {
                return collect($similarGame)->merge([
                    'coverImageUrl' => isset($similarGame['cover']) ? Str::replaceFirst('thumb', 'cover_big', $similarGame['cover']['url']) : '',
                    'rating' => isset($similarGame['rating']) ? round($similarGame['rating']) : 0,
                    'platforms' => isset($similarGame['platforms']) ? collect($similarGame['platforms'])->pluck('abbreviation')->implode(', ') : 'Unknown Platform'
                ]);
            })->take(6),
            'social' => [
                'website' => collect($game['websites'])->first(),
                'facebook' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first(),
                'twitter' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first(),
                'instagram' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first(),
            ]
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
