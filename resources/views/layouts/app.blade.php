<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Video Games</title>
    <link href="/css/app.css" rel="stylesheet">
    <livewire:styles/>
</head>
<body class="bg-gray-900 text-white">
<header class="border-b border-gray-800">
    <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
        <div class="flex items-center flex-col lg:flex-row">
            <a href="/">
                <img src="/img/icons8-epic-games.svg" alt="" class="w-20 flex-none">
            </a>
            <ul class="flex ml-0 lg:ml-16 space-x-8 mt-6 lg:mt-0">
                <li><a href="#" class="hover:text-gray-400">Games</a></li>
                <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
            </ul>
        </div>
        <div class="flex items-center mt-6 lg:mt-0">
            <livewire:search-drop-down/>
            <div class="ml-6">
                <a href="#">
                    <img src="/img/icons8-gamer-64.png" alt="avatar" class="rounded-full w-8">
                </a>
            </div>
        </div>
    </nav>
</header>
<main class="py-8">
    @yield('content')
</main>
<footer class="border-t border-gray-800">
    <div class="container mx-auto px-4 py-6">
        Powered By <a href="https://telegram.org/hossein9697" class="underline hover:text-gray-400">Hossein
            Heyatzadeh</a>
    </div>
</footer>
<livewire:scripts/>
<script src="/js/app.js"></script>
<script src="/js/cdn.js"></script>
@stack('scripts')
</body>
</html>
