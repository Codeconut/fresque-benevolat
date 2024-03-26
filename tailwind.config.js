import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    screens: {
      xxs: '375px',
      xs: '425px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1348px',
    },
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        sm: '1.5rem',
        xl: '2rem',
      },
    },
    extend: {
      colors: {
        'blue-france-sun-113': {
          DEFAULT: '#000091',
          hover: '#1212ff',
          active: '#2323ff',
        },
        'beige-gris-galet-975': {
          DEFAULT: '#f9f6f2',
          hover: '#eadecd',
          active: '#e1ceb1',
        },
        // 'grey-1000': {
        //   DEFAULT: '#ffffff',
        //   hover: '#f6f6f6',
        //   active: '#ededed',
        // },
      },
      fontFamily: {
        sans: [
          'Marianne',
          '-apple-system',
          // 'BlinkMacSystemFont', // Fait sauter des emojis ⚠️
          '"Segoe UI"',
          'Roboto',
          '"Helvetica Neue"',
          'Arial',
          '"Noto Sans"',
          'sans-serif',
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"',
        ],
        emoji: [
          'Marianne',
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"',
        ],
      },
    },
  },

  plugins: [forms, typography],
}
