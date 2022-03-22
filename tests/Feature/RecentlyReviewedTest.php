<?php

use App\Http\Livewire\RecentlyReviewed;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class RecentlyReviewedTest extends TestCase
{
    public function test_the_main_page_shows_popular_games()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => $this->fakeRecentlyReviewed()
        ]);

        Livewire::test(RecentlyReviewed::class)
            ->assertSet('recentlyReviewed', [])
            ->call('loadRecentlyReviewedGames')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_big/co3ofx.jpg')
            ->assertSee('PC, XONE, Series X')
            ->assertSee('halo-infinite')
            ->assertSee('he Halo ring')
            ->assertSee('forza-horizon-5')
            ->assertSee('greatest cars.')
            ->assertSee('Forza Horizon 5');
    }

    private function fakeRecentlyReviewed(): PromiseInterface
    {
        return Http::response([
            0 => [
                "id" => 103281,
                "cover" => [
                    "id" => 111228,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co2dto.jpg"
                ],
                "name" => "Halo Infinite",
                "platforms" => [
                    0 => [
                        "id" => 6,
                        "abbreviation" => "PC"
                    ],
                    1 => [
                        "id" => 49,
                        "abbreviation" => "XONE"
                    ],
                    2 => [
                        "id" => 169,
                        "abbreviation" => "Series X"
                    ]
                ],
                "rating" => 85.374538875029,
                "slug" => "halo-infinite",
                "summary" => "he Halo ring."
            ],
            1 => [
                "id" => 141503,
                "cover" => [
                    "id" => 171645,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co3ofx.jpg"
                ],
                "name" => "Forza Horizon 5",
                "platforms" => [
                    0 => [
                        "id" => 6,
                        "abbreviation" => "PC"
                    ],
                    1 => [
                        "id" => 49,
                        "abbreviation" => "XONE"
                    ],
                    2 => [
                        "id" => 169,
                        "abbreviation" => "Series X"
                    ]
                ],
                "rating" => 85.946367143657,
                "slug" => "forza-horizon-5",
                "summary" => "greatest cars."
            ]
        ], 200);
    }
}
