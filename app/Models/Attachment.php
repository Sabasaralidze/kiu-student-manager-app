<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $fillable = [
        'task_id',
        'original_name',
        'path',
        'size',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Attachment $attachment) {
            Storage::disk('local')->delete($attachment->path);
        });
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public static function storePdf(Task $task, UploadedFile $file): self
    {
        $path = $file->store('task-attachments/'.$task->id, 'local');

        return self::create([
            'task_id' => $task->id,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => $file->getSize(),
        ]);
    }

    public function formattedSize(): string
    {
        $kb = $this->size / 1024;

        if ($kb < 1024) {
            return round($kb, 1).' KB';
        }

        return round($kb / 1024, 1).' MB';
    }
}
