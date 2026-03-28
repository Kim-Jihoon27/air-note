<?php

namespace App\Livewire\Notes;

use Livewire\Component;
use App\Models\Note;

class NoteList extends Component
{
    public string $search = '';
    public ?int $selectedNoteId = null;
    public bool $showPinnedOnly = false;

    protected $listeners = [
        'note-selected' => 'selectNote',
        'note-deleted' => '$refresh',
        'note-created' => '$refresh',
        'refresh-list' => '$refresh',
    ];

    public function selectNote(int $noteId): void
    {
        $this->selectedNoteId = $noteId;
    }

    public function createNewNote(): void
    {
        $note = Note::create(['title' => 'New Note', 'content' => '']);
        $this->dispatch('note-selected', noteId: $note->id);
        $this->dispatch('refresh-editor');
    }

    public function togglePin(int $noteId): void
    {
        $note = Note::find($noteId);
        $note->togglePin();
        $this->dispatch('refresh-list');
    }

    public function deleteNote(int $noteId): void
    {
        Note::destroy($noteId);
        $this->dispatch('note-deleted');
        
        if ($this->selectedNoteId === $noteId) {
            $this->selectedNoteId = null;
        }
    }

    public function render()
    {
        $notes = Note::query()
            ->when($this->search, fn($q) => 
                $q->where(function($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('content', 'like', '%' . $this->search . '%');
                })
            )
            ->when($this->showPinnedOnly, fn($q) => $q->pinned())
            ->orderByDesc('pinned_at')
            ->orderByDesc('updated_at')
            ->get();

        return view('livewire.notes.note-list', [
            'notes' => $notes,
        ]);
    }
}