<?php

namespace App\Actions\Note;

use App\Models\Note;

class CreateNote
{
    public function execute(array $data = []): Note
    {
        return Note::create([
            'title' => $data['title'] ?? 'Untitled Note',
            'content' => $data['content'] ?? '',
        ]);
    }
}