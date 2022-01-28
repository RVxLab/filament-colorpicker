<?php

declare(strict_types=1);

namespace RVxLab\FilamentColorPicker\Columns;

use Filament\Tables\Columns\Column;

class ColorSwatch extends Column
{
    protected string $view = 'filament-colorpicker::color-swatch';

    protected bool $copyable = false;

    protected ?string $copyMessage = null;

    protected int $copyMessageShowTimeMs = 2000;

    public function copyable(): self
    {
        $this->copyable = true;

        return $this;
    }

    public function copyMessage(string $message): self
    {
        $this->copyMessage = $message;

        return $this;
    }

    public function getCopyMessage(): string
    {
        return $this->copyMessage ?? trans('filament-colorpicker::swatch.copied_message');
    }

    public function copyMessageShowTimeMs(int $timeInMs): self
    {
        $this->copyMessageShowTimeMs = $timeInMs;

        return $this;
    }

    public function getCopyMessageShowTimeMs(): int
    {
        return $this->copyMessageShowTimeMs;
    }

    public function isCopyable(): bool
    {
        return $this->copyable;
    }
}
