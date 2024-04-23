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
      xl: '1240px',
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
        dsfr: {
          blue: {
            DEFAULT: '#000091',
            hover: '#1212ff',
            active: '#2323ff',
          },
          lavande: {
            DEFAULT: '#99B3F9',
          },
          beige: {
            DEFAULT: '#f9f6f2',
            hover: '#eadecd',
            active: '#e1ceb1',
          },
          yellow: {
            DEFAULT: '#C3992A',
            hover: '#f5c137',
            active: '#fcd17b',
          },
        },
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
