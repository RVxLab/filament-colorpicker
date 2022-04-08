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

function createPreviewUpdated(shouldPreview: boolean, previewElement: HTMLElement | null): UpdatePreviewFunction {
    if (!shouldPreview || !previewElement) {
        return () => {
            // noop
        };
    }

    return (color: string) => {
        previewElement!.style.background = color;
    };
}

function createUpdater($wire: LivewireProxy, debounceTime: number): UpdateColorFunction {
    let updater: UpdateColorFunction = (statePath, color) => {
        $wire.set<ColorValue>(statePath, color);
    };

    if (debounceTime > 0) {
        updater = debounce(updater, debounceTime);
    }

    return updater;
}

function initializeClear(clearButton: HTMLButtonElement | null, pickerColor: ColorProxy): void {
    if (clearButton) {
        const clearInput = (e: MouseEvent) => {
            e.preventDefault();
            e.stopPropagation();

            pickerColor.value = null;

            return false;
        };

        clearButton.addEventListener('click', clearInput);
    }

    console.warn('Could not find clear button to bind to');
}

function make($wire: LivewireProxy, options: ExtendedOptions): Picker {
    const { parent, editorFormat, popupPosition, alpha, layout, cancelButton, statePath, template, debounceTimeout, preview, nullable } = options;

    const colorPickerInput = parent.querySelector<HTMLInputElement>('input[data-color-picker-field]');

    if (!colorPickerInput) {
        throw new Error('Could not find a color picker input to bind to');
    }

    const pickerColor = new Proxy<ColorProxy>({
        value: $wire.get<string | null>(statePath),
    }, {
        set(target, property: keyof ColorProxy, value: string | null) {
            target[property] = value;

            updateLivewireProperty(statePath, value);
            updatePreview(value ?? '#00000000');
            colorPickerInput.value = value ?? '';

            return true;
        },
    });

    const formatColor = getFormatter(editorFormat!, alpha!);

    const updateLivewireProperty = createUpdater(
        $wire,
        null === popupPosition ? debounceTimeout : 0,
    );

    const updatePreview = createPreviewUpdated(
        preview,
        parent.querySelector<HTMLElement>('[data-preview]'),
    );

    if (nullable) {
        initializeClear(
            parent.querySelector<HTMLButtonElement>('[data-color-picker-action="clear"]'),
            pickerColor,
        );
    }

    return new Picker({
        parent,
        editorFormat,
        popup: popupPosition || false,
        alpha,
        layout,
        cancelButton,
        template,
        color: pickerColor.value ?? '#00000000',
        onChange: color => {
            const newColor = formatColor(color);
            colorPickerInput.value = newColor;

            updatePreview(newColor);

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
