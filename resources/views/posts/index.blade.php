<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-8">

        <div class="h-96 col-span-3 md:col-span-3 p-2">
            <a href="{{ route('posts.create') }}" class="text-white bg-blue-500 hover:bg-blue-600 rounded-full px-6 py-2 transition-all duration-300 shadow-md">
                Create
            </a>

{{--            <div class="mt-8 text-center">--}}
{{--                <form action="{{ route('posts.search') }}" method="GET">--}}
{{--                    <input type="text" name="query" placeholder="Search for posts or tags" required class="w-full md:w-1/2 p-2 rounded-lg shadow-md focus:ring-2 focus:ring-blue-400">--}}
{{--                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Search</button>--}}
{{--                </form>--}}
{{--            </div>--}}

            <div class="mt-10 m-20">
                @forelse ($posts as $post)
                    <article class="card bg-white rounded-lg shadow-lg p-4 mb-8 transition-all hover:scale-105 transform duration-300">
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
                                    <img class="w-6 h-6 object-cover rounded-full" src="{{ asset($post->image) }}" alt="{{ $post->caption }}>
                                    @endif
                                    <span class="font-bold hover:underline">{{ $post->user->name }}</span>
                                    {{-- <span class="text-sm text-gray-400">@ {{ $post->user->name }}</span> --}}
                                </a>
                            </div>

                            <div class="flex flex-wrap gap-1 text-xs mb-4">
                                @if($post->tags->isNotEmpty())
                                        @foreach($post->tags as $tag)
                                        <span class="bg-gray-200 text-gray-600 rounded-full px-2 py-1 hover:bg-gray-800 hover:text-white">{{ $tag->name }}</span>
                                        @endforeach
                                @endif
                            </div>


                            <div class="flex items-center justify-between text-sm px-2">
                                <div class="flex items-center gap-1">
                                    <form action="{{ $post->isLikedBy(auth()->user()) ? route('posts.unlike', $post) : route('posts.like', $post) }}" method="POST">
                                        @csrf
                                        @if($post->isLikedBy(auth()->user()))
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path fill-rule="evenodd" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        @else
                                            <button type="submit" class="text-gray-500 hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path fill-rule="evenodd" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </form>
                                    <p>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</p>

                                </div>

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


        <div class="p-2 align-bottom text-center order-first md:order-last">
            <div class="sidebar relative md:!block">
                <div class="sidebar-content lg:w-80 pb-8 bg-white p-4 rounded-md shadow-md">
                    <section class="card p-4">
                        <h2 class="text-xl font-bold mb-4">Tags</h2>
                        <ul class="space-y-2">
                            @foreach($tags as $tag)
                                <li>
                                    <a href="{{ route('posts.byTag', $tag->id) }}" class="block bg-gray-200 rounded-full px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300 hover:text-gray-900 transition">
                                        {{ $tag->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>


                        @if(isset($tag))
                    <div class="mt-8 text-center">
                        <a href="{{ route('posts.index') }}" class="text-white bg-blue-500 hover:bg-blue-600 rounded-full px-6 py-2 transition-all duration-300 shadow-md">
                            View All Posts
                        </a>
                    </div>
                @endif


                    </section>
                </div>
                <livewire:search />
            </div>

            <div class="mt-16">
                {{-- others --}}
            </div>
        </div>

    </div>
</x-layout>

