<div class="h-full flex flex-col bg-white">
    @if($noteId)
        <input
            type="text"
            wire:model.live.debounce.500ms="title"
            wire:blur="saveNote"
            placeholder="Note title..."
            class="w-full px-6 py-4 text-2xl font-bold text-gray-900 placeholder-gray-400 border-b border-gray-100 focus:outline-none"
        />

        <textarea
            wire:model.live.debounce.500ms="content"
            wire:blur="saveNote"
            placeholder="Start writing..."
            class="flex-1 w-full p-6 text-gray-700 placeholder-gray-400 border-none focus:outline-none resize-none text-base leading-relaxed"
        ></textarea>

        <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
            <span class="text-xs text-gray-400">
                {{ str_word_count($content) }} words
            </span>
        </div>
    @else
        <div class="flex-1 flex items-center justify-center">
            <div class="text-center text-gray-400">
                <p class="text-lg font-medium">Select a note to view</p>
                <p class="text-sm mt-1">Or create a new note from the sidebar</p>
            </div>
        </div>
    @endif
</div>