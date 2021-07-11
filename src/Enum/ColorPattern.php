<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Enum;

use MyCLabs\Enum\Enum;

final class ColorPattern extends Enum
{
    public const HEX = '/^#[0-9a-f]{6}$/i';
    public const HEXA = '/^#[0-9a-f]{8}$/i';
    public const RGB = '/^rgb\(\d{1,3},\s*\d{1,3},\s*\d{1,3}\)/i';
    public const RGBA = '/^rgba\(\d{1,3},\s*\d{1,3},\s*\d{1,3},\s*[\d\.]+\)/i';
    public const HSL = '/^hsl\([\d\.]+,\s*[\d\.]+%,\s*[\d\.]+%\)/i';
    public const HSLA = '/^hsla\([\d\.]+,\s*[\d\.]+%,\s*[\d\.]+%,\s*[\d\.]+\)/i';
}
