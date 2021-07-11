<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Field;

use Filament\Resources\Forms\Components\Field;
use RVxLab\FilamentColorPicker\Enum\EditorFormat;
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
            if ($this->alpha) {
                $this->addRules('regex:/^#[0-9a-f]{8}$/i');
            } else {
                $this->addRules('regex:/^#[0-9a-f]{6}$/i');
            }
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

    public function getEditorFormat(): EditorFormat
    {
        return $this->editorFormat;
    }

    public function getPopupPosition(): ?PopupPosition
    {
        return $this->popupPosition;
    }

    public function getAlpha(): bool
    {
        return $this->alpha;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'popup' => $this->popupPosition?->getValue() ?? false,
            'alpha' => $this->getAlpha(),
            'editorFormat' => $this->getEditorFormat()->getValue(),
        ];
    }
}
