<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        wire:ignore
        x-data="{
            color: $wire.entangle('{{ $getStatePath() }}'),
            picker: undefined,
            get scriptLoaded() {
                return Promise.race([
                    new Promise(resolve => {
                        window.addEventListener('filament-color-picker:init', resolve, {
                            once: true,
                        });
                    }),
                    new Promise(resolve => {
                        const intervalId = window.setInterval(() => {
                            if (window.FilamentColorPicker) {
                                window.clearInterval(intervalId);

                                resolve();
                            }
                        }, 250);
                    }),
                ]);
            },
            init() {
                this.scriptLoaded.then(() => {
                    this.picker = window.FilamentColorPicker.make($wire, {
                        parent: $refs.colorPicker,
                        ...@js($getPickerOptions()),
                    });
                });
            },
        }"
    >
        <div
            x-ref="colorPicker"
            class="color-picker flex flex-wrap mt-1 shadow-sm"
        >
            @includeWhen($getPreview(), 'filament-colorpicker::preview')

            <input
                type="text"
                x-model="color"
                {{
                    $attributes->class([
                        'color-picker-input',
                        'block transition duration-75 border border-gray-300 focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70',
                        'dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),
                        'border-gray-300' => !$errors->has($getStatePath()),
                        'dark:border-gray-600' => !$errors->has($getStatePath()) && config('forms.dark_mode'),
                        'border-danger-600 ring-danger-600' => $errors->has($getStatePath()),
                        '!rvx-rounded-r-lg flex-1 border-l-0' => $getPreview(),
                        'rounded-lg w-full' => !$getPreview(),
                    ])
                }}
                style="{{ $isPopupEnabled() ? '' : 'margin-bottom: 0.75rem' }}"
                readonly="{{ $isPopupEnabled() ? '' : 'readonly' }}"
                data-color-picker-field
            />
        </div>
    </div>
</x-forms::field-wrapper>
