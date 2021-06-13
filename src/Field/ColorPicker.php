<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Field;

use Filament\Resources\Forms\Components\Field;
use RVxLab\FilamentColorPicker\Enum\EditorFormat;

/**
 * @method static self make(string $name)
 */
final class ColorPicker extends Field
{
    /**
     * @var string
     */
    protected $view = 'filament-colorpicker::colorpicker';

    protected EditorFormat $editorFormat;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->editorFormat = EditorFormat::HEX();
    }

    protected function setUp(): void
    {
        $this->configure(function (): void {
            $this->addRules('regex:/^#[0-9a-f]{6}$/i');
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
}
