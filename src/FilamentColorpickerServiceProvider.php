<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorpicker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class FilamentColorpickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-colorpicker')
            ->hasViews();
    }
}
