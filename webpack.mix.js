const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .postCss('resources/css/common.css', 'public/css', [
    ])
    .postCss('resources/css/layout.css', 'public/css', [
    ])
    .postCss('resources/css/project/project.css', 'public/css', [
    ])
    .postCss('resources/css/project/todo.css', 'public/css', [
    ])
    .disableNotifications({
        watchOptions: {
            ignored: /node_modules/
        }
    });
