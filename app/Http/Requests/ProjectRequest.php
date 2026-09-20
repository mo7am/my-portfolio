<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $tags = json_decode($this->tags, true);
        $payload = [];

        if (is_array($tags)) {
            $payload['tags'] = collect($tags)->pluck('value')->filter()->values()->toArray();
        }

        if ($this->input('project_work_id') === '' || $this->input('project_work_id') === null) {
            $payload['project_work_id'] = null;
        }

        if ($payload !== []) {
            $this->merge($payload);
        }
    }

    public function rules(): array
    {
        return [
            'project_work_id' => ['nullable', 'numeric', Rule::exists('project_works', 'id')->where('tenant_id', tenant()?->getTenantKey())],
            'title' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'date' => ['required', 'date'],
            'tags' => ['sometimes', 'nullable', 'array'],
            'tags.*' => ['required', 'string', 'max:50'],
            'source_code' => ['nullable', 'string', 'url', 'max:255'],
            'website_url' => ['nullable', 'string', 'url', 'max:255'],
            'other' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return trans('validation.attributes');
    }
}
