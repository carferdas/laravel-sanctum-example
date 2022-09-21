<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'priority' => ['required', 'string', Rule::in(TaskPriority::values())],
        ];
    }
}
