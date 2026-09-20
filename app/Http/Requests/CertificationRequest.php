<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issued_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'credential_id' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return trans('validation.attributes');
    }
}
