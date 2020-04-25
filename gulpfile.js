const gulp = require("gulp");

require('./build/tasks/js')(gulp);
require('./build/tasks/ts')(gulp);
require('./build/tasks/libs')(gulp);
require('./build/tasks/sass')(gulp);
require('./build/tasks/images')(gulp);


gulp.task('serve', ['sass:watch','ts:watch','js:watch','build']);

gulp.task('build', ['ts','libs:js','libs:fonts','libs:css', 'sass', 'images','js']);

gulp.task("default", ['serve']);
