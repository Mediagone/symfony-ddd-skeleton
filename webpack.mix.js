const mix = require('laravel-mix');

mix.disableNotifications();

mix.postCss("src/Application/Shared/Themes/Default/Styles.css", "public/static/styles.css", [
    require('tailwindcss')('src/Application/Shared/Themes/Default/Styles.tailwind.config.js')
]);
