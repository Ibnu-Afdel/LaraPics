<x-layout>
    @section('title', 'Post')
    @section('heading')
        {{ $post->caption }}
    @endsection

    <!-- Tags Section -->
    <div class="flex justify-center mb-4">
        @foreach ($post->tags as $tag)
            <span class="bg-gray-200 text-gray-800 rounded-full px-3 py-1 text-sm font-semibold mr-2">
                {{ $tag->name }}
            </span>
        @endforeach
    </div>

    <!-- Image Section -->
    @if ($post->image)
    <div class="flex justify-center mb-6">
        <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}" class="rounded-lg w-full max-w-3xl h-auto object-cover">
    </div>
    @endif


    <!-- Back and Edit/Delete Options -->
    <div class="flex justify-between mb-6">
        <a href="{{ route('posts.index') }}" class="text-white hover:text-gray-300">Back</a>
        @can('can-edit', $post)
            <div>
                <a href="{{ route('posts.edit', $post) }}" class="text-white hover:text-gray-300">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white hover:text-gray-300">Delete</button>
                </form>
            </div>
        @endcan
    </div>

    <!-- Comments Section -->
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-gray-800 text-2xl mb-4">Comments</h2>
        <form method="POST" action="{{ route('comment.store', $post) }}" class="mb-6">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-4">
                <label for="comment" class="block text-gray-600">Your Comment:</label>
                <input type="text" name="comment" id="comment" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('comment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Comment</button>
        </form>

        <!-- Displaying Comments -->
        <div>
            @forelse ($post->comments as $comment)
                <div class="border-b border-gray-300 mb-4 pb-4">
                    <p class="text-gray-800"><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                    @can('can-comment', $comment)
                        <div class="flex justify-end mt-2">
                            <a href="{{ route('comment.edit', $comment) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                            <form method="POST" action="{{ route('comment.destroy', $comment) }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    @endcan
                </div>
            @empty
                <p class="text-gray-500">No comments yet.</p>
            @endforelse
        </div>
    </div>
</x-layout>
