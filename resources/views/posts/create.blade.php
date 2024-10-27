<x-layout>
    @section('title','Create')
    @section('heading', 'Create')
<div class="max-w-lg mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
            <input
                type="text"
                id="caption"
                name="caption"
                class="mt-1 block w-full px-4 py-2 border text-black border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                value="{{ old('caption') }}"
                placeholder="Enter your caption"
                required
            >
            @error('caption')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input
                type="file"
                id="image"
                name="image"
                class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm cursor-pointer focus:outline-none"
                accept="image/*"
            >
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="mt-2 grid grid-cols-2 gap-2">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center">
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-sm text-gray-700">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Submit
            </button>
        </div>
    </form>
</div>

</x-layout>
