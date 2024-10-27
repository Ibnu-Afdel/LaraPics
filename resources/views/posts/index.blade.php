<x-layout>

    <div class=" min-h-screen p-8 relative">

        <a href="{{ route('posts.create') }}" class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 transition-all duration-300 shadow-lg z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </a>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="col-span-1 bg-slate-700 p-6 rounded-lg shadow-lg mt-10">
                    <ul class=" space-y-2">
                        @forelse($tags as $tag)
                            <h2 class="text-xl text-center font-bold mb-4">Tags</h2>
                            <li>
                                <a href="{{ route('posts.byTag', $tag->id) }}" class="block bg-gray-200 rounded-full  px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300 hover:text-gray-900 transition">
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @empty
                            <h2 class="text-xl text-center text-red-300 font-bold mb-4">No Tag</h2>
                        @endforelse

                    </ul>

                    @if(isset($tag))
                        <div class="mt-8 text-center">
                            <a href="{{ route('posts.index') }}" class="text-black bg-blue-500 hover:bg-blue-600 rounded-full px-6 py-2 transition-all duration-300 shadow-md">
                                View All Posts
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Main Content  -->
                <div class="col-span-1 md:col-span-3">
                    <div class=" mt-12">
                        <livewire:search />
                    </div>

                    <div class="p-1">
                        <div class="mt-4">
                            @forelse ($posts as $post)
                                <article class="card bg-emerald-50 rounded-lg shadow-lg p-4 mb-8 transition-all hover:scale-105 transform duration-300">
                                    <figure class="w-full relative overflow-hidden rounded-t-lg">
                                        <a href="{{ route('posts.show', $post) }}">
                                            @if ($post->image)
                                                <img class="w-full min-h-40 rounded-lg hover:scale-[105%] transition duration-700" src="{{ asset($post->image) }}" alt="{{ $post->caption }}">
                                            @endif
                                        </a>
                                    </figure>

                                    <div class="px-4 pt-4">
                                        <div class="flex flex-col items-center text-center text-4xl md:text-5xl pt-3 pb-4 pl-1 pr-4 font1 text-slate-700">
                                            <a href="{{ route('posts.show', $post) }}">{{ $post->caption }}</a>
                                            @if ($post->user->is_admin)
                                                <div class="w-16 bg-black p-0.5 mt-7"></div>
                                            @else
                                                <div class="w-16 bg-emerald-200 p-0.5 mt-7"></div>
                                            @endif
                                        </div>

                                        <div class="justify-center mb-6">
                                            <a class="flex items-center place-content-center gap-1" href="#">
                                                @if ($post->image)
                                                    <img class="w-6 h-6 object-cover rounded-full" src="{{ asset($post->image) }}" alt="{{ $post->caption }}">
                                                @endif
                                                <span class="font-bold text-slate-700 hover:underline">{{ $post->user->name }}</span>
                                            </a>
                                        </div>

                                        <div class="flex flex-wrap gap-1 text-xs mb-4">
                                            @if($post->tags->isNotEmpty())
                                                @foreach($post->tags as $tag)
                                                    <span class="bg-gray-200 text-gray-600 rounded-full px-2 py-1 hover:bg-gray-800 hover:text-black">{{ $tag->name }}</span>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-between text-sm text-black px-2">
                                            <div class="flex items-center gap-1">
                                                <!-- Like Component -->
                                                <livewire:like-post :post="$post" />
                                            </div>

                                            <!-- Comment Component -->
                                            <a href="{{ route('posts.show', $post) }}" class="font-bold hover:bg-gray-800 hover:rounded-full hover:px-4 hover:py-3 hover:text-white transition-all">
                                                Comments <span class="font-light">{{ $post->comments->count() }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="flex items-center justify-center min-h-[200px] bg-gray-100 rounded-lg shadow-md p-6">
                                    <p class="text-gray-500 text-xl font-semibold">
                                        No post available yet!
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
    </div>
</x-layout>
