<?php

namespace App\Http\Requests\Domain;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        return [
            "title" => ['sometimes', 'string', 'max:255'],
            "description" => ['sometimes', 'nullable', 'string ', 'max:255'],
            "is_done" => ['sometimes', 'boolean'],
            "due_at" => ['sometimes', 'nullable', 'date'],
        ];
    }
}
