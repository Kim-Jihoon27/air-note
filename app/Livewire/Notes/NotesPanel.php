<?php

namespace App\Livewire\Notes;

use Livewire\Component;

class NotesPanel extends Component
{
    public ?int $selectedNoteId = null;

    protected $listeners = [
        'note-selected' => 'onNoteSelected',
        'note-saved' => '$refresh',
    ];

    public function onNoteSelected(int $noteId): void
    {
        $this->selectedNoteId = $noteId;
    }

    public function render()
    {
        return view('livewire.notes.notes-panel');
    }
}