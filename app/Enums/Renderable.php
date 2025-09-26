<?php

namespace App\Enums;

use Illuminate\Support\Str;
use ReflectionClass;

trait Renderable
{
    public function object(): array
    {
        return [
            'name' => $this->name($this->value),
            'value' => $this->raw(),
        ];
    }

    public static function list(): array
    {
        return array_map(function ($item) {
            return $item->object();
        }, self::cases());
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function name(): string
    {
        return str_replace(['-', '_'], ' ', Str::title(str_replace('-r-', '/', $this->value)));
    }

    public function raw()
    {
        return $this->value;
    }

    /**
     * @param string $prefix
     * @return array
     */
    public static function getConstantsWithPrefix(string $prefix): array
    {
        $constants = [];
    
        foreach ((new ReflectionClass(__CLASS__))->getConstants() as $constant => $value) {
            if (Str::startsWith($constant, $prefix)) {
                $rawValue = $value instanceof \BackedEnum ? $value->value : $value;
    
                $constants[] = [
                    'name' => str_replace(['-', '_'], ' ', Str::title(str_replace('-r-', '/', $rawValue))),
                    'value' => $rawValue,
                ];
            }
        }
    
        return $constants;
    }
}
