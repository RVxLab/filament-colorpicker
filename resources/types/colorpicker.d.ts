import Picker, { Color, Options, EditorFormat } from 'vanilla-picker';

// Re-exports so they can be imported
declare module 'vanilla-picker' {
    export interface Color {
        rgba: number[];
        hsla: number[];
        rgbString: string;
        rgbaString: string;
        hslString: string;
        hslaString: string;
        hex: string;
    }

    export type ColorCallback = (color: Color) => void;

    export type EditorFormat = 'hex' | 'hsl' | 'rgb';

    export interface Options {
        parent?: HTMLElement;
        popup?: 'top' | 'bottom' | 'left' | 'right' | false;
        template?: string;
        layout?: string;
        alpha?: boolean;
        editor?: boolean;
        editorFormat?: EditorFormat;
        cancelButton?: boolean;
        color?: string;
        onChange?: ColorCallback;
        onDone?: ColorCallback;
        onOpen?: ColorCallback;
        onClose?: ColorCallback;
    }

    export type Configuration = Options | HTMLElement;
}

declare global {
    type LivewireProxy = {
        set<T = any>(property: string, value: T): void;
        get<T = any>(property: string): T;
    };

    type ColorPickerMakeFunction = ($wire: LivewireProxy, options: ExtendedOptions, initialValue: any) => Picker;

    type FormatterKey = `${EditorFormat}a` | EditorFormat;
    type FormatterFunction = (color: Color) => string;
    type Formatters = Record<FormatterKey, FormatterFunction>;

    type ExtendedOptions = Options & {
        parent: HTMLElement,
        popupPosition: 'top' | 'right' | 'bottom' | 'left' | null;
        statePath: string;
        template: string | null;
        debounceTimeout: number;
        preview: boolean;
    };

    type UpdateColorFunction = (color: string) => void;

    interface Window {
        FilamentColorPicker: {
            make: ColorPickerMakeFunction;
        };
    }
}

export {}
