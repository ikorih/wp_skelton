'use strict';

const {
  src,
  dest
} = require('gulp');

const $ = require('gulp-load-plugins')();

module.exports = (config) => {
  const jsLibs = () => {
    return src([config.path.src.jsLibs + '**/*.*'])
      .pipe($.plumber({
        errorHandler: $.notify.onError('Error: <%= error.message %>')
      }))
      .pipe(dest(config.path.dest.jsLibs));
  };
  return jsLibs;
};
