<div class="h-full flex flex-col bg-white" 
     x-data="{ 
         isSaving: @entangle('isSaving'), 
         lastSavedAt: @entangle('lastSavedAt'),
         showSaveToast: @entangle('showSaveToast')
     }">
    @if($noteId)
        {{-- Header with title only --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <input
                type="text"
                wire:model.live.debounce.1000ms="title"
                wire:loading.attr="disabled"
                placeholder="Untitled Note"
                class="w-full text-2xl font-bold text-gray-900 placeholder-gray-400 focus:outline-none bg-transparent"
            />

            {{-- Saving indicator only --}}
            <div x-show="isSaving" x-transition class="flex items-center gap-1.5">
                <svg class="animate-spin h-3.5 w-3.5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span class="text-xs text-blue-500 font-medium">Saving...</span>
            </div>
        </div>

        {{-- Editor content --}}
        <textarea
            wire:model.live.debounce.1000ms="content"
            wire:loading.class="opacity-50"
            placeholder="Start writing your thoughts..."
            class="flex-1 w-full p-6 text-gray-700 placeholder-gray-400 border-none focus:outline-none resize-none text-base leading-relaxed"
        ></textarea>

        {{-- Footer with stats --}}
        <div class="px-6 py-3 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ str_word_count($content ?? '') }} words
                    </span>
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        {{ strlen($content ?? '') }} characters
                    </span>
                </div>
                
                {{-- Live sync indicator --}}
                <div class="flex items-center gap-1.5">
                    <div x-show="isSaving" class="flex items-center gap-1">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        <span class="text-xs text-blue-500 font-medium">Syncing...</span>
                    </div>
                    <div x-show="!isSaving" x-transition class="flex items-center gap-1">
                        <span class="relative flex h-2 w-2">
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span class="text-xs text-green-600 font-medium">Synced</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Empty state --}}
        <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
            <svg class="w-20 h-20 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-lg font-medium text-gray-500">Select a note to view</p>
            <p class="text-sm mt-1 text-gray-400">Or create a new note from the sidebar</p>
        </div>
    @endif

{{-- Modern Toast notification --}}
<div
    x-show="showSaveToast"
    x-init="$watch('showSaveToast', value => { if (value) { setTimeout(() => { showSaveToast = false }, 1500) } })"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-3 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-3 scale-95"
    class="fixed bottom-6 right-6 z-50"
>
    <div class="bg-gray-900 text-white px-4 py-3 rounded-xl shadow-2xl flex items-center gap-3">
        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
            <p class="text-sm font-medium">Air Note saved automatically</p>
            <p class="text-xs text-gray-400" x-text="lastSavedAt || 'Just now'"></p>
        </div>
        <button @click="showSaveToast = false" class="ml-2 text-gray-400 hover:text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>