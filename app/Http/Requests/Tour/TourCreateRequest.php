<?php

namespace App\Http\Requests\Tour;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TourCreateRequest extends FormRequest
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
            'banner_file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:20000'],
            'intro' => ['required', 'max:65535'],
            'content' => ['required', 'max:65535'],
            'events' => ['required', 'array'],
            'events.*.location' => ['required', 'string'],
            'events.*.poster_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:20000'],
            'events.*.date_time' => ['required', 'date'],
            'events.*.tickets' => ['nullable', 'array'],
            'events.*.tickets.*.title' => ['required', 'max:255'],
            'events.*.tickets.*.url' => ['required', 'url'],
        ];
    }
}
