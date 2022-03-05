<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests\Feature;

use Filament\Forms\ComponentContainer;
use Illuminate\Support\Facades\View;
use RVxLab\FilamentColorPicker\Enum\EditorFormat;
use RVxLab\FilamentColorPicker\Enum\PopupPosition;
use RVxLab\FilamentColorPicker\Forms\ColorPicker;
use RVxLab\FilamentColorPicker\Tests\Fixtures\Livewire;
use RVxLab\FilamentColorPicker\Tests\TestCase;

final class ColorPickerTest extends TestCase
{
    public function testDefaults(): void
    {
        $field = $this->makeComponent();

        self::assertEquals([
            'editorFormat' => 'hex',
            'popupPosition' => 'right',
            'alpha' => true,
            'layout' => 'default',
            'cancelButton' => false,
            'statePath' => 'color',
            'template' => null,
            'debounceTimeout' => 500,
            'preview' => false,
        ], $field->getPickerOptions());
    }

    public function testWithCustomOptions(): void
    {
        $field = $this->makeComponent()
            ->popupPosition(PopupPosition::LEFT())
            ->alpha(false)
            ->editorFormat(EditorFormat::RGB())
            ->layout('some-layout')
            ->cancelButton(true);

        self::assertEquals([
            'editorFormat' => 'rgb',
            'popupPosition' => 'left',
            'alpha' => false,
            'layout' => 'some-layout',
            'cancelButton' => true,
            'statePath' => 'color',
            'template' => null,
            'debounceTimeout' => 500,
            'preview' => false,
        ], $field->getPickerOptions());
    }

    public function testPopupDisabled(): void
    {
        $field = $this->makeComponent()
            ->disablePopup();

        self::assertEquals([
            'editorFormat' => 'hex',
            'popupPosition' => null,
            'alpha' => true,
            'layout' => 'default',
            'cancelButton' => false,
            'statePath' => 'color',
            'template' => null,
            'debounceTimeout' => 500,
            'preview' => false,
        ], $field->getPickerOptions());

        self::assertFalse($field->isPopupEnabled());
    }

    public function testWithCustomTemplate(): void
    {
        $template = '<div>This is a test template</div>';

        $field = $this->makeComponent()
            ->template($template);

        self::assertEquals([
            'editorFormat' => 'hex',
            'popupPosition' => 'right',
            'alpha' => true,
            'layout' => 'default',
            'cancelButton' => false,
            'statePath' => 'color',
            'template' => '<div>This is a test template</div>',
            'debounceTimeout' => 500,
            'preview' => false,
        ], $field->getPickerOptions());
    }

    public function testWithPreview(): void
    {
        $field = $this->makeComponent()
            ->preview();

        self::assertEquals([
            'editorFormat' => 'hex',
            'popupPosition' => 'right',
            'alpha' => true,
            'layout' => 'default',
            'cancelButton' => false,
            'statePath' => 'color',
            'template' => null,
            'debounceTimeout' => 500,
            'preview' => true,
        ], $field->getPickerOptions());
    }
    private function makeComponent(): ColorPicker
    {
        return tap(new ColorPicker('color'), function (ColorPicker $field): void {
            $field
                ->container(ComponentContainer::make(Livewire::make()))
                ->initialize();
        });
    }
}
