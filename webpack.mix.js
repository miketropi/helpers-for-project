const mix = require('laravel-mix');
let productionSourceMaps = false;

mix
  .js('./src/main.js', 'dist/helpers-for-project.bundle.js')
  .sass('./src/scss/main.scss', 'css/helpers-for-project.bundle.css')
  .options({
    processCssUrls: false
  })
  .setPublicPath('dist')
  .sourceMaps(productionSourceMaps, 'source-map');