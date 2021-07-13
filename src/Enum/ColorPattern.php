<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Enum;

use MyCLabs\Enum\Enum;

/**
 * RGB(A) and HSL(A) regex were taken from spatie/color
 *
 * @link https://github.com/spatie/color/blob/master/src/Validate.php
 */
final class ColorPattern extends Enum
{
    public const HEX = '/^#[0-9a-f]{6}$/i';
    public const HEXA = '/^#[0-9a-f]{8}$/i';
    public const RGB = '/^ *rgb\( *\d{1,3} *, *\d{1,3} *, *\d{1,3} *\) *$/i';
    public const RGBA = '/^ *rgba\( *\d{1,3} *, *\d{1,3} *, *\d{1,3} *, *[0-1]?(\.\d{1,})? *\) *$/i';
    public const HSL = '/^ *hsl\( *-?\d{1,3}\.?\d* *, *\d{1,3}\.?\d*%? *, *\d{1,3}\.?\d*%? *\) *$/i';
    public const HSLA = '/^ *hsla\( *-?\d{1,3}\.?\d* *, *\d{1,3}\.?\d*%? *, *\d{1,3}\.?\d*%? *, *[0-1]?(\.\d{1,})? *\) *$/i';
}
