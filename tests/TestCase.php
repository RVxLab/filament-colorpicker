<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests;

use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Illuminate\Foundation\Application;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RVxLab\FilamentColorPicker\FilamentColorPickerServiceProvider;
use Spatie\LaravelRay\RayServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            RayServiceProvider::class,
            LivewireServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            FilamentColorPickerServiceProvider::class,
        ];
    }
}
