import '../css/colorpicker.css';

import Picker from 'vanilla-picker';
import { debounce } from 'lodash';

const formatters = {
    hex: color => color.hex.slice(0, 7),
    hexa: color => color.hex,
    rgb: color => color.rgbString,
    rgba: color => color.rgbaString,
    hsl: color => color.hslString,
    hsla: color => color.hslaString,
};

function make($wire, options) {
    const { parent, editorFormat, popupPosition, alpha, layout, cancelButton, statePath, template, debounceTimeout, preview } = options;

    const initialColor = $wire.get(statePath);

    const colorPickerInput = parent.querySelector('input[data-color-picker-field]');

    let formatterKey = editorFormat;

    if (alpha) {
        formatterKey += 'a';
    }

    let updateLivewireProperty = function (color) {
        $wire.set(statePath, color);
    };

    if (null === popupPosition) {
        updateLivewireProperty = debounce(updateLivewireProperty, debounceTimeout);
    }

    let updatePreview = function (color) {
        // noop
    };

    let previewElement = parent.querySelector('[data-preview]');

    if (preview && previewElement) {
        updatePreview = function (color) {
            previewElement.style.background = color;
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
            let newColor = formatters[formatterKey](color);
            colorPickerInput.value = newColor;

            updatePreview(newColor);

            if (null === popupPosition) {
                updateLivewireProperty(newColor);
            }
        },
        onClose: color => {
            const newColor = formatters[formatterKey](color);

            updateLivewireProperty(newColor);
        },
    });
}

window.FilamentColorPicker = {
    make,
};

window.dispatchEvent(new CustomEvent('filament-color-picker:init'));
