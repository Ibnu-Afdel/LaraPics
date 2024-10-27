<x-layout>
    @section('title', 'Post')
    @section('heading')
        {{ $post->caption }}
    @endsection


    <div class="flex justify-center mb-4">
        @foreach ($post->tags as $tag)
            <span class="bg-gray-200 text-gray-800 rounded-full px-3 py-1 text-sm font-semibold mr-2">
                {{ $tag->name }}
            </span>
        @endforeach
    </div>

    @if ($post->image)
    <div class="flex justify-center mb-6">
        <img src="{{ asset($post->image) }}" alt="{{ $post->caption }}" class="rounded-lg w-full max-w-3xl h-auto object-cover">
    </div>
    @endif


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


    <div class="bg-white rounded-lg p-6">
        <h2 class="text-gray-800 text-2xl mb-4">Comments</h2>
        <livewire:comment-post :post="$post" />
    </div>
</x-layout>
