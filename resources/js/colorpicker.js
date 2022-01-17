import Picker from 'vanilla-picker';

const formatters = {
    hex: color => color.hex.slice(0, 7),
    hexa: color => color.hex,
    rgb: color => color.rgbString,
    rgba: color => color.rgbaString,
    hsl: color => color.hslString,
    hsla: color => color.hslaString,
};

function make($wire, options) {
    const { parent, editorFormat, popupPosition, alpha, layout, cancelButton, statePath, template } = options;

    const initialColor = $wire.get(statePath);

    const colorPickerInput = parent.querySelector('input[data-color-picker-field]');

    let formatterKey = editorFormat;

    if (alpha) {
        formatterKey += 'a';
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
            colorPickerInput.value = formatters[formatterKey](color);
        },
        onClose: color => {
            const newColor = formatters[formatterKey](color);
            $wire.set(statePath, newColor);
        },
    });
}

window.FilamentColorPicker = {
    make,
};

