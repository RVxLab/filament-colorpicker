<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;
use RVxLab\FilamentColorPicker\FilamentColorPickerServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            FilamentColorPickerServiceProvider::class,
        ];
    }
}
