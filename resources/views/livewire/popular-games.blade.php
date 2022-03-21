<div wire:init="loadPopularGames"
     class="text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
    @forelse($popularGames as $game)
        <x-game-card :game="$game"/>
    @empty
        @foreach(range(1,12) as $game)
            <div class="mt-8">
                <div class="relative bg-gray-800 w-44 h-56"></div>
                <div class="block text-lg text-transparent bg-gray-800 w-44 mt-4 rounded leading-tight">Game Title</div>
                <div class="text-transparent bg-gray-800 rounded inline-block mt-3">Platform</div>
            </div>
        @endforeach
    @endforelse
</div>
