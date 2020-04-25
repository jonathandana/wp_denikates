const config = require('./inc/config'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    util = require('gulp-util'),
    path = require('path'),
    sourcemaps = require('gulp-sourcemaps');

const paths = ['./src/js/*.js'];

module.exports = (gulp) => {

    gulp.task('js', () => {
        return gulp.src(paths)
            .pipe(uglify())
            .pipe(sourcemaps.write('./maps'))
            .pipe(gulp.dest(config.dist_folder + '/view/js/'));

});

    gulp.task('js:watch', () => {
        return gulp.watch('./src/js/*.js', ['js']);
});

};