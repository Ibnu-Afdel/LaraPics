<div>
    <form wire:submit.prevent="addComment" class="mb-4">
        <textarea
            wire:model.defer="commentText"
            placeholder="Add a comment..."
            class="w-full text-black p-2 border rounded mb-2"
        ></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Post Comment
        </button>
    </form>

    <div>
        @foreach($comments as $comment)
            <div class="mb-4 p-2 border-b">
                <!-- Edit Mode -->
                @if($editingCommentId === $comment->id)
                    <textarea
                        wire:model.defer="editingCommentText"
                        class="w-full p-2 text-black border rounded mb-2"
                    ></textarea>
                    <div class="flex items-center gap-2">
                        <button wire:click="updateComment" class="bg-green-500 text-white px-4 py-1 rounded">
                            Save
                        </button>
                        <button wire:click="cancelEdit" class="bg-gray-500 text-white px-4 py-1 rounded">
                            Cancel
                        </button>
                    </div>
                @else
                    <!-- Display Mode -->
                    <p class="text-gray-700">{{ $comment->comment }}</p>
                    <small class="text-gray-500">{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small>

                    @can('can-comment', $comment)
                        <div class="flex gap-2 mt-2">
                            <button wire:click="editComment({{ $comment->id }})" class="text-blue-500 hover:underline">
                                Edit
                            </button>
                            <button wire:click="deleteComment({{ $comment->id }})" class="text-red-500 hover:underline">
                                Delete
                            </button>
                        </div>
                    @endcan
                @endif
            </div>
        @endforeach
    </div>
</div>
