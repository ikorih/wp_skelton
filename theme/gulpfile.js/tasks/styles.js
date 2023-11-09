'use strict';

const { src, dest } = require('gulp');

const $ = require('gulp-load-plugins')();
$.browserSync = require('browser-sync');

module.exports = (config, mode) => {
  const styles = () => {
    return (
      src([config.path.src.scss + '*.scss'])
        .pipe(
          $.plumber({
            errorHandler: $.notify.onError('Error: <%= error.message %>')
          })
        )
        .pipe(mode.development($.sourcemaps.init()))
        .pipe(mode.development(
          $.dartSass({
            outputStyle: 'expanded'
          })
        ))
        .pipe(mode.production(
          $.dartSass({
            outputStyle: 'compressed'
          })
        ))
        // ベンダープレフィックスを追加
        .pipe(mode.production($.autoprefixer()))
        // ソースマップ出力
        .pipe(mode.development($.sourcemaps.write('./')))
        .pipe(dest(config.path.dest.css))
        .pipe(
          $.browserSync.reload({
            stream: true
          })
        )
    );
  };
  return styles;
};

