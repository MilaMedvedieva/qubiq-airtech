const mix = require('laravel-mix');

mix.js('assets/src/js/app.js', 'assets/dist/js')
    .sass('assets/src/scss/app.scss', 'assets/dist/css')
    .copy('assets/src/images', 'assets/dist/images')
    .copy('assets/src/fonts', 'assets/dist/fonts')
    .options({
        processCssUrls: false,
        postCss: [require('tailwindcss')],

    })

mix.config.fileLoaderDirs.fonts = 'assets/dist/fonts';
mix.config.fileLoaderDirs.images = 'assets/dist/images';