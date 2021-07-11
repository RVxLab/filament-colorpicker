<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests\Feature;

use RVxLab\FilamentColorPicker\Enum\ColorPattern;
use RVxLab\FilamentColorPicker\Tests\TestCase;

final class ColorPatternTest extends TestCase
{
    /**
     * @dataProvider patternProvider
     */
    public function testPattern(string $pattern, string $input): void
    {
        self::assertMatchesRegularExpression($pattern, $input);
    }

    /**
     * @return string[][]
     */
    public function patternProvider(): array
    {
        return [
            [ ColorPattern::HEX, '#123ABC' ],
            [ ColorPattern::HEXA, '#123ABC25' ],
            [ ColorPattern::RGB, 'rgb(123,234,12)' ],
            [ ColorPattern::RGB, 'rgb(1, 2, 3)' ],
            [ ColorPattern::RGBA, 'rgba(100,200,255,1)' ],
            [ ColorPattern::RGBA, 'rgba(1, 2, 3, 0.123)' ],
            [ ColorPattern::HSL, 'hsl(123.4,100%,20.4%)' ],
            [ ColorPattern::HSL, 'hsl(55, 99.5%, 13.37%)' ],
            [ ColorPattern::HSLA, 'hsla(33.4,50.1%,20%,0.432)' ],
            [ ColorPattern::HSLA, 'hsla(55, 22.2222%, 42%, .5)' ],
        ];
    }
}
