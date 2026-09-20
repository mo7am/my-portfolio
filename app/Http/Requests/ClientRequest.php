<?php

namespace App\Http\Requests;

use App\Enums\MaritalStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'marital_status' => ['nullable', 'string', Rule::in(MaritalStatus::values())],
            'objective' => ['nullable', 'string', 'max:1000'],
            'domain' => ['required', 'string', 'max:255', 'unique:users,domain,'.auth('sanctum')->id()],
            'job_title' => ['nullable', 'string', 'max:255'],
            'job_description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return trans('validation.attributes');
    }
}
