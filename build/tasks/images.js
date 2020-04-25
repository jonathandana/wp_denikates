const config = require('./inc/config');
const imagemin = require('gulp-imagemin');
const gulp = require("gulp");


module.exports = (gulp) => {

	gulp.task('images', () => {
		return gulp.src('./src/images/**/*')
			.pipe(imagemin())
			.pipe(gulp.dest(config.dist_folder + '/view/images/'));
	});

};