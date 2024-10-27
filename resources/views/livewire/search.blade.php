<div class="max-w-lg mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <input
        type="text"
        wire:model="query"
        placeholder="Search posts..."
        class="form-control mb-4 w-full p-2 border rounded"
    />

    <button wire:click = 'updateQuery'>Search</button>

    @if($query)
        <h2 class="text-xl font-bold mb-4">Search Results for "{{ $query }}"</h2>
    @endif

    @if(empty($posts))
        <p class="text-center text-gray-600">No posts found.</p>
    @else
        @foreach($posts as $post)
            <div class="mb-6 bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-bold text-gray-800">
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->caption }}</a>
                </h2>

                @if ($post->image)
                    <div class="my-4">
                        <img
                            src="{{ asset($post->image) }}"
                            alt="{{ $post->caption }}"
                            class="w-full h-auto rounded-lg shadow-md"
                        />
                    </div>
                @endif

                <p class="text-gray-700 mb-4">{{ $post->body }}</p>

                <div class="flex flex-wrap space-x-2">
                    @foreach($post->tags as $tag)
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif


</div>