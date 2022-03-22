<?php

use App\Http\Livewire\ComingSoon;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ComingSoonTest extends TestCase
{
    public function test_the_main_page_shows_popular_games()
    {


        Http::fake([
            'https://api.igdb.com/v4/games' => $this->fakeComingSoon()
        ]);

        Livewire::test(ComingSoon::class)
            ->assertSet('comingSoon', [])
            ->call('loadComingSoonGames')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_big/co4g7c.jpg')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_big/co3hep.jpg')
            ->assertSee('Super Rolling Heroes')
            ->assertSee('super-rolling-heroes')
            ->assertSee('a-memoir-blue')
            ->assertSee('A Memoir Blue');
    }

    private function fakeComingSoon(): PromiseInterface
    {
        return Http::response([
            0 => [
                "id" => 190880,
                "cover" => [
                    "id" => 207624,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co4g7c.jpg"
                ],
                "first_release_date" => 1647993600,
                "name" => "Super Rolling Heroes",
                "slug" => "super-rolling-heroes"
            ],
            1 => [
                "id" => 106856,
                "cover" => [
                    "id" => 162529,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co3hep.jpg"
                ],
                "first_release_date" => 1648080000,
                "name" => "A Memoir Blue",
                "slug" => "a-memoir-blue"
            ]
        ], 200);
    }
}
