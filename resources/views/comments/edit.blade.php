<x-layout>
    @section('title', 'Comment Edit')
    @section('heading', 'Edit Comment')

    <div class="max-w-lg mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('comment.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <input 
                    type="text" 
                    name="comment" 
                    id="comment" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('comment', $comment->comment) }}"
                    placeholder="Edit your comment"
                    required
                >
                @error('comment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Update Comment
                </button>
            </div>
        </form>
    </div>
</x-layout>
