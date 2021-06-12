# A colorpicker package for Laravel Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rvxlab/filament-colorpicker.svg?style=flat-square)](https://packagist.org/packages/rvxlab/filament-colorpicker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rvxlab/filament-colorpicker/run-tests?label=tests)](https://github.com/rvxlab/filament-colorpicker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rvxlab/filament-colorpicker/Check%20&%20fix%20styling?label=code%20style)](https://github.com/rvxlab/filament-colorpicker/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rvxlab/filament-colorpicker.svg?style=flat-square)](https://packagist.org/packages/rvxlab/filament-colorpicker)

**TODO: Add a description**

## Installation

You can install the package via composer:

```bash
composer require rvxlab/filament-colorpicker
```

## Usage

**TODO**

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
