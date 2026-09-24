<?php

namespace App\Http\Requests\Admin\Landing;

use Illuminate\Foundation\Http\FormRequest;

class LandingSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hero_eyebrow' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:500'],
            'hero_subtitle' => ['nullable', 'string', 'max:2000'],
            'hero_cta_primary' => ['nullable', 'string', 'max:255'],
            'hero_cta_secondary' => ['nullable', 'string', 'max:255'],
            'final_cta_title' => ['nullable', 'string', 'max:500'],
            'final_cta_subtitle' => ['nullable', 'string', 'max:2000'],
            'final_cta_primary' => ['nullable', 'string', 'max:255'],
            'final_cta_secondary' => ['nullable', 'string', 'max:255'],
            'footer_tagline' => ['nullable', 'string', 'max:500'],
            'announcement_text' => ['nullable', 'string', 'max:1000'],
            'announcement_enabled' => ['sometimes', 'boolean'],
            'announcement_url' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'social_twitter' => ['nullable', 'url', 'max:500'],
            'social_linkedin' => ['nullable', 'url', 'max:500'],
            'social_github' => ['nullable', 'url', 'max:500'],
            'social_facebook' => ['nullable', 'url', 'max:500'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $nullable = [
            'announcement_url',
            'contact_email',
            'contact_phone',
            'social_twitter',
            'social_linkedin',
            'social_github',
            'social_facebook',
        ];

        $merge = ['announcement_enabled' => $this->boolean('announcement_enabled')];

        foreach ($nullable as $field) {
            $value = $this->input($field);
            $merge[$field] = is_string($value) && trim($value) === '' ? null : $value;
        }

        $this->merge($merge);
    }

    public function attributes(): array
    {
        return trans('validation.attributes');
    }
}
