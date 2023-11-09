'use strict';

const browserSync = require('browser-sync');

module.exports = (config) => {
  const browser = (cb) => {
    const files = [
      '**/*.php',
      '**/*.{png,jpg,gif,svg}'
    ];
    browserSync.init(files, {
      injectChanges: config.browserSync.injectChanges,
      proxy: config.project.projectURL,
      port: config.server.port,
      open: config.server.open
    });
    cb();
  };
  return browser;
};

