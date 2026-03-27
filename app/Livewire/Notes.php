<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;

class Notes extends Component
{
    // Public properties are reactive
    public $content = '';
    public $search = '';
    public $editingId = null;

    // Listen for events
    protected $listeners = ['refreshNotes' => '$refresh'];

    // Create new note
    public function createNote()
    {
        $this->validate([
            'content' => 'required|string|max:1000',
        ]);

        Note::create(['content' => $this->content]);

        $this->content = ''; // Reset form

        $this->dispatch('note-created'); // Optional event
    }

    // Delete note
    public function deleteNote($id)
    {
        Note::find($id)->delete();
    }

    // Start editing
    public function editNote($id)
    {
        $this->editingId = $id;
        $note = Note::find($id);
        $this->content = $note->content;
    }

    // Update note
    public function updateNote($id)
    {
        $this->validate([
            'content' => 'required|string|max:1000',
        ]);

        Note::find($id)->update(['content' => $this->content]);

        $this->editingId = null;
        $this->content = '';
    }

    // Cancel editing
    public function cancelEdit()
    {
        $this->editingId = null;
        $this->content = '';
    }

    // Render component
    public function render()
    {
        $notes = Note::query()
            ->when($this->search, fn($q) => 
                $q->where('content', 'like', '%' . $this->search . '%')
            )
            ->latest()
            ->get();

           return view('livewire.notes', ['notes' => $notes]);  // ✅ Pass $notes
    }
}