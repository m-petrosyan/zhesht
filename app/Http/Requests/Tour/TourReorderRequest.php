<?php

namespace App\Http\Requests\Tour;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TourReorderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sortedIds' => ['required', 'array'],
            'sortedIds.*.id' => ['required', 'exists:tours,id'],
            'sortedIds.*.slider_order' => ['required', 'integer'],
        ];
    }
}
