/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["**/*.{html,js,php}",
  'node_modules/preline/dist/*.js'],
  theme: {
    extend: {keyframes: {
      wiggle: {
        '0%, 100%': { transform: 'rotate(-3deg)' },
        '50%': { transform: 'rotate(3deg)',borderColor: '#3b82f6' },
      }
    },
      animation: {
        wiggle: 'wiggle 1s ease-in-out infinite',
      }

    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('preline/plugin')],
}

