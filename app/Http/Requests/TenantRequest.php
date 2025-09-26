<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'is_show_educational' => ['sometimes', 'boolean'],
            'is_show_experience' => ['sometimes', 'boolean'],
            'is_show_language' => ['sometimes', 'boolean'],
            'is_show_skill' => ['sometimes', 'boolean'],
            'is_show_project' => ['sometimes', 'boolean'],
            'is_show_link' => ['sometimes', 'boolean'],
            'is_show_contact' => ['sometimes', 'boolean'],
            'is_show_download_cv' => ['sometimes', 'boolean'],
            'is_show_website' => ['sometimes', 'boolean'],
        ];
    }
}
