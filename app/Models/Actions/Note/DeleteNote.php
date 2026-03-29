<?php

namespace App\Actions\Note;

use App\Models\Note;

class DeleteNote
{
    public function execute(int $noteId): bool
    {
        return Note::destroy($noteId);
    }
}