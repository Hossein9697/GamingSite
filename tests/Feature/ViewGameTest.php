<?php

namespace Tests\Feature;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewGameTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_game_page_shows_correct_game_info()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => $this->fakeSingleGame()
        ]);
        $response = $this->get(route('games.show', 'fake-game'));
        $response->assertSuccessful();
        $response->assertSee('Shooter');
        $response->assertSee('Skybox Labs');
        $response->assertSee('Halo Infinite');
        $response->assertSee('PC');
        $response->assertSee('Rogue Warrior');
        $response->assertSee('fake Summary');
        $response->assertSee('88');
        $response->assertSee('85');
        $response->assertsee('images.igdb.com/igdb/image/upload/t_cover_big/co2dto.jpg');
        $response->assertSee('images.igdb.com/igdb/image/upload/t_screenshot_big/tlwczv6q5r6o4uuryxgt.jpg');
        $response->assertSee('images.igdb.com/igdb/image/upload/t_screenshot_huge/tlwczv6q5r6o4uuryxgt.jpg');
        $response->assertSee('https://www.facebook.com/Halo');
    }

    public function fakeSingleGame(): PromiseInterface
    {
        return Http::response([
                0 => [
                    "id" => 103281,
                    "aggregated_rating" => 87.888888888889,
                    "cover" => [
                        "id" => 111228,
                        "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co2dto.jpg"
                    ],
                    "first_release_date" => 1636934400,
                    "genres" => [
                        0 => [
                            "id" => 5,
                            "name" => "Shooter"
                        ],
                    ],
                    "involved_companies" => [
                        0 => [
                            "id" => 104506,
                            "company" => [
                                "id" => 4355,
                                "name" => "Skybox Labs"
                            ]
                        ]
                    ],
                    "name" => "Halo Infinite",
                    "platforms" => [
                        0 => [
                            "id" => 6,
                            "abbreviation" => "PC"
                        ]
                    ],
                    "rating" => 85.374538875029,
                    "screenshots" => [
                        0 => [
                            "id" => 214074,
                            "game" => 103281,
                            "height" => 1080,
                            "image_id" => "tlwczv6q5r6o4uuryxgt",
                            "url" => "//images.igdb.com/igdb/image/upload/t_thumb/tlwczv6q5r6o4uuryxgt.jpg",
                            "width" => 1920,
                            "checksum" => "5fee107d-30e8-3000-d415-2efe7169dcca"
                        ]
                    ],
                    "similar_games" => [
                        0 => [
                            "id" => 564,
                            "cover" => [
                                "id" => 82229,
                                "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co1rg5.jpg"
                            ],
                            "name" => "Rogue Warrior",
                            "platforms" => [
                                0 => [
                                    "id" => 6,
                                    "abbreviation" => "PS4"
                                ]
                            ],
                            "rating" => 48.176039393005,
                            "slug" => "rogue-warrior"
                        ],
                    ],
                    "slug" => "fake-game",
                    "summary" => "fake Summary",
                    "videos" => [
                        0 => [
                            "id" => 27858,
                            "game" => 103281,
                            "name" => "Trailer",
                            "video_id" => "ZtgzKBrU1GY",
                            "checksum" => "b5a4701a-cfcd-b1da-a76c-c3500270b797"
                        ]
                    ],
                    "websites" => [
                        0 => [
                            "id" => 80091,
                            "category" => 4,
                            "game" => 103281,
                            "trusted" => true,
                            "url" => "https://www.facebook.com/Halo",
                            "checksum" => "91664c9b-9737-c60a-ea14-9ad71b093ecb"
                        ]
                    ]
                ]
            ]
            , 200);
    }
}
