<?php

use App\Http\Livewire\SearchDropDown;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function test_search_bar_works_correctly()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => $this->fakeSearchResultGames()
        ]);

        Livewire::test(SearchDropDown::class)
            ->assertDontSee('wwe')
            ->set('search', 'ww')
            ->assertDontSee('wwe')
            ->set('search', 'wwe')
            ->assertSee('WWE 2K19')
            ->assertSee('WWE 2K Battlegrounds')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_small/co2cvd.jpg')
            ->assertSee('wwe-2k-battlegrounds')
            ->assertSee('WWE Raw')
            ->assertSee('images.igdb.com/igdb/image/upload/t_cover_small/co1rx1.jpg')
            ->assertSee('wwe-2k19')
            ->set('search', 'ww')
            ->assertDontSee('wwe');
    }

    private function fakeSearchResultGames(): PromiseInterface
    {
        return Http::response([
            0 => [
                "id" => 132956,
                "cover" => [
                    "id" => 109993,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co2cvd.jpg"
                ],
                "name" => "WWE 2K Battlegrounds",
                "slug" => "wwe-2k-battlegrounds"
            ],
            1 => [
                "id" => 6252,
                "cover" => [
                    "id" => 82837,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co1rx1.jpg"
                ],
                "name" => "WWE Raw",
                "slug" => "wwe-raw"
            ],
            2 => [
                "id" => 102805,
                "cover" => [
                    "id" => 102981,
                    "url" => "//images.igdb.com/igdb/image/upload/t_thumb/co27gl.jpg"
                ],
                "name" => "WWE 2K19",
                "slug" => "wwe-2k19"
            ]
        ], 200);
    }
}
