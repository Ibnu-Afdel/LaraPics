<x-layout>
    @section('title','All Posts')
    @section('heading')
    @auth
    {{ Auth::user()->name }}
    @endauth
    @endsection
    <a href="{{ route('posts.create') }}">Create</a> <br> <br>
    @forelse ($posts as $post )
       <a href="{{ route('posts.show', $post) }}"><p>{{ $post->caption }}</p></a>
        @if ($post->image)
            <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}">
        @endif
       
        <div>
            @if($post->tags->isNotEmpty())
                <h5>Tags:</h5>
                <ul>
                    @foreach($post->tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>  


    @empty
        No post available yet!
    @endforelse

</x-layout>