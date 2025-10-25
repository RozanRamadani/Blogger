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
                'Noto Sans', 
                'sans-serif', 
                'Apple Color Emoji', 
                'Segoe UI Emoji', 
                'Segoe UI Symbol', 
                'Noto Color Emoji'
              ],
        'body': [
              'Inter', 
              'ui-sans-serif', 
              'system-ui', 
              '-apple-system', 
              'Segoe UI', 
              'Roboto', 
              'Helvetica Neue', 
              'Arial', 
              'Noto Sans', 
              'sans-serif', 
              'Apple Color Emoji', 
              'Segoe UI Emoji', 
              'Segoe UI Symbol', 
              'Noto Color Emoji'
              ],
        'serif': ['Lora', 'Georgia', 'Cambria', 'Times New Roman', 'Times', 'serif'],
      },
      colors: {
        primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"},
        accent: {"50":"#fdf2f8","100":"#fce7f3","200":"#fbcfe8","300":"#f9a8d4","400":"#f472b6","500":"#ec4899","600":"#db2777","700":"#be185d","800":"#9d174d","900":"#831843"}
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
  ],
  safelist: [
    { pattern: /bg-(blue|green|purple|red|yellow|indigo|pink)-(100|200|800|900)/ },
    { pattern: /text-(blue|green|purple|red|yellow|indigo|pink)-(100|200|800|900)/ },
    { pattern: /dark:bg-(blue|green|purple|red|yellow|indigo|pink)-(100|200|800|900)/ },
    { pattern: /dark:text-(blue|green|purple|red|yellow|indigo|pink)-(100|200|800|900)/ },
  ]
}