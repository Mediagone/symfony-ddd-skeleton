const mix = require('laravel-mix');

mix.disableNotifications();


mix.postCss("src/UI/Shared/Themes/Default/Default.css", "public/static/styles.css", [
    require("tailwindcss"),
]);
