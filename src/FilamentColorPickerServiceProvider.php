<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class FilamentColorPickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-colorpicker')
            ->hasAssets()
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        $this->app->register(FilamentPluginServiceProvider::class);
    }
}
