<x-layout>
    @section('title','All Posts')
    @section('heading')
    @auth
    {{ Auth::user()->name }}
    @endauth
    @endsection
    <a href="{{ route('admin.create') }}">Create</a> <br> <br>
    @forelse ($tags as $tag )
       {{-- <a href="{{ route('posts.show', $post) }}"><p>{{ $tag->name }}</p></a> --}}
       <p>{{ $tag->name }}</p>
        <form method="POST" action="{{ route('admin.destroy', $tag) }}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>

    @empty
        No Tag available yet!
    @endforelse

</x-layout>