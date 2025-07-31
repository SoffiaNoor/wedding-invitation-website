/** @type {import('tailwindcss').Config} */
import defaultTheme from 'tailwindcss/defaultTheme'

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        raleway: ['Raleway', ...defaultTheme.fontFamily.sans],
        monsieur: ['"Monsieur La Doulaise"', 'cursive'],
        rouge: ['"Rouge Script"', 'cursive'],
        dmSerif: ['"DM Serif Text"', ...defaultTheme.fontFamily.serif],
        brittany: ['"Brittany Signature"', 'sans-serif'],
      },
    },
    screen: {
      'gt-lg': '1025px'
    }
  },
  plugins: [],
}

