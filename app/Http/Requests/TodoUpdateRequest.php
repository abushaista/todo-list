<?php

namespace App\Http\Requests;

use App\Enums\PriorityEnum;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'assignee' => 'nullable|string|max:50',
            'due_date' => 'nullable|date|after:today',
            'time_tracked' => 'nullable|numeric|max:100000',
            'status' => [Rule::enum(StatusEnum::class)],
            'priority' => [Rule::enum(PriorityEnum::class)],
        ];
    }
}
