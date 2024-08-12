<x-layout>
    @section('title', 'Manage Tags')
    @section('heading')
        @auth
            <div class="text-center text-xl font-semibold text-gray-800">
                {{ Auth::user()->name }} - Admin
            </div>
        @endauth
    @endsection

    <div class="max-w-md mx-auto mt-8 p-4 bg-white rounded-lg shadow-md">
        <div class="mb-4 text-center">
            <a href="{{ route('admin.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 rounded-full px-4 py-2 transition-all duration-300 shadow-md">
                Create New Tag
            </a>
        </div>

        @forelse ($tags as $tag)
            <div class="mb-3 p-3 bg-gray-100 rounded-lg shadow-sm flex items-center justify-between text-sm">
                <span class="text-gray-700">{{ $tag->name }}</span>
                <form method="POST" action="{{ route('admin.destroy', $tag) }}" class="flex-shrink-0">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="px-3 py-1 bg-red-600 text-white font-semibold rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    >
                        Delete
                    </button>
                </form>
            </div>
        @empty
            <div class="text-center text-gray-500">No tags available yet!</div>
        @endforelse
    </div>
</x-layout>
