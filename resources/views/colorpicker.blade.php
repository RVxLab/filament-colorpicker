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
            class="flex mt-1 rounded-md shadow-sm"
        >
            @if ($getPreview())
                <span class="items-center bg-white border border-r-0 border-gray-300 w-11 h-10inline-flex rounded-l-md sm:text-sm" :style="{ background: color }"></span>
            @endif
            <input
                type="text"
                x-model="color"
                {{
                    $attributes->class([
                        'block w-full transition duration-75 border-gray-300 focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70',
                        'rounded-none rounded-r-md border-l-0' => $getPreview(),
                        'rounded-md' => ! $getPreview(),
                    ])
                }}
                style="{{ $isPopupEnabled() ? '' : 'margin-bottom: 0.75rem' }}"
                readonly="{{ $isPopupEnabled() ? '' : 'readonly' }}"
                data-color-picker-field
            />
        </div>
    </div>
</x-forms::field-wrapper>
