<x-layout>
    @section('title','Register')
    @section('heading', 'Register')
    
    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email"><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"><br>

        <button>Log In</button>
    </form>

</x-layout>