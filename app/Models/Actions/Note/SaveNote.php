<?php

namespace App\Actions\Note;

use App\Models\Note;
use Illuminate\Support\Str;

class SaveNote
{
    public function execute(Note $note, array $data): Note
    {
        $note->update([
            'title' => $data['title'] ?: Str::limit(strip_tags($data['content']), 50),
            'content' => $data['content'] ?? $note->content,
        ]);

        return $note->fresh();
    }
}