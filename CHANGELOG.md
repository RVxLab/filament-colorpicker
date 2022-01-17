# Changelog

All notable changes to `filament-colorpicker` will be documented in this file.

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
