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
            init() {
                window.addEventListener('filament-color-picker:init', () => {
                    this.picker = window.FilamentColorPicker.make($wire, {
                        parent: document.getElementById('filament-color-picker'),
                        ...@js($getPickerOptions()),
                    });
                });
            },
        }"
    >
        <div
            id="filament-color-picker"
            class="flex mt-1 rounded-lg border border-gray-300 shadow-sm"
        >
            @includeWhen($getPreview(), 'filament-colorpicker::preview')
            <input
                type="text"
                x-model="color"
                {{
                    $attributes->class([
                        'color-picker-input',
                        'block w-full transition duration-75 border-0 focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70',
                        '!rvx-rounded-r-lg' => $getPreview(),
                        'rounded-lg' => !$getPreview(),
                    ])
                }}
                style="{{ $isPopupEnabled() ? '' : 'margin-bottom: 0.75rem' }}"
                readonly="{{ $isPopupEnabled() ? '' : 'readonly' }}"
                data-color-picker-field
            />
        </div>
    </div>
</x-forms::field-wrapper>
