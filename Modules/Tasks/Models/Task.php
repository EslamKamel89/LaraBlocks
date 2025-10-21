<?php

namespace Modules\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Tasks\Database\Factories\TaskFactory;

class Task extends Model {
    /** @use HasFactory<\Modules\Tasks\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
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
}
