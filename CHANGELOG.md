# Changelog

All notable changes to `filament-colorpicker` will be documented in this file.

## v1.4.1 - Add missing blade file - 2022-04-08

## What's Changed

- Added missing blade file

**Full Changelog**: https://github.com/RVxLab/filament-colorpicker/compare/1.4.0...1.4.1

## v1.4.0 - Nullable pickers - 2022-04-08

## What's Changed

### Added

- Add support for `null` values

### Fixed

- Fixed pickers with the popup disabled looking strange on larger screens

### Security

- Bump minimist from 1.2.5 to 1.2.6 by @dependabot in https://github.com/RVxLab/filament-colorpicker/pull/16

## New Contributors

- @dependabot made their first contribution in https://github.com/RVxLab/filament-colorpicker/pull/16

**Full Changelog**: https://github.com/RVxLab/filament-colorpicker/compare/1.3.3...1.4.0

## v1.3.3 - Dark Mode and more reliable script loading - 2022-03-28

### What's Changed

- Update colorpicker.blade.php by @invaders-xx in https://github.com/RVxLab/filament-colorpicker/pull/13
- Improve script loading by using a promise

### New Contributors

- @invaders-xx made their first contribution in https://github.com/RVxLab/filament-colorpicker/pull/13

**Full Changelog**: https://github.com/RVxLab/filament-colorpicker/compare/1.3.2...1.3.3

## v1.3.2 - Allow multiple ColorPicker fields - 2022-03-18

### Fixes

- Fixed the inability to have multiple ColorPicker fields in the same form

**Full Changelog**: https://github.com/RVxLab/filament-colorpicker/compare/1.3.1...1.3.2

## v1.3.1 - 2022-03-15

### Fixed

- fix: input not being initialized on simple resource modal by @saade in https://github.com/RVxLab/filament-colorpicker/pull/12

**Full Changelog**: https://github.com/RVxLab/filament-colorpicker/compare/1.3.0...1.3.1

## 1.3.0 - 2022-03-05

### Added

- Added a preview option by [@saade](https://github.com/saade) ([#11](https://github.com/RVxLab/filament-colorpicker/pull/11))

**Full Changelog**: https://github.com/RVxLab/filament-colorpicker/compare/1.2.1...1.3.0

## v1.2.1 - Fix dependencies and use of Js class - 2022-03-03

### Fixed

- `illuminate/contract` now correctly states `^8.70` for the `Js` class and use the full FQN to prevent issues with aliases (#10)

## 1.2.0 - 2022-01-28

- Add a swatch for use on tables ([#8](https://github.com/RVxLab/filament-colorpicker/pull/8))

Thanks to [@morganchorlton3](https://github.com/morganchorlton3) for adding this feature!

## 1.1.0 - 2022-01-26

- Add Laravel 9 support

## 1.0.0 - 2022-01-18

This release marks the first stable release of this package and targets Filament 2.x.

An upgrade guide can be found in the README.

- Update Filament dependency to `filament/filament:^2.0`
- Add support for the `template` option
- Allow the string representations of `EditorFormat` and `PopupPosition` to be passed as arguments to `editorFormat` and `popupPosition` respectively
- Add a debounce for updating the value when the popup is disabled
- Remove the ability to publish the JavaScript file

## 0.2.0 - 2021-07-11

- Improved handling for disabled popups
- Added validation and handling for RGB, RGBA, HSL and HSLA values
- Added some tests

## 0.1.0 - 2021-06-13

- First unstable release
