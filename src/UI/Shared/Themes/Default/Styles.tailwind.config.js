const colors = require('tailwindcss/colors')

module.exports = {
    plugins: [
        require('postcss-import'),
        require('tailwindcss'),
        require('@tailwindcss/forms'),
        require('autoprefixer'),
    ],
    purge: {
      content: [
          './src/UI/**/Views/**/*.twig',
    ]},
    theme: {
        screens: {
            xs: '320px',
            sm: '480px',
            md: '768px',
            lg: '1200px',
            xl: '1440px',
        },
        extend: {
        }
    },
    variants: {
        extend: {},
    },
}
