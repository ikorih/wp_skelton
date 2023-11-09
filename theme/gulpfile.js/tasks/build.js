'use strict';

const {
  series,
  parallel,
} = require('gulp');

module.exports = (config, mode) => {

  const php = require('./php')(config, mode);
  const copy = require('./copy')(config, mode);
  const imagemin = require('./imagemin')(config, mode);
  const styles = require('./styles')(config, mode);
  const webpack = require('./webpack')(config, mode);
  const jsLibs = require('./jsLibs')(config, mode);

  let tasks = [parallel(php, copy, imagemin, styles, webpack, jsLibs)];

  return series(tasks);

};
