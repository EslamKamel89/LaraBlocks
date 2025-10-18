<?php

namespace App\Http\Resources\Utils;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatetimeResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {

        return [
            'date' => $this?->toIso8601String(),
            'diff' => $this?->diffForHumans(),
            'timestamp' => $this?->getTimestamp(),
        ];
    }
}
