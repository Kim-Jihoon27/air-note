Air_Papel/
├── app/
│   ├── Livewire/
│   │   └── Notes/
│   │       ├── NoteEditor.php      ← Component Class (PHP)
│   │       ├── NoteList.php        ← Component Class (PHP)
│   │       ├── NoteActions.php     ← Component Class (PHP)
│   │       └── NotesPanel.php      ← Component Class (PHP)
│   │
│   ├── Models/
│   │   └── Note.php                ← Database Model
│   │
│   └── Actions/
│       └── Note/
│           ├── SaveNote.php        ← Business Logic
│           ├── CreateNote.php      ← Business Logic
│           └── DeleteNote.php      ← Business Logic
│
├── resources/
│   └── views/
│       ├── livewire/
│       │   └── notes/
│       │       ├── note-editor.blade.php    ← Component View
│       │       ├── note-list.blade.php      ← Component View
│       │       ├── note-actions.blade.php   ← Component View
│       │       └── notes-panel.blade.php    ← Component View
│       │
│       ├── layouts/
│       │   └── app.blade.php       ← Master Layout
│       │
│       └── note.blade.php          ← Page View
│
└── routes/
    └── web.php                     ← Route Definitions