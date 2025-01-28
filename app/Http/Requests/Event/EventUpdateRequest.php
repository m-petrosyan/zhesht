<?php

namespace App\Http\Requests\Event;

use App\Enums\EventStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'poster' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'location' => ['required', 'string', 'max:255'],
            'date_time' => ['required', 'date'],
            'status' => [Rule::in(EventStatusEnum::values())],
            'content' => ['required', 'max:65535'],
            'tickets' => ['array'],
            'tickets.*.title' => ['required', 'max:255'],
            'tickets.*.url' => ['required', 'url'],
        ];
    }
}
