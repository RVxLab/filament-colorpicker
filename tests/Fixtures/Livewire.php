<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Tests\Fixtures;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

/**
 * @link https://github.com/laravel-filament/filament/blob/2.x/tests/src/Forms/Fixtures/Livewire.php
 */
final class Livewire extends Component implements HasForms
{
    use InteractsWithForms;

    /** @var mixed */
    public $data;

    public static function make(): static
    {
        return new static();
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
