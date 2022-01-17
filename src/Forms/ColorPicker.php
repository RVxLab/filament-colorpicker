<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Forms;

use Filament\Forms\Components\Concerns\HasExtraAlpineAttributes;
use Filament\Forms\Components\Field;
use RVxLab\FilamentColorPicker\Enum\ColorPattern;
use RVxLab\FilamentColorPicker\Enum\EditorFormat;
use RVxLab\FilamentColorPicker\Enum\PopupPosition;

class ColorPicker extends Field
{
    use HasExtraAlpineAttributes;

    protected string $view = 'filament-colorpicker::colorpicker';

    protected EditorFormat $editorFormat;

    protected ?PopupPosition $popupPosition = null;

    protected bool $alpha = true;

    protected string $layout = 'default';

    protected bool $cancelButton = false;

    protected ?string $colorPickerTemplate = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->editorFormat = EditorFormat::HEX();
        $this->popupPosition = PopupPosition::RIGHT();

        $this->afterStateHydrated(function (self $component, ?string $state): void {
            $component->state($state);
        });
    }

    public function editorFormat(EditorFormat $editorFormat): self
    {
        $this->editorFormat = $editorFormat;

        return $this;
    }

    public function getEditorFormat(): EditorFormat
    {
        return $this->editorFormat;
    }

    public function popupPosition(PopupPosition $popupPosition): self
    {
        $this->popupPosition = $popupPosition;

        return $this;
    }

    public function getPopupPosition(): ?PopupPosition
    {
        return $this->popupPosition;
    }

    public function disablePopup(): self
    {
        $this->popupPosition = null;

        return $this;
    }

    public function isPopupEnabled(): bool
    {
        return $this->popupPosition !== null;
    }

    public function alpha(bool $useAlphaChannel): self
    {
        $this->alpha = $useAlphaChannel;

        return $this;
    }

    public function getAlpha(): bool
    {
        return $this->alpha;
    }

    public function layout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function cancelButton(bool $showCancelButton): self
    {
        $this->cancelButton = $showCancelButton;

        return $this;
    }

    public function getCancelButton(): bool
    {
        return $this->cancelButton;
    }

    public function template(string $viewName): self
    {
        $this->colorPickerTemplate = $viewName;

        return $this;
    }

    public function getTemplate(): ?string
    {
        if (!$this->colorPickerTemplate) {
            return null;
        }

        return (string) view($this->colorPickerTemplate);
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
