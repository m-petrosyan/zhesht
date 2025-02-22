<?php

namespace App\Http\Requests\Event;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'banner_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:20000'],
            'poster_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:20000'],
            'content' => ['required', 'max:65535'],
            'events' => ['required', 'array'],
            'events.*.id' => ['required', 'numeric', 'exists:events,id'],
            'events.*.location' => ['required', 'string'],
            'events.*.date_time' => ['required', 'date'],
            'events.*.tickets' => ['nullable', 'array'],
            'events.*.tickets.*.title' => ['required', 'max:255'],
            'events.*.tickets.*.url' => ['required', 'url'],
        ];
    }
}
