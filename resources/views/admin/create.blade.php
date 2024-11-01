<x-layout>
    @section('title', 'Create Tag')
    @section('heading', 'Create Tag')

    <div class="max-w-lg mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Enter tag name"
                    required
                >
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
</x-layout>
