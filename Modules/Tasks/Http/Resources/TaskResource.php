<?php

namespace Modules\Tasks\Http\Resources;

use App\Http\Resources\Utils\DatetimeResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Users\Http\Resources\UserSafeResource;

class TaskResource extends JsonResource {

    public function toArray(Request $request): array {

        return [
            'id' => $this->id,
            "user_id" => $this->user_id,
            "title" => $this->title,
            "description" => $this->description,
            "is_done" => $this->is_done,
            "user" => UserSafeResource::make($this->whenLoaded('user')),
            "due_at" => DatetimeResource::make($this->due_at),
            "updated_at" => DatetimeResource::make($this->updated_at),
            "created_at" => DatetimeResource::make($this->created_at),
        ];
    }
}
