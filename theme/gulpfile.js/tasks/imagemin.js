'use strict';

const gulp = require('gulp');
const $ = require('gulp-load-plugins')();

module.exports = (config) => {
  const imagemin = () => {
    return gulp.src(config.path.src.img + '**/*', {
        since: gulp.lastRun(imagemin)
      })
      .pipe($.imagemin([
        $.imagemin.gifsicle({interlaced: true}),
        $.imagemin.mozjpeg({quality: 75, progressive: true}),
        $.imagemin.optipng({optimizationLevel: 5}),
        $.imagemin.svgo({
          plugins: [
            {removeViewBox: false},
            {cleanupIDs: true}
          ]
        })
      ], {
        verbose: true
      }))
      .pipe(gulp.dest(config.path.dest.img));
  };
  return gulp.series(imagemin);
};

