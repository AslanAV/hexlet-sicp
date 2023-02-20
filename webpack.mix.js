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

mix
  .version()
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/custom.js', 'public/js')
  .js('resources/js/hljs.js', 'public/js/hljs.js')
  .js('resources/js/editor.js', 'public/js')
  .react()
  .sourceMaps()
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/_activity_chart.scss', 'public/css')
  .sass('resources/sass/_custom.scss', 'public/css')
  .copyDirectory('resources/assets/images', 'public/images')
  .copyDirectory('resources/assets/images/exercises', 'public/images/exercises');
// .then(() => {
//     const convertToFileHash = require("laravel-mix-make-file-hash");
//     convertToFileHash({
//     publicPath: "public",
//     manifestFilePath: "public/mix-manifest.json"
//     });
// });
