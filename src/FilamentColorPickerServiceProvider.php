<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

final class FilamentColorPickerServiceProvider extends PluginServiceProvider
{
    public static string $name = 'Colorpicker';

    /**
     * @var string[]
     */
    protected array $scripts = [
        'rvxlab-filament-colorpicker' => __DIR__ . '/../resources/dist/filament-colorpicker.js',
    ];

    protected array $styles = [
        'rvxlab-filament-colorpicker' => __DIR__ . '/../resources/dist/filament-colorpicker.css',
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-colorpicker')
            ->hasViews()
            ->hasTranslations();
    }
}
