import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*Table.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
    ],
 presets: [
      //  require("./vendor/wireui/wireui/tailwind.config.js"),
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"), 
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
              //   "pg-primary": colors.gray, 
                //primaryColor: '#f97316', //
                //secondaryColor: '#ffedd5', //#22d3ee
                
                primaryColor: '#f97316',
                secondaryColor: '#b3370f',
                tertiaryColor: 'bg-orange-100',
                fourthColor:'#080941',
                fifthColor:'#012c8d'

            },
        },
    },

    plugins: [forms],
};
