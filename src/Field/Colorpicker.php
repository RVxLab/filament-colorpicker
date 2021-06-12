<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorpicker\Field;

use Filament\Resources\Forms\Components\Field;

final class Colorpicker extends Field
{
    protected $view = 'filament-colorpicker::colorpicker';

    protected function setUp(): void
    {
        $this->configure(function () {
            $this->addRules('regex:/^#[0-9a-f]{6}$/i');
        });
    }
}
