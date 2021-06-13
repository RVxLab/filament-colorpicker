<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static self TOP()
 * @method static self RIGHT()
 * @method static self BOTTOM()
 * @method static self LEFT()
 */
final class PopupPosition extends Enum
{
    public const TOP = 'top';
    public const RIGHT = 'right';
    public const BOTTOM = 'bottom';
    public const LEFT = 'left';
}
