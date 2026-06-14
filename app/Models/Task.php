<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'description',
        'subject',
        'status',
        'deadline',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function isPersonal(): bool
    {
        return $this->project_id === null;
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
