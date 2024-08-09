<x-layout>
    @section('title','Create')
    @section('heading', 'Create')
    <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <label for="caption">Caption</label>
    <input type="text" name="caption" id="caption">

    <label for="image">Image</label>
    <input type="file" name="image" id="image">
    <div>
        <label for="tags">Tags:</label>
        @foreach($tags as $tag)
            <div>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                {{-- 
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}   
                or
                --}}
                @checked(in_array($tag->id, old('tags', [])))>
                {{ $tag->name }}
            </div>
        @endforeach
    </div>

    <button>Create</button>
</form>
</x-layout>