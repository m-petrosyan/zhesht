<?php

namespace App\Http\Requests\Tour;

use Illuminate\Contracts\Validation\ValidationRule;

class TourUpdateRequest extends TourCreateRequest
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
        return array_merge(
            parent::rules(),
            [
                'banner_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:20000'],
                'events.*.id' => ['nullable', 'numeric', 'exists:events,id'],
            ]
        );
    }
}
