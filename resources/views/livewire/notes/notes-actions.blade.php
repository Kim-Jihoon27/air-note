<div class="flex items-center gap-1">
    @if($activeNoteId)
        {{-- Duplicate --}}
        <button
            wire:click="duplicateNote"
            class="p-2 hover:bg-gray-100 rounded text-gray-600"
            title="Duplicate note"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
        </button>

        {{-- Pin/Unpin --}}
        <button
            wire:click="togglePin"
            class="p-2 hover:bg-gray-100 rounded text-gray-600"
            title="Pin note"
        >
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
        </button>

        {{-- Export --}}
        <button
            wire:click="exportAsText"
            class="p-2 hover:bg-gray-100 rounded text-gray-600"
            title="Export as text"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
        </button>

        {{-- Delete --}}
        <button
            wire:click="confirmDelete"
            class="p-2 hover:bg-red-100 rounded text-red-500"
            title="Delete note"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>

        {{-- Delete Confirmation Modal --}}
        @if($showConfirmDelete)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
                    <h3 class="text-lg font-semibold mb-2">Delete Note?</h3>
                    <p class="text-gray-600 mb-4">This action cannot be undone.</p>
                    <div class="flex gap-2 justify-end">
                        <button
                            wire:click="$set('showConfirmDelete', false)"
                            class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded"
                        >
                            Cancel
                        </button>
                        <button
                            wire:click="deleteNote"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @else
        <span class="text-xs text-gray-400">Select a note</span>
    @endif
</div>