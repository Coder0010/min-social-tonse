const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/app.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .vue({ version: 2 })
    ;

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.css$\.scss$/i,
                use: ['style-loader', 'css-loader'],
            },
        ],
    },
});
mix.browserSync('127.0.0.1:8000');
