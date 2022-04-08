/// <reference path="../types/colorpicker.d.ts" />
import '../css/colorpicker.css';

import { debounce } from 'lodash';
import Picker from 'vanilla-picker';
import type { EditorFormat } from 'vanilla-picker';

const formatters: Formatters = {
    hex: color => color.hex.slice(0, 7),
    hexa: color => color.hex,
    rgb: color => color.rgbString,
    rgba: color => color.rgbaString,
    hsl: color => color.hslString,
    hsla: color => color.hslaString,
};

function getFormatter(editorFormat: EditorFormat, alpha: boolean): FormatterFunction {
    const key: FormatterKey = alpha ? `${editorFormat}a` : editorFormat;

    return formatters[key];
}

function make($wire: LivewireProxy, options: ExtendedOptions): Picker {
    const { parent, editorFormat, popupPosition, alpha, layout, cancelButton, statePath, template, debounceTimeout, preview, nullable } = options;

    const pickerColor = new Proxy<ColorProxy>({
        value: $wire.get<string | null>(statePath),
    }, {
        set(target, property: keyof ColorProxy, value: string | null) {
            target[property] = value;

            updateLivewireProperty(value);
            updatePreview(value ?? '#00000000');
            colorPickerInput!.value = value ?? '';

            return true;
        },
    });

    const colorPickerInput = parent.querySelector<HTMLInputElement>('input[data-color-picker-field]');

    if (!colorPickerInput) {
        throw new Error('Could not find a color picker input to bind to');
    }

    const formatColor = getFormatter(editorFormat!, alpha!);

    let updateLivewireProperty = function (color: string | null) {
        $wire.set<string | null>(statePath, color);
    };

    if (null === popupPosition) {
        updateLivewireProperty = debounce(updateLivewireProperty, debounceTimeout);
    }

    let updatePreview: UpdateColorFunction = function () {
        // noop
    };

    let previewElement = parent.querySelector<HTMLElement>('[data-preview]');

    if (preview && previewElement) {
        updatePreview = function (color: string) {
            previewElement!.style.background = color;
        };
    }

    if (nullable) {
        const clearButton = parent.querySelector<HTMLButtonElement>('[data-color-picker-action="clear"]');

        if (!clearButton) {
            console.warn('Could not find clear button to bind to');
        } else {
            clearButton.addEventListener('click', function clearInput(e) {
                e.preventDefault();
                e.stopPropagation();

                pickerColor.value = null;

                return false;
            });
        }
    }

    return new Picker({
        parent,
        editorFormat,
        popup: popupPosition || false,
        alpha,
        layout,
        cancelButton,
        template,
        color: pickerColor.value ?? '#000000',
        onChange: color => {
            const newColor = formatColor(color);
            colorPickerInput.value = newColor;

            if (null === popupPosition) {
                pickerColor.value = newColor;
            }
        },
        onClose: color => {
            pickerColor.value = formatColor(color);
        },
    });
}

window.FilamentColorPicker = {
    make,
};

window.dispatchEvent(new CustomEvent('filament-color-picker:init'));
