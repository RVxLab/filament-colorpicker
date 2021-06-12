<x-forms::field-group
    :column-span="$formComponent->getColumnSpan()"
    :error-key="$formComponent->getName()"
    :for="$formComponent->getId()"
    :help-message="$formComponent->getHelpMessage()"
    :hint="$formComponent->getHint()"
    :label="$formComponent->getLabel()"
    :required="$formComponent->isRequired()"
>
    <div
        x-data="{
            value: @entangle($formComponent->getName()){{ Str::of($formComponent->getBindingAttribute())->after('wire:model') }},
            picker: null,
        }"
        x-init="picker = new FilamentColorPicker.Picker({
            parent: document.querySelector('#{{ $formComponent->getId() }}'),
            popup: 'bottom',
            alpha: false,
            editorFormat: 'hex',
            color: value,
            onChange: function (color) {
                value = color.hex.slice(0, 7);
            }
        })"
        id="{{ $formComponent->getId() }}"
    >
        <input
            {!! $formComponent->isDisabled() ? 'disabled' : null !!}
            {!! $formComponent->getId() ? "id=\"{$formComponent->getId()}\"" : null !!}
            {!! $formComponent->isRequired() ? 'required' : null !!}
            x-model="value"
            type="text"
            class="block w-full placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-100 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 {{ $errors->has($formComponent->getName()) ? 'border-danger-600 motion-safe:animate-shake' : 'border-gray-300' }}"
            {!! Filament\format_attributes($formComponent->getExtraAttributes()) !!}
        />
    </div>
</x-forms::field-group>
