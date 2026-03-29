<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;

class NoteEditor extends Component
{
    #[Locked]
    public ?int $noteId = null;

    #[Validate('nullable|string|max:255')]
    public ?string $title = null;

    #[Validate('nullable|string')]
    public ?string $content = null;

    public bool $showSaveToast = false;
    public ?string $lastSavedAt = null;
    public bool $isSaving = false;

    public function mount(): void
    {
        if ($this->noteId) {
            $this->loadNote();
        }
    }

    #[On('note-selected')]
    public function selectNote(int $noteId): void
    {
        $this->saveIfDirty();
        $this->noteId = $noteId;
        $this->loadNote();
    }

    public function loadNote(): void
    {
        $note = Note::find($this->noteId);

        if ($note) {
            $this->title = $note->title;
            $this->content = $note->content;
            $this->lastSavedAt = $note->updated_at?->diffForHumans();
        }
    }

    public function saveNote(): void
    {
        if (!$this->noteId) {
            return;
        }

        $this->isSaving = true;
        $this->validate();

        Note::where('id', $this->noteId)->update([
            'title' => $this->title ?: substr(strip_tags($this->content), 0, 50),
            'content' => $this->content,
            'updated_at' => now(),
        ]);

        $this->lastSavedAt = now()->diffForHumans();
        $this->showSaveToast = true;
        $this->isSaving = false;

        $this->dispatch('note-updated', noteId: $this->noteId);
    }

    public function updating($name, $value): void
    {
        if (in_array($name, ['title', 'content'])) {
            $this->showSaveToast = false;
        }
    }

    public function updated($name, $value): void
    {
        if (in_array($name, ['title', 'content'])) {
            $this->saveNote();
        }
    }

    protected function saveIfDirty(): void
    {
        if ($this->noteId && ($this->title || $this->content)) {
            $this->saveNote();
        }
    }

    public function render()
    {
        return view('livewire.notes.note-editor');
    }
}
