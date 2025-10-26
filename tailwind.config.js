/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': [
                'Inter', 
                'ui-sans-serif', 
                'system-ui', 
                '-apple-system', 
                'Segoe UI', 
                'Roboto', 
                'Helvetica Neue', 
                'Arial', 
                'sans-serif'
              ],
        'serif': ['Lora', 'Georgia', 'Cambria', 'Times New Roman', 'Times', 'serif'],
        'display': ['Playfair Display', 'Lora', 'Georgia', 'serif'],
      },
      colors: {
        // Minimalist professional palette
        cream: {
          50: '#fdfbf7',
          100: '#f8f4ed',
          200: '#f1e8d9',
          300: '#e8dac3',
          400: '#dcc9a3',
          500: '#c9b18a',
          600: '#b59872',
          700: '#9a7d5d',
          800: '#7d654a',
          900: '#65503c',
        },
        charcoal: {
          50: '#f6f6f6',
          100: '#e7e7e7',
          200: '#d1d1d1',
          300: '#b0b0b0',
          400: '#888888',
          500: '#6d6d6d',
          600: '#5d5d5d',
          700: '#4f4f4f',
          800: '#454545',
          900: '#3d3d3d',
          950: '#1a1a1a',
        },
        terracotta: {
          50: '#fdf5f3',
          100: '#fbe8e4',
          200: '#f8d5cd',
          300: '#f2b7a8',
          400: '#e98f79',
          500: '#dd6b4f',
          600: '#ca5136',
          700: '#a93f2a',
          800: '#8c3726',
          900: '#753325',
        },
        olive: {
          50: '#f7f8f3',
          100: '#edeee3',
          200: '#dbdec8',
          300: '#c3c8a5',
          400: '#a8ae7f',
          500: '#8d9461',
          600: '#70774c',
          700: '#585d3e',
          800: '#484c35',
          900: '#3d402f',
        },
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.5s ease-out',
        'slide-down': 'slideDown 0.3s ease-out',
        'scale-in': 'scaleIn 0.3s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideDown: {
          '0%': { transform: 'translateY(-10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        scaleIn: {
          '0%': { transform: 'scale(0.9)', opacity: '0' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
      },
    }
  },
  plugins: [
    require('flowbite/plugin'),
    require('flowbite-typography'),
    require('@tailwindcss/typography'),
  ]
}