'use strict';

const {
  src,
  dest
} = require('gulp');

const $ = require('gulp-load-plugins')();
$.browserSync = require('browser-sync');
$.reload = $.browserSync.reload;
$.webpackStream = require('webpack-stream');
$.webpack = require('webpack');

module.exports = (config, mode) => {

  const webpack = () => {
    const modeName = mode.production() ? 'production' : 'development';
    return src(config.webpack.entry_point, {allowEmpty: true})
      .pipe($.plumber({ // plumberを追加
        errorHandler: $.notify.onError('Error: <%= error.message %>'),
      }))
      .pipe($.webpackStream({
        entry: {
          app: config.webpack.entry_point,
          // page: config.webpack.page # このように複数のエントリーを指定可能
        },
        output: {
          path: __dirname + '/dist/js',
          filename: '[name].bundle.js'
        },
        // モード値を production に設定すると最適化された状態で、
        // development に設定するとソースマップ有効でJSファイルが出力される
        mode: modeName,
        module: {
          rules: [{
            enforce: 'pre',
            test: /\.js$/,
            exclude: /node_modules/,
            use: [{
              loader: 'eslint-loader',
              options: {
                failOnError: true,
              }
            }]
          }, {
            test: /\.js$/,
            use: [{
              // Babel を利用する
              loader: 'babel-loader',
              // Babel のオプションを指定する
              options: {
                presets: ['@babel/preset-env']
              }
            }],
          }, ],
        },
        externals: {
          jquery: 'jQuery'
        },
      }))
      .pipe(dest(config.path.dest.js))
      .pipe($.reload({
        stream: true
      }));
  };
  return webpack;
};


