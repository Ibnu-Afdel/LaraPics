<x-layout>

    <div class="max-w-lg mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        @section('title', 'Search Results')
        @section('heading', "Search Results for \" $query \"")
    
        @if($posts->isEmpty())
            <p class="text-center text-gray-600">No posts found.</p>
        @else
            @foreach($posts as $post)
                <div class="mb-6 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        <a href="{{ route('posts.show', $post->id) }}">{{ $post->caption }}</a>
                    </h2>
    
                    @if ($post->image)
                        <div class="my-4">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                    @endif
    
                    <p class="text-gray-700 mb-4">{{ $post->body }}</p>
    
                    <div class="flex flex-wrap space-x-2">
                        @foreach($post->tags as $tag)
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    



</form>
</x-layout>