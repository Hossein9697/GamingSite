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
                    <br>
                    <span>
                        {{ $game['involvedCompanies'] }}
                    </span>
                    <br>
                    <span>
                        {{ $game['platforms'] }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div id="memberRating" class="w-16 h-16 bg-gray-800 rounded-full relative text-sm">
                            @push('scripts')
                                @include('_rating', ['slug' => 'memberRating', 'rating' => $game['memberRating'], 'event' => null])
                            @endpush
                        </div>
                        <div class="ml-4 text-xs">
                            Member <br> Score
                        </div>
                    </div>
                    <div class="flex items-center ml-12">
                        <div id="criticRating" class="w-16 h-16 bg-gray-800 rounded-full relative text-sm">
                            @push('scripts')
                                @include('_rating', ['slug' => 'criticRating', 'rating' => $game['criticRating'], 'event' => null])
                            @endpush
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
                <div class="mt-12" x-data="{ isTrailerVisible: false }">
                    <button
                        @click="isTrailerVisible=true"
                        class="flex bg-blue-500 text-white font-semibold px-4 py-4
                                             hover:bg-blue-600 rounded transition ease-in-out duration-150">
                        <img src="/img/icons8-play-30.png" class="w-6 fill-current">
                        <span class="ml-2">Play Trailer</span>
                    </button>
                    <template x-if="isTrailerVisible">
                        <div
                            style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            class="text-3xl leading-none hover:text-gray-300 mb-3"
                                            @click="isTrailerVisible=false"
                                            @keydown.escape.window="isTrailerVisible=false"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                    <div class="overflow-hidden relative"
                                         style="padding-top: 56.25%"
                                    >
                                        <iframe
                                            class="absolute top-0 left-0 w-full h-full"
                                            width="560"
                                            height="315"
                                            src="{{ $game['trailer'] }}"
                                            allow="autoplay; encrypted-media"
                                            allowfullscreen
                                        >
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div
            class="images-container border-b border-gray-800 pb-12 mt-8"
            x-data="{ isImgModalVisible: false, img: ''}"
        >
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12 lg:mt-0">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mt-8">
                @foreach($game['screenshots'] as $screenshot)
                    <div>
                        <a
                            href="#"
                            @click.prevent="
                                isImgModalVisible = true;
                                img = '{{ $screenshot['huge'] }}';
                            "
                        >
                            <img src="{{ $screenshot['big'] }}"
                                 alt="screenShot"
                                 class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>
            <template x-if="isImgModalVisible">
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    class="text-3xl leading-none hover:text-gray-300 mb-3"
                                    @click="isImgModalVisible=false"
                                    @keydown.escape.window="isImgModalVisible=false"
                                >
                                    &times;
                                </button>
                            </div>
                            <div class="px-8 py-8">
                                <img :src="img" alt="screenshot">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="similar-games-container mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12 lg:mt-0">Similar Games</h2>
            <div
                class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12">
                @foreach($game['similar_games'] as $game)
                    <x-game-card :game="$game"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
