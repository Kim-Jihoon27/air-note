<?php

namespace App\Livewire\Notes;

use Livewire\Component;
use App\Models\Note;

class NoteEditor extends Component
{
    public ?int $noteId = null;
    public string $title = '';
    public string $content = '';
    public bool $isDirty = false;
    public ?int $debounceTimeout = 500; // Auto-save delay

    protected $listeners = [
        'note-selected' => 'loadNote',
        'refresh-editor' => '$refresh',
    ];

    public function loadNote(int $noteId): void
    {
        $this->saveIfDirty(); // Auto-save before switching
        
        $note = Note::find($noteId);
        
        if ($note) {
            $this->noteId = $note->id;
            $this->title = $note->title ?? '';
            $this->content = $note->content ?? '';
            $this->isDirty = false;
        }
    }

    public function updatedTitle(): void
    {
        $this->isDirty = true;
        $this->scheduleAutoSave();
    }

    public function updatedContent(): void
    {
        $this->isDirty = true;
        $this->scheduleAutoSave();
    }

    protected function scheduleAutoSave(): void
    {
        // Livewire v3 debounce approach
    }

    public function saveNote(): void
    {
        if (!$this->noteId) {
            return;
        }

        $this->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        Note::find($this->noteId)->update([
            'title' => $this->title ?: substr(strip_tags($this->content), 0, 50),
            'content' => $this->content,
        ]);

        $this->isDirty = false;
        $this->dispatch('note-saved');
    }

    protected function saveIfDirty(): void
    {
        if ($this->isDirty && $this->noteId) {
            $this->saveNote();
        }
    }

    public function render()
    {
        return view('livewire.notes.note-editor');
    }
}