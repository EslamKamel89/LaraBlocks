<?php

namespace Modules\Tasks\Models;

use Illuminate\Database\Eloquent\Builder;
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
    public function scopeMine(Builder $q, ?int $userId): Builder {
        return $userId ? $q->where('user_id', $userId) : $q;
    }
    public function scopeDone(Builder $q, ?int $flag): Builder {
        return $flag === null ? $q  : $q->where('is_done', (bool)$flag);
    }
    public function scopeSearch(Builder $q, ?string $term) {
        if ($term === null) return $q;
        return $q->where('title', 'LIKE', "%{$term}%")
            ->orWhere('description', 'LIKE', "%{$term}%");
    }
    public function scopeDueFrom(Builder $q, ?string $from): Builder {
        if ($from === null) return $q;
        return $q->where('due_at', '>=', $from);
    }
    public function scopeDueTo(Builder $q, ?string $to): Builder {
        if ($to === null) return $q;
        return $q->where('due_at', '<=', $to);
    }
}
