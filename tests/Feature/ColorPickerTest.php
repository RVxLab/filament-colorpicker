<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests\Feature;

use RVxLab\FilamentColorPicker\Enum\EditorFormat;
use RVxLab\FilamentColorPicker\Enum\OutputFormat;
use RVxLab\FilamentColorPicker\Enum\PopupPosition;
use RVxLab\FilamentColorPicker\Field\ColorPicker;
use RVxLab\FilamentColorPicker\Tests\TestCase;

final class ColorPickerTest extends TestCase
{
    public function testDefaults(): void
    {
        $field = ColorPicker::make('color');

        self::assertEquals([
            'popup' => PopupPosition::RIGHT,
            'alpha' => true,
            'editorFormat' => EditorFormat::HEX,
            'cancelButton' => false,
            'layout' => 'default',
        ], $field->jsonSerialize());
    }

    public function testWithCustomOptions(): void
    {
        $field = ColorPicker::make('color')
            ->popupPosition(PopupPosition::LEFT())
            ->alpha(false)
            ->editorFormat(EditorFormat::RGB())
            ->layout('some-layout')
            ->cancelButton(true);

        self::assertEquals([
            'popup' => PopupPosition::LEFT,
            'alpha' => false,
            'editorFormat' => EditorFormat::RGB,
            'cancelButton' => true,
            'layout' => 'some-layout',
        ], $field->jsonSerialize());
    }

    public function testPopupDisabled(): void
    {
        $field = ColorPicker::make('color')
            ->disablePopup();

        self::assertEquals([
            'popup' => null,
            'alpha' => true,
            'editorFormat' => EditorFormat::HEX,
            'cancelButton' => false,
            'layout' => 'default',
        ], $field->jsonSerialize());
    }

    /**
     * @dataProvider outputValueProvider
     */
    public function testOutputValue(EditorFormat $format, bool $alpha, string $expectedOutput): void
    {
        $field = ColorPicker::make('color')
            ->editorFormat($format)
            ->alpha($alpha);

        self::assertSame($expectedOutput, $field->getOutputValue());
    }

    /**
     * @return mixed[][]
     */
    public function outputValueProvider(): array
    {
        return [
            [ EditorFormat::HEX(), true, OutputFormat::HEXA ],
            [ EditorFormat::HEX(), false, OutputFormat::HEX ],
            [ EditorFormat::RGB(), true, OutputFormat::RGBA ],
            [ EditorFormat::RGB(), false, OutputFormat::RGB ],
            [ EditorFormat::HSL(), true, OutputFormat::HSLA ],
            [ EditorFormat::HSL(), false, OutputFormat::HSL ],
        ];
    }
}
