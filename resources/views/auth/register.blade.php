<x-layout>
    @section('title','Register')
    @section('heading', 'Register')
    
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name"><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email"><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"><br>

        <label for="password_confirmation">Confirm Password</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation"><br>

        <button>Register</button>
    </form>

</x-layout>