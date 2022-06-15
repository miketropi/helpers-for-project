const mix = require('laravel-mix');

mix
  .js('./src/main.js', 'dist/helpers-for-project.bundle.js')
  .sass('./src/scss/main.scss', 'css/helpers-for-project.bundle.css')
  .setPublicPath('dist')