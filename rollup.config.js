import commonjs from "@rollup/plugin-commonjs";
import { nodeResolve } from '@rollup/plugin-node-resolve';
import { terser } from "rollup-plugin-terser";

const inProduction = process.env.BUILD === 'production';

export default {
    input: 'resources/js/colorpicker.js',
    output: {
        file: 'resources/dist/filament-colorpicker.js',
        format: 'iife',
    },
    plugins: [
        nodeResolve(),
        commonjs(),
        inProduction && terser(),
    ],
};
