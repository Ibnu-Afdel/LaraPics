<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Wubet')</title>
</head>
<body>
    <nav>
        @guest
            <a href="{{ route('register') }}">Register</a><br>
            <a href="{{ route('login') }}">LogIn</a>
        @endguest
        @auth
            <form  method="POST" action="{{ route('logout') }}">
                @csrf
                @method('DELETE')
                <button>LogOut</button>
            </form>
        @endauth
    </nav>
    <h1>@yield('heading')</h1> <hr>
    {{ $slot }}
</body>
</html>