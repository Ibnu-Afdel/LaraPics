<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'LaraPic')</title>
</head>
<body class="bg-slate-800">
    <nav class="flex justify-between items-center p-4">
        <div class="text-white text-2xl font-bold">
           <a href="{{ route('posts.index') }}"> LaraPic</a>
        </div>
        <div>
            @guest
                <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a>
                <a href="{{ route('login') }}" class="ml-4 text-white hover:text-gray-300">Login</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-white text-3xl font-bold">@yield('heading')</h1>
        <hr class="my-4 border-gray-600">
        {{ $slot }}
    </div>
</body>
</html>
