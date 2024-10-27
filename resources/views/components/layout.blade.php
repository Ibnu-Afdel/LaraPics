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


<nav class="bg-slate-800 shadow-lg">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <a href="{{ route('posts.index') }}" class="text-3xl font-bold text-white hover:text-indigo-400 transition">
            LaraPic
        </a>

        <div class="flex space-x-6">
            @guest
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-indigo-400 transition">Register</a>
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-indigo-400 transition">Login</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-300 hover:text-red-400 transition">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>


<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-4xl font-extrabold text-indigo-200">@yield('heading')</h1>
        <hr class="flex-grow ml-4 border-t border-gray-700">
    </div>


    <main class="bg-slate-800 p-6 rounded-lg shadow-md">
        {{ $slot }}
    </main>
</div>

@livewireScripts
</body>
</html>
