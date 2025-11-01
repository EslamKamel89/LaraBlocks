<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksIndexRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'page_mode' => ['sometimes', 'in:page,cursor'],
            'q' => ['sometimes', 'string', 'max:255'],
            'mine' => ['sometimes', 'boolean'],
            'done' => ['sometimes', 'boolean'],
            'due_from' => ['sometimes', 'date'],
            'due_to' => ['sometimes', 'date', 'after_or_equal:due_from'],
            'sort' => ['sometimes', 'in:id,due_at,created_at,updated_at'],
            'order' => ['sometimes', 'in:asc,desc']
        ];
    }
}
