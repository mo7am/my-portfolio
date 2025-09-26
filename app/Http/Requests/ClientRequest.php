<?php

namespace App\Http\Requests;

use App\Enums\MaritalStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'logo' => ['sometimes', 'nullable', 'image', 'max:2048'],
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'nationality' => ['required', 'string', 'max:100'],
            'marital_status' => ['required', 'string', Rule::in(MaritalStatus::values())],
            'objective' => ['required', 'string', 'max:1000'],
            'domain' => ['required', 'string', 'max:255', 'unique:users,domain,' . auth('sanctum')->id()],
            'job_title' => ['required', 'string', 'max:255'],
            'job_description' => ['required', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
