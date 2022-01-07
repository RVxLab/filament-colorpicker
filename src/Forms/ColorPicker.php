<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Forms;

use Filament\Forms\Components\Field;
use RVxLab\FilamentColorPicker\Enum\ColorPattern;
use RVxLab\FilamentColorPicker\Enum\EditorFormat;
use RVxLab\FilamentColorPicker\Enum\OutputFormat;
use RVxLab\FilamentColorPicker\Enum\PopupPosition;

class ColorPicker extends Field
{
    protected string $view = 'filament-colorpicker::colorpicker';

    protected EditorFormat $editorFormat;

    protected ?PopupPosition $popupPosition = null;

    protected bool $alpha = true;

    protected string $layout = 'default';

    protected bool $cancelButton = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->editorFormat = EditorFormat::HEX();
        $this->popupPosition = PopupPosition::RIGHT();

        $this->afterStateHydrated(function (self $component, $state): void {
            $popupPosition = $this->popupPosition?->getValue();

            $component->state([
                'options' => [
                    'editorFormat' => $this->editorFormat->getValue(),
                    'popupPosition' => $popupPosition,
                    'alpha' => $this->alpha,
                    'layout' => $this->layout,
                    'cancelButton' => $this->cancelButton,
                    'popupEnabled' => null !== $popupPosition,
                ],
            ]);
        });
    }

    public function editorFormat(EditorFormat $editorFormat): self
    {
        $this->editorFormat = $editorFormat;

        return $this;
    }

    public function popupPosition(PopupPosition $popupPosition): self
    {
        $this->popupPosition = $popupPosition;

        return $this;
    }

    public function disablePopup(): self
    {
        $this->popupPosition = null;

        return $this;
    }

    public function alpha(bool $useAlphaChannel): self
    {
        $this->alpha = $useAlphaChannel;

        return $this;
    }

    public function layout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function cancelButton(bool $showCancelButton): self
    {
        $this->cancelButton = $showCancelButton;

        return $this;
    }

    public function getEditorFormat(): EditorFormat
    {
        return $this->editorFormat;
    }

    public function getPopupPosition(): ?PopupPosition
    {
        return $this->popupPosition;
    }

    public function isPopupEnabled(): bool
    {
        return $this->popupPosition !== null;
    }

    public function getAlpha(): bool
    {
        return $this->alpha;
    }

    protected function determineColorPattern(): string
    {
        if ($this->alpha) {
            return match ($this->editorFormat->getValue()) {
                EditorFormat::RGB => ColorPattern::RGBA,
                EditorFormat::HSL => ColorPattern::HSLA,
                default => ColorPattern::HEXA,
            };
        }

        return match ($this->editorFormat->getValue()) {
            EditorFormat::RGB => ColorPattern::RGB,
            EditorFormat::HSL => ColorPattern::HSL,
            default => ColorPattern::HEX,
        };
    }
}
