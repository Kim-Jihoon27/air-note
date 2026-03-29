<div class="h-full flex flex-col bg-gray-50 border-r border-gray-200">
    {{-- Header --}}
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Air Note</h2>

        {{-- Search --}}
        <div class="relative">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search notes..."
                class="w-full pl-10 pr-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        {{-- Filters --}}
        <div class="flex items-center gap-2 mt-2">
            <button
                wire:click="$set('showPinnedOnly', ! $showPinnedOnly)"
                class="text-xs px-2 py-1 rounded {{ $showPinnedOnly ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-600' }} border border-gray-300"
            >
                {{ $showPinnedOnly ? '✓ Pinned' : '☆ Pinned' }}
            </button>
        </div>

        {{-- New Note Button --}}
        <button
            wire:click="createNewNote"
            class="mt-3 w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Note
        </button>
    </div>

    {{-- Notes List --}}
    <div class="flex-1 overflow-y-auto">
        @forelse($notes as $note)
            <div
                wire:click="$dispatch('note-selected', { noteId: {{ $note->id }} })"
                class="group p-4 border-b border-gray-100 cursor-pointer transition-colors
                    {{ $selectedNoteId === $note->id ? 'bg-blue-50 border-blue-200' : 'hover:bg-gray-100' }}"
            >
                <div class="flex items-start justify-between gap-2">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            @if($note->is_pinned)
                                <svg class="w-4 h-4 text-yellow-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endif
                            <h3 class="font-medium text-gray-900 truncate">
                                {{ $note->title ?: 'Untitled Note' }}
                            </h3>
                        </div>
                        <p class="text-sm text-gray-500 truncate">{{ $note->preview }}</p>
                        <span class="text-xs text-gray-400 mt-1 block">
                            {{ $note->updated_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Actions (visible on hover) --}}
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                        <button
                            wire:click.stop="togglePin({{ $note->id }})"
                            class="p-1 hover:bg-gray-200 rounded"
                            title="{{ $note->is_pinned ? 'Unpin' : 'Pin' }}"
                        >
                            <svg class="w-4 h-4 {{ $note->is_pinned ? 'text-yellow-500' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                        <button
                            wire:click.stop="deleteNote({{ $note->id }})"
                            wire:confirm="Are you sure you want to delete this note?"
                            class="p-1 hover:bg-red-100 rounded text-red-500"
                            title="Delete"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-sm">
                    {{ $search ? 'No notes match your search.' : 'No notes yet. Create one!' }}
                </p>
            </div>
        @endforelse
    </div>
</div>