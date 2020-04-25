const config = require('./inc/config'),
		gulp = require("gulp"),
		sass = require('gulp-sass'),
		util = require('gulp-util'),
		autoprefixer = require('gulp-autoprefixer'),
		minifyCSS = require('gulp-minify-css'),
		sourcemaps = require('gulp-sourcemaps');

const paths = ['./src/sass/main.scss','./src/sass/pages/*.scss'];

module.exports = (gulp) => {

	gulp.task('sass', () => {
		return gulp.src(paths)
			.pipe(sourcemaps.init())
			.pipe(sass().on('error', sass.logError))
			.pipe(autoprefixer())
			.pipe(minifyCSS())
            .pipe(sourcemaps.write('./maps'))
			.pipe(gulp.dest(config.dist_folder + '/view/css/'));
	});

	gulp.task('sass:watch', () => {
		return gulp.watch('./src/sass/**/*', ['sass']);
	});

};
