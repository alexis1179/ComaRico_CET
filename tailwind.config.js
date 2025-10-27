/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      backgroundImage: {
        'login_img': "url('/public/assets/login_img.jfif')",
        'login_negocio_img': "url('/public/assets/login_negocio.jpg')",
        'banner_img': "url('/public/assets/banner_img.jpg')",
      },
      colors: {
      'color-main': '#D88441',
      'color-secondary': '#151F21',
      'color-bg': '#0B161A'
    },
    },
  },
  plugins: [],
}
