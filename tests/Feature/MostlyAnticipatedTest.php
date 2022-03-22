<?php

use App\Http\Livewire\MostAnticipated;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class MostlyAnticipatedTest extends TestCase
{
    public function test_the_main_page_shows_popular_games()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => $this->fakeMostlyAnticipated()
        ]);

        Livewire::test(MostAnticipated::class)
            ->assertSet('mostAnticipated', [])
            ->call('loadMostAnticipatedGames')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_big/co4ibh.jpg')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_big/co4jni.jpg')
            ->assertSee('Aperture Desk Job')
            ->assertSee('aperture-desk-job')
            ->assertSee('Elden Ring')
            ->assertSee('elden-ring');
    }

    private function fakeMostlyAnticipated(): PromiseInterface
    {
        return Http::response([
            0 => [
                "id" => 191897,
                "cover" => [
                    "id" => 210365,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co4ibh.jpg"
                ],
                "first_release_date" => 1646092800,
                "name" => "Aperture Desk Job",
                "slug" => "aperture-desk-job"
            ],
            1 => [
                "id" => 119133,
                "cover" => [
                    "id" => 212094,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co4jni.jpg"
                ],
                "first_release_date" => 1645747200,
                "name" => "Elden Ring",
                "slug" => "elden-ring"
            ]
        ], 200);
    }
}
