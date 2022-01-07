<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker;

use Filament\PluginServiceProvider;

final class FilamentPluginServiceProvider extends PluginServiceProvider
{
    public static string $name = 'Colorpicker';

    /**
     * @var string[]
     */
    protected array $scripts = [
        'rvxlab-filament-colorpicker' => __DIR__ . '/../resources/dist/filament-colorpicker.js',
    ];
}
