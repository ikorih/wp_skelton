'use strict';

const {
  src,
  dest
} = require('gulp');

const $ = require('gulp-load-plugins')();
$.browserSync = require('browser-sync');

module.exports = (config) => {
  console.log(config.path.dest.php);
  const php = () => {
    return src([config.path.src.php + '**/*.*'])
      .pipe($.plumber({
        errorHandler: $.notify.onError('Error: <%= error.message %>')
      }))
      .pipe(dest(config.path.dest.php))
      .pipe(
        $.browserSync.reload({
          stream: true
        })
      );
  };
  return php;
};
