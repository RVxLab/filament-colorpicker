<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorpicker;

use Filament\PluginServiceProvider;

final class FilamentPluginServiceProvider extends PluginServiceProvider
{
    protected $scripts = [
        'rvxlab-filament-colorpicker' => '/vendor/filament-colorpicker/filament-colorpicker.js',
    ];
}
