<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Video Games</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
<header class="border-b border-gray-800">
    <nav class="container mx-auto flex items-center justify-between px-4 py-6">
        <div class="flex items-center">
            <a href="/">
                <img src="/img/icons8-epic-games.svg" alt="" class="w-20 flex-none">
            </a>
            <ul class="flex ml-16 space-x-8">
                <li><a href="#" class="hover:text-gray-400">Games</a></li>
                <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
            </ul>
        </div>
        <div class="flex items-center">
            <div class="relative">
                <input type="text"
                       class="bg-gray-800 text-sm rounded-full px-3 py-1 w-64 focus:outline-none focus:shadow-outline pl-8"
                       placeholder="Search...">
                <div class="absolute top-0 flex items-center h-full ml-2">
                    <img src="/img/icons8-search.svg" class="fill-current text-gray-400 w-4">
                </div>
            </div>
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
</body>
</html>
