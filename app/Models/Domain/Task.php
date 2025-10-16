<?php

namespace App\Models\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    /** @use HasFactory<\Database\Factories\Domain\TaskFactory> */
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "is_done",
        "due_at",
    ];
}
