<?php

namespace App\Http\Requests\Admin\Landing;

use App\Enums\LandingItemType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LandingItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $type = $this->route('type');

        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['nullable', 'string', 'max:2000'],
            'icon' => [
                Rule::requiredIf($type === LandingItemType::Feature->value),
                'nullable',
                'string',
                'max:64',
            ],
            'meta' => [
                Rule::requiredIf($type === LandingItemType::Step->value),
                'nullable',
                'string',
                'max:64',
            ],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
        ]);
    }

    public function attributes(): array
    {
        return trans('validation.attributes');
    }
}
