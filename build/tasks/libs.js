
const config = require('./inc/config'),
    gulp = require("gulp"),
    autoprefixer = require('gulp-autoprefixer'),
    minifyCSS = require('gulp-minify-css');

const paths = {
    'js' : [
        "node_modules/systemjs/dist/system.src.js",
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/masonry-layout/dist/masonry.pkgd.min.js",
        "src/js/lib/*.js"
    ],
    'css': [
        "src/css/lib/*.css"
    ],
    'fonts':'src/fonts/*'
};

module.exports = (gulp) => {

    gulp.task('libs:js',function(){
        return gulp.src(paths.js)
            .pipe(gulp.dest(config.dist_folder + '/view/js/lib/'));
    });

    gulp.task('libs:css',function(){
        return gulp.src(paths.css)
            .pipe(autoprefixer())
            .pipe(minifyCSS())
            .pipe(gulp.dest(config.dist_folder + '/view/css/lib/'));
    });

    gulp.task('libs:fonts',function(){
        return gulp.src(paths.fonts)
            .pipe(gulp.dest(config.dist_folder + '/view/fonts/'));
    });


};
