# Filament Color Picker

![Filament Color Picker](./banner.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rvxlab/filament-colorpicker.svg?style=flat-square)](https://packagist.org/packages/rvxlab/filament-colorpicker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rvxlab/filament-colorpicker/run-tests?label=tests)](https://github.com/rvxlab/filament-colorpicker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rvxlab/filament-colorpicker/Check%20&%20fix%20styling?label=code%20style)](https://github.com/rvxlab/filament-colorpicker/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rvxlab/filament-colorpicker.svg?style=flat-square)](https://packagist.org/packages/rvxlab/filament-colorpicker)

---

Filament Color Picker is a package for [Laravel Filament](https://github.com/laravel-filament/filament) that wraps [Vanilla Picker](https://github.com/Sphinxxxx/vanilla-picker) into a usable component.

## Installation

You can install the package via composer:

```bash
composer require rvxlab/filament-colorpicker
```

Then publish the assets:

```bash
php artisan vendor:publish --provider="RVxLab\FilamentColorPicker\FilamentColorPickerServiceProvider"
```

## Usage

Reference `RVxLab\FilamentColorPicker\ColorPicker` in the `forms` method of a resource and you're good to go! 

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            \RVxLab\FilamentColorPicker\ColorPicker::make('color'),
        ]);
}
```

### Editor format

***Default:*** `EditorFormat::HEX()`

Set the editor format of the color picker.

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            \RVxLab\FilamentColorPicker\ColorPicker::make('color')
                ->editorFormat(\RVxLab\FilamentColorPicker\EditorFormat::HSL()),
        ]);
}
```

### Popup placement

***Default:*** `PopupPosition::RIGHT()`

The popup placement can be set using `popupPosition`:

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            \RVxLab\FilamentColorPicker\ColorPicker::make('color')
                ->popupPosition(\RVxLab\FilamentColorPicker\PopupPosition::BOTTOM()),
        ]);
}
```

You can also disable the popup entirely in which the popup just becomes part of the element itself:

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            \RVxLab\FilamentColorPicker\ColorPicker::make('color')
                ->disablePopup(),
        ]);
}
```

### Alpha

***Default: true***

The alpha channel can be enabled or disabled by using `alpha`:

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            \RVxLab\FilamentColorPicker\ColorPicker::make('color')
                ->alpha(false),
        ]);
}
```

An important thing to note is that the alpha setting also changes the validation.

Having the alpha channel enabled will validate the output as an 8-digit hex string, disabling will validate it as a 6-digit hex string.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

For development this repository contains a Docker Compose file to provide all the tools needed, as well as a Makefile to run useful commands.

To make use of this, ensure you have Docker and Docker Compose installed.

To get started:

```bash
make dcbuild # Build the Docker image
make start # Run the container
make composer cmd=install
```

Additionally you can copy and modify `docker-compose.override.yml.dist` to add any additional changes needed for the workspace container.

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [RVxLab](https://github.com/RVxLab)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
