<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker;

use Filament\PluginServiceProvider;

final class FilamentPluginServiceProvider extends PluginServiceProvider
{
    /**
     * @var string[]
     */
    protected $scripts = [
        'rvxlab-filament-colorpicker' => '/vendor/filament-colorpicker/filament-colorpicker.js',
    ];
}
