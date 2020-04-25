const config = require('./inc/config'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	util = require('gulp-util'),
	path = require('path'),
	webpack = require('webpack');


module.exports = (gulp) => {


	gulp.task('ts', cb => tsTask(cb, false));
	gulp.task('ts:watch', cb => tsTask(cb, true));

	function tsTask(callback, watch) {
		const wpConfig = require('../webpack.config');
		wpConfig.watch = watch;

		webpack(wpConfig, (error, stats) => {
			if (error) {
				throw util.PluginError('webpack', error);
			}

			util.log(stats.toString({colors: true}));

		if (callback) {
			callback();
			callback = null;
		}
	});
	}
};