<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
        $rules = [
            'due_date' => ['nullable', 'array'],
            'time_tracked' => ['nullable', 'array'],
        ];
        if ($this->filled('due_date')) {
            $rules['due_date.start'] = ['required', 'date'];
            $rules['due_date.end'] = ['required', 'date', 'after_or_equal:due_date.start'];
        }

        if ($this->filled('time_tracked')) {
            $rules['time_tracked.min'] = ['required', 'numeric'];
            $rules['time_tracked.max'] = ['required', 'numeric', 'gte:time_tracked.min'];
        }

        return $rules;
    }
}
