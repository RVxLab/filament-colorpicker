<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Field;

use Filament\Resources\Forms\Components\Field;
use RVxLab\FilamentColorPicker\Enum\ColorPattern;
use RVxLab\FilamentColorPicker\Enum\EditorFormat;
use RVxLab\FilamentColorPicker\Enum\OutputFormat;
use RVxLab\FilamentColorPicker\Enum\PopupPosition;

/**
 * @method static self make(string $name)
 */
class ColorPicker extends Field implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $view = 'filament-colorpicker::colorpicker';

    protected EditorFormat $editorFormat;

    protected ?PopupPosition $popupPosition = null;

    protected bool $alpha = true;

    protected string $layout = 'default';

    protected bool $cancelButton = false;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->editorFormat = EditorFormat::HEX();
        $this->popupPosition = PopupPosition::RIGHT();
    }

    protected function setUp(): void
    {
        $this->configure(function (): void {
            $this->addRules(
                'regex:' . $this->determineColorPattern()
            );
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

    public function getOutputValue(): string
    {
        if ($this->alpha) {
            return match ($this->editorFormat->getValue()) {
                EditorFormat::RGB => OutputFormat::RGBA,
                EditorFormat::HSL => OutputFormat::HSLA,
                default => OutputFormat::HEXA,
            };
        }

        return match ($this->editorFormat->getValue()) {
            EditorFormat::RGB => OutputFormat::RGB,
            EditorFormat::HSL => OutputFormat::HSL,
            default => OutputFormat::HEX,
        };
    }

    public function jsonSerialize(): mixed
    {
        return [
            'popup' => $this->popupPosition?->getValue() ?? false,
            'alpha' => $this->alpha,
            'editorFormat' => $this->editorFormat->getValue(),
            'cancelButton' => $this->cancelButton,
            'layout' => $this->layout,
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
