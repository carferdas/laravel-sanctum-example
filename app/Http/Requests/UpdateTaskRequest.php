<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['filled', 'string', 'max:255'],
            'description' => ['filled', 'string'],
            'priority' => ['filled', 'string', Rule::in(TaskPriority::values())],
        ];
    }
}
