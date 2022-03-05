import type Picker from 'vanilla-picker';

declare global {
    type ColorPickerOptions = {
        parent: HTMLElement;
        editorFormat: 'hsl' | 'hex' | 'rgb';
        popupPosition: 'top' | 'right' | 'bottom' | 'left' | null;
        alpha: boolean;
        layout: string;
        cancelButton: boolean;
        statePath: string;
        template: string | null;
        debounceTimeout: number;
        preview: boolean;
    };

    type ColorPicker = {
        Picker: Picker;
        value: string;
    };

    type ColorPickerMakeFunction = ($wire: unknown, options: ColorPickerOptions, initialValue: any) => ColorPicker;

    interface Window {
        FilamentColorPicker: {
            make: ColorPickerMakeFunction;
        };
    }
}

export {}
