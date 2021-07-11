<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests\Feature;

use RVxLab\FilamentColorPicker\Enum\EditorFormat;
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
        ], $field->jsonSerialize());
    }

    public function testWithCustomOptions(): void
    {
        $field = ColorPicker::make('color')
            ->popupPosition(PopupPosition::LEFT())
            ->alpha(false)
            ->editorFormat(EditorFormat::RGB());

        self::assertEquals([
            'popup' => PopupPosition::LEFT,
            'alpha' => false,
            'editorFormat' => EditorFormat::RGB,
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
        ], $field->jsonSerialize());
    }
}
