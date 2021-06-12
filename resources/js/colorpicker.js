import Picker from 'vanilla-picker';

const elements = document.querySelectorAll('[data-rvxlab-filament-colorpicker]');

for (const element of elements) {
    new Picker(element);
}
