<div>
    <form wire:submit.prevent="addComment" class="mb-4">
        <textarea
            wire:model.defer="commentText"
            placeholder="Add a comment..."
            class="w-full p-2 border rounded mb-2"
        ></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Post Comment
        </button>
    </form>

    <div>
        @foreach($comments as $comment)
            <div class="mb-4 p-2 border-b">
                <p class="text-gray-700">{{ $comment->comment }}</p>
                <small class="text-gray-500">{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
</div>
