'use strict';

const { parallel, series } = require('gulp');

const $ = require('gulp-load-plugins')();
$.fs = require('fs');
$.yaml = require('js-yaml');

const mode = require('gulp-mode')({
  modes: ['production', 'development'],
  default: 'development',
  verbose: false
});

const isProduction = mode.production();

// configファイルを読み込み
const config = $.yaml.safeLoad($.fs.readFileSync('config/project.config.yml', 'utf8'));
// destRootとthemeNameを結合
config.destRoot = config.destRoot + config.themeName + '/';
// path.dest以下のすべての値とthemeNameを結合
for (let key in config.path.dest) {
    config.path.dest[key] = config.destRoot + config.path.dest[key];
}

const build = require('./tasks/build')(config, mode);
const browser = require('./tasks/browser')(config, mode);
const watch = require('./tasks/watch')(config, mode);
const styles = require('./tasks/styles')(config, mode);

exports.build = build;
exports.styles = styles;
exports.browser = browser;
exports.watch = watch;

if (isProduction) {
  exports.default = series(build, watch, browser);
} else {
  exports.default = parallel(build, watch, browser);
}

