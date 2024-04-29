/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./public/**/*.{php,html,js}'],
  theme: {
    extend: {
      colors: {
        'primary': '#09090B',
        'text': '#27272A',
        'textun': '#71717A',
        'surface': '#FAFAFA',
        'background': '#FFFFFF',

      },
      fontFamily: {
        jakarta: ["Plus Jakarta Sans", "sans-serif"],
      },
    },
  },
  plugins: [],
}

