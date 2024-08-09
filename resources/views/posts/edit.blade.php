<x-layout>
    @section('title','Edit')
    @section('heading', 'Edit')
    <form action="{{ route('posts.update', $post)}}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')

    <label for="caption">Caption</label>
    <input type="text" name="caption" id="caption" value="{{ $post->caption }}">

        <label for="prevImg">Previous Image</label><br>
        <img src="{{ asset($post->image) }}" alt="{{ $post->caption }} id="prevImg" ><br>

    <label for="image">Change Image</label><br>
    <input type="file" name="image" id="image"><br>


    <div>
        <label>Tags</label>
        @foreach($tags as $tag)
            <div>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    @checked(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())))
                >
                {{ $tag->name }}
            </div>
        @endforeach
    </div>

    <button>Edit</button>
</form>
</x-layout>