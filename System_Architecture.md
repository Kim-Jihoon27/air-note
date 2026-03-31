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




---

## 🔑 Key Concepts

### 1. **Livewire Components**
- Located in `app/Livewire/Notes/`
- Each `.php` file is a **component class** that controls logic.
- Example:
  - `NoteEditor.php` → Handles editing notes.
  - `NoteList.php` → Displays a list of notes.
  - `NoteActions.php` → Provides actions like save/delete.
  - `NotesPanel.php` → Wraps everything into a panel.

### 2. **Models**
- Located in `app/Models/`
- `Note.php` represents the **database table** for notes.
- Handles relationships, queries, and data structure.

### 3. **Actions**
- Located in `app/Actions/Note/`
- Encapsulates **business logic** (clean separation of concerns).
- Example:
  - `SaveNote.php` → Logic for saving.
  - `CreateNote.php` → Logic for creating.
  - `DeleteNote.php` → Logic for deleting.

### 4. **Views**
- Located in `resources/views/`
- Blade templates (`.blade.php`) define **UI presentation**.
- Example:
  - `note-editor.blade.php` → UI for editing notes.
  - `note-list.blade.php` → UI for listing notes.
  - `layouts/app.blade.php` → Master layout (header, footer, etc.).
  - `note.blade.php` → Page view that ties everything together.

### 5. **Routes**
- Located in `routes/web.php`
- Defines **URL endpoints** and maps them to components or controllers.

---

## 🧩 How It All Fits Together

1. **User visits a route** → Defined in `web.php`.
2. **Route loads a Livewire component** → Example: `NotesPanel`.
3. **Component interacts with Actions & Models** → Handles business logic and database queries.
4. **Component renders a Blade view** → Example: `notes-panel.blade.php`.
5. **User sees the UI** → Built from Blade templates, powered by Livewire reactivity.

---

## 🎯 Lesson Takeaway

This structure follows **clean architecture principles**:
- **Separation of concerns** (UI, logic, data).
- **Reusability** (Actions can be reused across components).
- **Maintainability** (Easy to locate files by responsibility).

Think of it like this:
- **Models** = Data
- **Actions** = Logic
- **Livewire Components** = Controllers
- **Views** = Presentation
- **Routes** = Entry points

---

✅ By mastering this structure, you’ll be able to **navigate Laravel projects confidently** and build scalable applications with Livewire.

