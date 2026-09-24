<?php

namespace App\Libraries;

use App\Models\LandingSetting;

class LandingSettingLibrary extends AbstractLibrary
{
    protected string $model = LandingSetting::class;

    public function current(): LandingSetting
    {
        return LandingSetting::current();
    }
}
