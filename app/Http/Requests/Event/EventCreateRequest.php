<?php

namespace App\Http\Requests\Event;

use App\Enums\EventStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventCreateRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'date_time' => ['required', 'date'],
            'status' => ['required', Rule::in(EventStatusEnum::values())],
            'content' => ['required', 'array', 'max:65535'],
        ];
    }
}
