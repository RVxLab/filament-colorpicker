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
    const { parent, editorFormat, popupPosition, alpha, layout, cancelButton, statePath, template, debounceTimeout, preview } = options;

    const initialColor = $wire.get<string>(statePath);

    const colorPickerInput = parent.querySelector<HTMLInputElement>('input[data-color-picker-field]');

    if (!colorPickerInput) {
        throw new Error('Could not find a color picker input to bind to');
    }

    const formatColor = getFormatter(editorFormat!, alpha!);

    let updateLivewireProperty = function (color: string) {
        $wire.set<string>(statePath, color);
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

    return new Picker({
        parent,
        editorFormat,
        popup: popupPosition || false,
        alpha,
        layout,
        cancelButton,
        template,
        color: initialColor,
        onChange: color => {
            let newColor = formatColor(color);
            colorPickerInput.value = newColor;

            updatePreview(newColor);

            if (null === popupPosition) {
                updateLivewireProperty(newColor);
            }
        },
        onClose: color => {
            const newColor = formatColor(color);

            updateLivewireProperty(newColor);
        },
    });
}

window.FilamentColorPicker = {
    make,
};

window.dispatchEvent(new CustomEvent('filament-color-picker:init'));
