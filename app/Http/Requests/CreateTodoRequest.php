<?php

namespace App\Http\Requests;

use App\Enums\PriorityEnum;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        logger()->info(array_map(fn ($e) => $e->value, \App\Enums\PriorityEnum::cases()));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => 'required|max:255',
            'due_date' => 'required|date|after:today',
            'status' => [Rule::enum(StatusEnum::class)],
            'priority' => ['required', new Enum(PriorityEnum::class)],
        ];
    }
}
