<div class="w-full mx-auto mt-8  mb-8 p-6 bg-slate-300 rounded-lg shadow-md">
    <div class="flex items-center gap-2 mb-4">
        <input
            type="text"
            wire:model="query"
            placeholder="Search posts..."
            class="form-control w-full p-2 border rounded text-gray-800"
        />

        @if($query)
            <button wire:click="$set('query', '')" class="text-gray-500 hover:text-gray-700 transition">
                &times;
            </button>
        @endif

        <button wire:click="updateQuery" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Search
        </button>
    </div>

    @if($query)
        <h2 class="text-xl font-bold mb-4 text-gray-900">Search Results for "{{ $query }}"</h2>
    @endif

    @if(empty($posts) && $query)
        <p class="text-center text-gray-700">No posts found.</p>
    @else
        @foreach($posts as $post)
            <div class="mb-6 bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-bold text-gray-900">
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

                <p class="text-gray-800 mb-4">{{ $post->body }}</p>

                <div class="flex flex-wrap space-x-2">
                    @foreach($post->tags as $tag)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>
