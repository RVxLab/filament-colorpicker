import commonjs from '@rollup/plugin-commonjs';
import { nodeResolve } from '@rollup/plugin-node-resolve';
import { terser } from 'rollup-plugin-terser';
import postcss from 'rollup-plugin-postcss';
import { resolve } from 'path';
import autoprefixer from 'autoprefixer';
import tailwindcss from 'tailwindcss';
import typescript from '@rollup/plugin-typescript';

const inProduction = process.env.BUILD === 'production';

export default {
    input: 'resources/js/colorpicker.ts',
    output: {
        file: 'resources/dist/filament-colorpicker.js',
        format: 'iife',
    },
    plugins: [
        nodeResolve(),
        commonjs(),
        inProduction && terser(),
        postcss({
            plugins: [
                autoprefixer(),
                tailwindcss(),
            ],
            extract: resolve(__dirname, 'resources', 'dist', 'filament-colorpicker.css'),
            minimize: inProduction,
        }),
        typescript(),
    ],
};
