<?php

namespace Modules\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Tasks\Database\Factories\TaskFactory;
use Modules\Users\Models\User;

class Task extends Model {
    /** @use HasFactory<\Modules\Tasks\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "is_done",
        "due_at",
    ];
    protected $casts = [
        'is_done' => 'boolean',
        'due_at' => 'datetime',
    ];
    protected static function newFactory(): TaskFactory {
        return  TaskFactory::new();
    }
    public function User(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
