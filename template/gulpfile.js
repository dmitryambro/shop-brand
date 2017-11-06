'use strict';

var gulp = require('gulp');
var jade = require('jade');
var gulp_sass = require('gulp-sass');
var gulp_sass_autoprefixer = require('gulp-autoprefixer');
var gulp_jade = require('gulp-jade');

gulp.task('sass', function () {
    return gulp.src('./dev/sass/*.sass')
        .pipe(gulp_sass().on('error', gulp_sass.logError))
        .pipe(gulp.dest('./prod/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch(['./dev/sass/**/*.sass', './dev/sass/*.sass'], ['sass']);
});

gulp.task('autoprefix', function () {
   return gulp.src('./prod/css/*.css')
       .pipe(gulp_sass_autoprefixer({
           browsers: ['last 2 versions'],
           cascade: false
       }))
       .pipe(gulp.dest('./dist/prod/css'));
});

gulp.task('autoprefix:watch', function () {
    gulp.watch(['./prod/css/*.css'], ['autoprefix']);
});

gulp.task('templates', function () {
    return gulp.src('./dev/jade/*.jade')
        .pipe(gulp_jade({
            jade: jade,
            pretty: true
        }))
        .pipe(gulp.dest('./prod/'));
});

gulp.task('templates:watch', function () {
    gulp.watch(['./dev/jade/**/*.jade', './dev/jade/*.jade'], ['templates']);
});

gulp.task('js:copy', function () {
    return gulp.src('./dev/js/*.js')
        .pipe(gulp.dest('./prod/js/'));
});

gulp.task('js:watch', function () {
    gulp.watch(['./dev/js/*.js'], ['js:copy']);
});

gulp.task('default', [ 'sass', 'sass:watch', 'templates', 'templates:watch', 'js:copy', 'js:watch', 'autoprefix', 'autoprefix:watch' ]);