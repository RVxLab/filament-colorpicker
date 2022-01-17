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

    protected int $debounceTimeout = 500;

    protected function setUp(): void
    {
        parent::setUp();

        $this->editorFormat = EditorFormat::HEX();
        $this->popupPosition = PopupPosition::RIGHT();

        $this->afterStateHydrated(function (self $component, ?string $state): void {
            $component->state($state);
        });

        $this->rule(function (ColorPicker $component) {
            return "regex:{$component->determineColorPattern()}";
        });
    }

    public function editorFormat(EditorFormat|string $editorFormat): self
    {
        $this->editorFormat = new EditorFormat($editorFormat);

        return $this;
    }

    public function getEditorFormat(): EditorFormat
    {
        return $this->editorFormat;
    }

    public function popupPosition(PopupPosition|string $popupPosition): self
    {
        $this->popupPosition = new PopupPosition($popupPosition);

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

        return (string)view($this->colorPickerTemplate);
    }

    public function debounceTimeout(int $timeout): self
    {
        $this->debounceTimeout = $timeout;

        return $this;
    }

    public function getDebounceTimeout(): int
    {
        return $this->debounceTimeout;
    }

    public function getPickerOptions(): array
    {
        return [
            'editorFormat' => $this->getEditorFormat()->getValue(),
            'popupPosition' => $this->getPopupPosition()?->getValue(),
            'alpha' => $this->getAlpha(),
            'layout' => $this->getLayout(),
            'cancelButton' => $this->getCancelButton(),
            'statePath' => $this->getStatePath(),
            'template' => $this->getTemplate(),
            'debounceTimeout' => $this->getDebounceTimeout(),
        ];
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
