const mix = require('laravel-mix');

mix.disableNotifications();

mix.postCss("src/UI/Backend/Views/BackendLayout.css", "public/static/backend.css", [
    require("tailwindcss"),
]);

mix.postCss("src/UI/Frontend/Views/FrontendLayout.css", "public/static/frontend.css", [
    require("tailwindcss"),
]);
