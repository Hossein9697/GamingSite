@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="game-details border-b border-gray-800 pb-12 flex">
            <div class="flex-none">
                <img src="/img/WWE_2K22_cover.jpg" alt="game cover">
            </div>
            <div class="ml-12 mr-64">
                <h2 class="font-semibold text-4xl">WWE 2K22</h2>
                <div class="text-gray-400">
                    <span>Action, Fighting</span>
                    &middot;
                    <span>Square Enix</span>
                    &middot;
                    <span>Playstation 5</span>
                </div>
                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                80%
                            </div>
                        </div>
                        <div class="ml-4 text-xs">
                            Member <br> Score
                        </div>
                    </div>
                    <div class="flex items-center ml-12">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                96%
                            </div>
                        </div>
                        <div class="ml-4 text-xs">
                            Critic <br> Score
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 ml-12">
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                <img src="/img/icons8-world-32.png" class="w-5 h-5 fill-current">
                            </a>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                <img src="/img/icons8-world-32.png" class="w-5 h-5 fill-current">
                            </a>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                <img src="/img/icons8-world-32.png" class="w-5 h-5 fill-current">
                            </a>
                        </div>
                        <div class="w-8 h-8 bg-gray-800 rounded-full flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                <img src="/img/icons8-world-32.png" class="w-5 h-5 fill-current">
                            </a>
                        </div>
                    </div>
                </div>
                <p class="mt-12">
                    WWE 2K22 is a professional wrestling video game developed by Visual Concepts and published by 2K
                    Sports. It is the twenty-second overall installment of the video game series based on WWE, the ninth
                    game under the WWE 2K banner, and the successor to 2019's WWE 2K20.
                </p>
                <div class="mt-12">
                    <button
                        class="flex bg-blue-500 text-white font-semibold px-4 py-4
                         hover:bg-blue-600 rounded transition ease-in-out duration-150">
                        <img src="/img/icons8-play-30.png" class="w-6 fill-current">
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>
            </div>
        </div>
        <! --end Game Details
        <div class="images-container border-b border-gray-800 pb-12 mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12 lg:mt-0">Images</h2>
            <div class="grid grid-cols-3 gap-12 mt-8">
                <div>
                    <a href="#">
                        <img src="/img/screenshot01.jpg" alt="screenShot"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="/img/screenshot02.jpg" alt="screenShot"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="/img/screenshot03.jpg" alt="screenShot"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="/img/screenshot04.jpg" alt="screenShot"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="/img/screenshot05.jpg" alt="screenShot"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <img src="/img/screenshot06.jpg" alt="screenShot"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
            </div>
            <! --end images container
        </div>
        <div class="similar-games-container mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12 lg:mt-0">Similar Games</h2>
            <div
                class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12" {{$temp = 6}}>
                @while($temp)
                    <div class="game mt-8 ">
                        <div class="relative inline-block">
                            <a href="#">
                                <img src="/img/WWE_2K22_cover.jpg" alt="game cover"
                                     class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                                 style="right: -20px; bottom: -20px">
                                <div class="font-semibold text-xs flex justify-center items-center h-full">
                                    80%
                                </div>
                            </div>
                        </div>
                        <a class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                            WWE 2K22
                        </a>
                        <div class="text-gray-400 mt-1">PC</div>
                    </div {{$temp--}}>
                @endwhile
            </div>
        </div>
        <! --end of similar games
    </div>
@endsection
