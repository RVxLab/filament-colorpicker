<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static self HEX()
 * @method static self HSL()
 * @method static self RGB()
 */
final class EditorFormat extends Enum
{
    public const HEX = 'hex';
    public const HSL = 'hsl';
    public const RGB = 'rgb';
}
