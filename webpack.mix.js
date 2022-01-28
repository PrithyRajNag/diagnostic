const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").js(
    "resources/js/main.js",
    "public/js",
).js("resources/js/quillPdf.js","public/js")
// .postCss('resources/css/app.css', 'public/css', [
//     //
// ]);

// mix.js("resources/js/app.js", "public/assets/js")
//     .js("resources/js/main.js", "public/assets/js")
//     .js("resources/js/feather-icon.js", "public/assets/js")
//    .options({
//     processCssUrls: false
// })
//     .sass("resources/scss/app.scss", "public/assets/css").setPublicPath("public");
