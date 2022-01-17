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
                $nextTick(() => {
                    this.picker = window.FilamentColorPicker.make($wire, {
                        parent: document.getElementById('{{ $getId() }}_picker'),
                        ...{{ Js::from([
                            'editorFormat' => $getEditorFormat()->getValue(),
                            'popupPosition' => $getPopupPosition()?->getValue(),
                            'alpha' => $getAlpha(),
                            'layout' => $getLayout(),
                            'cancelButton' => $getCancelButton(),
                            'statePath' => $getStatePath(),
                            'template' => $getTemplate(),
                        ]) }},
                    });
                });
            },
        }"
    >
        <div
            id="{{ $getId() }}_picker"
        >
            <input
                type="text"
                x-model="color"
{{--                class="block w-full placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-100 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 {{ $errors->has($formComponent->getName()) ? 'border-danger-600 motion-safe:animate-shake' : 'border-gray-300' }}"--}}
                class="block w-full placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-100 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                style="{{ $isPopupEnabled() ? 'margin-bottom: 0.75rem' : '' }}"
                readonly="{{ $isPopupEnabled() ? '' : 'readonly' }}"
                data-color-picker-field
            />
        </div>
    </div>
</x-forms::field-wrapper>
