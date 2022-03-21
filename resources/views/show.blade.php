@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="game-details border-b border-gray-800 pb-12 flex flex-col lg:flex-row">
            <div class="flex-none">
                <img src="{{ $game['coverImageUrl'] }}"
                     alt="game cover">
            </div>
            <div class="lg:ml-12 lg:mr-64">
                <h2 class="font-semibold text-4xl leading-tight mt-1">{{ $game['name'] }}</h2>
                <div class="text-gray-400">
                    <span>
                        {{ $game['genres'] }}
                    </span>
                    &middot;
                    <span>
                        {{ $game['involvedCompanies'] }}
                    </span>
                    &middot;
                    <span>
                        {{ $game['platforms'] }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                {{ $game['memberRating'] }}
                            </div>
                        </div>
                        <div class="ml-4 text-xs">
                            Member <br> Score
                        </div>
                    </div>
                    <div class="flex items-center ml-12">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                {{ $game['criticRating'] }}
                            </div>
                        </div>
                        <div class="ml-4 text-xs">
                            Critic <br> Score
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 lg:ml-12 mt-4 lg:mt-0">
                        @if($game['social']['website'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['website']['url'] }}" class="hover:text-gray-400">
                                    <img src="/img/icons8-world-64.png" class="w-5 h-5 fill-current">
                                </a>
                            </div>
                        @endif
                        @if($game['social']['facebook'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['facebook']['url'] }}" class="hover:text-gray-400">
                                    <img src="/img/icons8-facebook-30.png" class="w-5 h-5 fill-current">
                                </a>
                            </div>
                        @endif
                        @if($game['social']['twitter'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['twitter']['url'] }}" class="hover:text-gray-400">
                                    <img src="/img/icons8-twitter-30.png" class="w-5 h-5 fill-current">
                                </a>
                            </div>
                        @endif
                        @if($game['social']['instagram'])
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['instagram']['url'] }}" class="hover:text-gray-400">
                                    <img src="/img/icons8-instagram-30.png" class="w-5 h-5 fill-current">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <p class="mt-12">
                    {{ $game['summary'] }}
                </p>
                <div class="mt-12">
                    {{--                    <button--}}
                    {{--                        class="flex bg-blue-500 text-white font-semibold px-4 py-4--}}
                    {{--                         hover:bg-blue-600 rounded transition ease-in-out duration-150">--}}
                    {{--                        <img src="/img/icons8-play-30.png" class="w-6 fill-current">--}}
                    {{--                        <span class="ml-2">Play Trailer</span>--}}
                    {{--                    </button>--}}
                    <a href="{{ $game['trailer'] }}" target="_blank"
                       class="flex bg-blue-500 text-white font-semibold px-4 py-4
                         hover:bg-blue-600 rounded transition ease-in-out duration-150 inline-flex">
                        <img src="/img/icons8-play-30.png" class="w-6 fill-current">
                        <span class="ml-2">Play Trailer</span>
                    </a>
                </div>
            </div>
        </div>
        <! --end Game Details
        <div class="images-container border-b border-gray-800 pb-12 mt-46">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12 lg:mt-0">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mt-8">
                @foreach($game['screenshots'] as $screenshot)
                    <div>
                        <a target="_blank"
                           href="{{ $screenshot['huge'] }}">
                            <img src="{{ $screenshot['big'] }}"
                                 alt="screenShot"
                                 class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
            <! --end images container
        </div>
        <div class="similar-games-container mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12 lg:mt-0">Similar Games</h2>
            <div
                class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12">
                @foreach($game['similar_games'] as $similarGame)
                    <div class="game mt-8 ">
                        <div class="relative inline-block">
                            <a href="{{ route('games.show', $similarGame['slug']) }}">
                                <img src="{{ $similarGame['coverImageUrl'] }}"
                                     alt="game cover"
                                     class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            @if($similarGame['rating'])
                                <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                                     style="right: -20px; bottom: -20px">
                                    <div class="font-semibold text-xs flex justify-center items-center h-full">
                                        {{ $similarGame['rating'] }}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('games.show', $similarGame['slug']) }}"
                           class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                            {{ $similarGame['name'] }}
                        </a>
                        <div class="text-gray-400 mt-1">
                            {{ $similarGame['platforms'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <! --end of similar games
    </div>
@endsection
