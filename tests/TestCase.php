<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorpicker\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;
use RVxLab\FilamentColorpicker\FilamentColorpickerServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            FilamentColorpickerServiceProvider::class,
        ];
    }
}
