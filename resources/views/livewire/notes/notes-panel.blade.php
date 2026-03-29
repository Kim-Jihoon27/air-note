<div class="h-screen flex">
    {{-- Left Sidebar (Note List) - Fixed width --}}
    <div class="w-80 flex-shrink-0">
        <livewire:notes.note-list :selected-note-id="$selectedNoteId" />
    </div>

    {{-- Right Panel (Editor) - Flexible width --}}
    <div class="flex-1 overflow-hidden">
        <livewire:notes.note-editor :note-id="$selectedNoteId" />
    </div>
</div>