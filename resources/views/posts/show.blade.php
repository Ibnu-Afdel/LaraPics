<x-layout>
    @section('title',' Post')
    @section('heading')
    {{ $post->caption }}
    @endsection
    @if ($post->image)
    <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}">
@endif
<br><br>
<a href="{{ route('posts.index') }}">Back</a><br>
<a href="{{ route('posts.edit', $post) }}">Edit</a><br>

<form action="{{ route('posts.destroy',$post) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>


</x-layout>