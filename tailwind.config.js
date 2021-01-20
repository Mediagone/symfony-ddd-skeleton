module.exports = {
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
    ],
    purge: {
      enabled: true,
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
    },
    variants: {
        extend: {},
    },
}
