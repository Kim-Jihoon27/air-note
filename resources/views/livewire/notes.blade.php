<div class="max-w-2xl mx-auto space-y-6">
    <!-- Search Bar -->
    <input 
        type="text" 
        wire:model.live="search" 
        placeholder="Search notes..."
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
    />

    <!-- Create/Edit Form -->
    <form wire:submit="{{ $editingId ? 'updateNote(' . $editingId . ')' : 'createNote' }}" class="space-y-4">
        <textarea 
            wire:model="content" 
            placeholder="Write your note..."
            rows="4"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
        ></textarea>
        
        @error('content') 
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <div class="flex gap-2">
            <button 
                type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
                {{ $editingId ? 'Update' : 'Add Note' }}
            </button>
            
            @if($editingId)
                <button 
                    type="button"
                    wire:click="cancelEdit"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                >
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <!-- Notes List -->
    <div class="space-y-4">
        @forelse($notes as $note)
            <div class="p-4 bg-white rounded-lg shadow">
                <p class="text-gray-800">{{ $note->content }}</p>
                <div class="mt-2 flex justify-between items-center">
                    <small class="text-gray-500">
                        {{ $note->created_at->diffForHumans() }}
                    </small>
                    <div class="flex gap-2">
                        <button 
                            wire:click="editNote({{ $note->id }})"
                            class="text-blue-500 hover:text-blue-700"
                        >
                            Edit
                        </button>
                        <button 
                            wire:click="deleteNote({{ $note->id }})"
                            wire:confirm="Are you sure?"
                            class="text-red-500 hover:text-red-700"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">No notes yet. Create one!</p>
        @endforelse
    </div>
</div>