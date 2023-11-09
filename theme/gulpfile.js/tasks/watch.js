'use strict';

const gulp = require('gulp');


module.exports = (config, mode) => {

  const php = require('./php')(config, mode);
  const imagemin = require('./imagemin')(config, mode);
  const styles = require('./styles')(config, mode);
  const webpack = require('./webpack')(config, mode);
  const jsLibs = require('./jsLibs')(config, mode);

  const watch = (cb) => {
    // php
    gulp.watch(config.path.src.php, php);
    // images
    gulp.watch(config.path.src.img, imagemin);
    // styles
    gulp.watch(config.path.src.scss, styles);
    // script
    gulp.watch(config.path.src.js, gulp.parallel(webpack, jsLibs));

    setTimeout(function(){
      cb();
    }, 250);

  };

  return watch;

};

