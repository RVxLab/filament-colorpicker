<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorpicker\Field;

use Filament\Resources\Forms\Components\Field;

final class Colorpicker extends Field
{
    /**
     * @var string
     */
    protected $view = 'filament-colorpicker::colorpicker';

    protected function setUp(): void
    {
        $this->configure(function (): void {
            $this->addRules('regex:/^#[0-9a-f]{6}$/i');
        });
    }
}
