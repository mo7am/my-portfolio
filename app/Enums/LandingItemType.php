<?php

namespace App\Enums;

enum LandingItemType: string
{
    case Feature = 'feature';
    case Benefit = 'benefit';
    case UseCase = 'use_case';
    case Step = 'step';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Feature => __('dashboard.landing_features'),
            self::Benefit => __('dashboard.landing_benefits'),
            self::UseCase => __('dashboard.landing_use_cases'),
            self::Step => __('dashboard.landing_steps'),
        };
    }

    public function singular(): string
    {
        return match ($this) {
            self::Feature => __('dashboard.landing_feature'),
            self::Benefit => __('dashboard.landing_benefit'),
            self::UseCase => __('dashboard.landing_use_case'),
            self::Step => __('dashboard.landing_step'),
        };
    }
}
