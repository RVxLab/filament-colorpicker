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
        x-data="{
            picker: null,
            state: $wire.entangle('{{ $getStatePath() }}'),
            formatters: {
                hex: color => color.hex.slice(0, 7),
                hexa: color => color.hex,
                rgb: color => color.rgbString,
                rgba: color => color.rgbaString,
                hsl: color => color.hslString,
                hsla: color => color.hslaString,
            },
            value: '',
        }"
        x-init="() => {
            value = state.value || '';
            $nextTick(() => {
                picker = new FilamentColorPicker.Picker({
                    ...state,
                    parent: document.getElementById('{{ $getId() }}_picker'),
                    color: value,
                    onChange: function (color) {
                        let editorFormat = state.options.editorFormat;

                        if (state.options.alpha) {
                            editorFormat += 'a';
                        }

                        const formatter = formatters[editorFormat];

                        if (!formatter) {
                            throw new Error(`Unknown formatter for editor format ${editorFormat}`);
                        }

                        value = formatters[editorFormat](color);
                    },
                    onClose: function () {
                        console.log(value);
                    },
                });
            })
        }"
    >
        <div
            id="{{ $getId() }}_picker"
        >
            <input
                x-model="value"
                type="text"
{{--                class="block w-full placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-100 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 {{ $errors->has($formComponent->getName()) ? 'border-danger-600 motion-safe:animate-shake' : 'border-gray-300' }}"--}}
                class="block w-full placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-100 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                :style="state.options.popupEnabled ? 'margin-bottom: 0.75rem' : ''"
                :readonly="!state.options.popupEnabled"
            />
        </div>
    </div>
</x-forms::field-wrapper>
