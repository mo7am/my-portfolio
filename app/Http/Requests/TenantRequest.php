<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'is_show_certification' => ['sometimes', 'boolean'],
            'is_show_course' => ['sometimes', 'boolean'],
            'is_show_award' => ['sometimes', 'boolean'],
            'is_show_volunteering' => ['sometimes', 'boolean'],
            'is_show_reference' => ['sometimes', 'boolean'],
        ];
    }
}
