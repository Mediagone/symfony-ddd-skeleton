const mix = require('laravel-mix');

mix.disableNotifications();

mix.postCss("src/UI/Shared/Themes/Default/Styles.css", "public/static/styles.css", [
    require('tailwindcss')('src/UI/Shared/Themes/Default/Styles.tailwind.config.js')
]);
