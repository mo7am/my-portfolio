<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'tags' => json_decode($this->tags, true) ?: []
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_work_id' => ['required', 'numeric', Rule::exists('project_works', 'id')->where('tenant_id', tenant()?->getTenantKey())],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'tags' => ['sometimes', 'nullable', 'array'],
            'tags.*.value' => 'required|string',
            'source_code' => ['required', 'string', 'url', 'max:255'],
            'website_url' => ['sometimes', 'nullable', 'string', 'url', 'max:255'],
            'other' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
