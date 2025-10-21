<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        return [
            "title" => ['required', 'string', 'max:255'],
            "description" => ['nullable', 'string ', 'max:255'],
            "is_done" => ['sometimes', 'boolean'],
            "due_at" => ['nullable', 'date'],
        ];
    }
}
