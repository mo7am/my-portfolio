<?php

namespace App\Http\Requests\Admin\Landing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LandingPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $planId = $this->route('plan');

        return [
            'code' => [
                'required',
                'string',
                'max:64',
                'alpha_dash',
                Rule::unique('landing_plans', 'code')->ignore($planId),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'badge' => ['nullable', 'string', 'max:255'],
            'cta_label' => ['nullable', 'string', 'max:255'],
            'period_label' => ['nullable', 'string', 'max:255'],
            'features_text' => ['nullable', 'string', 'max:5000'],
            'price_monthly' => ['required', 'numeric', 'min:0', 'max:999999'],
            'currency' => ['required', 'string', 'size:3'],
            'is_highlighted' => ['sometimes', 'boolean'],
            'cta_route' => ['required', 'string', 'max:100'],
            'cta_params_json' => ['nullable', 'string', 'max:1000'],
            'billing_plan_id' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'is_highlighted' => $this->boolean('is_highlighted'),
            'currency' => strtoupper((string) $this->input('currency', 'USD')),
        ]);
    }

    public function attributes(): array
    {
        return trans('validation.attributes');
    }
}
