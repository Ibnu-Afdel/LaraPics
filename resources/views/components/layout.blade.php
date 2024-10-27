{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <title>@yield('title', 'LaraPic')</title>--}}
{{--    @livewireStyles--}}
{{--</head>--}}
{{--<body class="bg-slate-800">--}}
{{--    <nav class="flex justify-between items-center p-4">--}}
{{--        <div class="text-white text-2xl font-bold">--}}
{{--           <a href="{{ route('posts.index') }}"> LaraPic</a>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            @guest--}}
{{--                <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a>--}}
{{--                <a href="{{ route('login') }}" class="ml-4 text-white hover:text-gray-300">Login</a>--}}
{{--            @endguest--}}
{{--            @auth--}}
{{--                <form method="POST" action="{{ route('logout') }}" class="inline">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="text-white hover:text-gray-300">Logout</button>--}}
{{--                </form>--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--    <div class="container mx-auto px-4 py-6">--}}
{{--        <h1 class="text-white text-3xl font-bold">@yield('heading')</h1>--}}
{{--        <hr class="my-4 border-gray-600">--}}
{{--        {{ $slot }}--}}
{{--    </div>--}}
{{--    @livewireScripts--}}
{{--</body>--}}
{{--</html>--}}












    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'LaraPic')</title>
    @livewireStyles
</head>
<body class="bg-slate-900 text-gray-200 font-sans">

<!-- Navigation Bar -->
<nav class="bg-slate-800 shadow-lg">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('posts.index') }}" class="text-3xl font-bold text-white hover:text-indigo-400 transition">
            LaraPic
        </a>

        <!-- Navigation Links -->
        <div class="flex space-x-6">
            @guest
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-indigo-400 transition">Register</a>
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-indigo-400 transition">Login</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-red-400 transition">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<!-- Main Content Area -->
<div class="container mx-auto px-6 py-8">
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-4xl font-extrabold text-indigo-200">@yield('heading')</h1>
        <hr class="flex-grow ml-4 border-t border-gray-700">
    </div>


    <!-- Page Content -->
    <main class="bg-slate-800 p-6 rounded-lg shadow-md">
        {{ $slot }}
    </main>
</div>

@livewireScripts
</body>
</html>
