'use strict';

const {
  src,
  dest
} = require('gulp');

const $ = require('gulp-load-plugins')();

module.exports = (config) => {
  const copy = () => {
    return src([config.path.src.static + '**/*.*'])
      .pipe($.plumber({
        errorHandler: $.notify.onError('Error: <%= error.message %>')
      }))
      .pipe(dest(config.destRoot));
  };
  return copy;
};

