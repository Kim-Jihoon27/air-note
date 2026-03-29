<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;
use Livewire\Attributes\On;

class NoteActions extends Component
{
    public ?int $activeNoteId = null;
    public bool $showConfirmDelete = false;

    #[On('note-selected')]
    public function onNoteSelected(int $noteId): void
    {
        $this->activeNoteId = $noteId;
    }

    #[On('note-updated')]
    public function onNoteUpdated(int $noteId): void
    {
        if ($this->activeNoteId === $noteId) {
            // Update any action-specific state
        }
    }

    public function duplicateNote(): void
    {
        if (!$this->activeNoteId) {
            return;
        }

        $original = Note::find($this->activeNoteId);

        if ($original) {
            $duplicate = Note::create([
                'title' => $original->title . ' (Copy)',
                'content' => $original->content,
            ]);

            $this->dispatch('note-selected', noteId: $duplicate->id);
            $this->dispatch('toast', message: 'Note duplicated', type: 'success');
        }
    }

    public function togglePin(): void
    {
        if (!$this->activeNoteId) {
            return;
        }

        $note = Note::find($this->activeNoteId);
        $note?->togglePin();

        $this->dispatch('refresh-list');
        $this->dispatch('toast', 
            message: $note->is_pinned ? 'Note pinned' : 'Note unpinned', 
            type: 'success'
        );
    }

    public function confirmDelete(): void
    {
        $this->showConfirmDelete = true;
    }

    public function deleteNote(): void
    {
        if (!$this->activeNoteId) {
            return;
        }

        Note::destroy($this->activeNoteId);

        $this->activeNoteId = null;
        $this->showConfirmDelete = false;

        $this->dispatch('note-deleted');
        $this->dispatch('toast', message: 'Note deleted', type: 'success');
    }

    /**
     * Export note as text file download
     * Note: No return type to allow StreamedResponse return
     */
    public function exportAsText()
    {
        if (!$this->activeNoteId) {
            return;
        }

        $note = Note::find($this->activeNoteId);

        if (!$note) {
            return;
        }

        $content = "Title: {$note->title}\n\n{$note->content}";

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, 'note-' . $note->id . '.txt');
    }

    public function render()
    {
        return view('livewire.notes.note-actions');
    }
}