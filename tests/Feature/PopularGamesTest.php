<?php

use App\Http\Livewire\PopularGames;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class PopularGamesTest extends TestCase
{
    public function test_the_main_page_shows_popular_games()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => $this->fakePopularGames()
        ]);

        Livewire::test(PopularGames::class)
            ->assertSet('popularGames', [])
            ->call('loadPopularGames')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_big/co30hn.jpg')
            ->assertSee('Final Fantasy XIV: Endwalker')
            ->assertSee('PC, PS4')
            ->assertSee('final-fantasy-xiv-endwalker')
            ->assertSee('Animal Crossing: New Horizons');
    }

    private function fakePopularGames(): PromiseInterface
    {
        return Http::response([
            0 => [
                "id" => 143232,
                "cover" => [
                    "id" => 140603,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co30hn.jpg"
                ],
                "name" => "Final Fantasy XIV: Endwalker",
                "platforms" => [
                    0 => [
                        "id" => 6,
                        "abbreviation" => "PC"
                    ],
                    1 => [
                        "id" => 46,
                        "abbreviation" => "PS4"
                    ]
                ],
                "rating" => 99.908168392279,
                "slug" => "final-fantasy-xiv-endwalker"
            ],
            1 => [
                "id" => 176552,
                "cover" => [
                    "id" => 187002,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co40ai.jpg"
                ],
                "name" => "Animal Crossing: New Horizons - Happy Home Paradise",
                "platforms" => [
                    0 => [
                        "id" => 130,
                        "abbreviation" => "Switch"
                    ]
                ],
                "rating" => 98.587781492094,
                "slug" => "animal-crossing-new-horizons-happy-home-paradise"
            ]
        ], 200);
    }
}
