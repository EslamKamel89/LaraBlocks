<?php

namespace App\Http\Resources\Domain;

use App\Http\Resources\Utils\DatetimeResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource {

    public function toArray(Request $request): array {

        return [
            "title" => $this->title,
            "description" => $this->description,
            "is_done" => $this->is_done,
            "due_at" => DatetimeResource::make($this->due_at),
            "updated_at" => DatetimeResource::make($this->updated_at),
            "created_at" => DatetimeResource::make($this->created_at),
        ];
    }
}
