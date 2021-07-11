<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Enum;

use MyCLabs\Enum\Enum;

final class OutputFormat extends Enum
{
    public const HEX = 'color.hex.slice(0, 7)';
    public const HEXA = 'color.hex';
    public const RGB = 'color.rgbString';
    public const RGBA = 'color.rgbaString';
    public const HSL = 'color.hslString';
    public const HSLA = 'color.hslaString';
}
