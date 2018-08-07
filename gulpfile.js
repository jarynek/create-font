const gulp = require('gulp');
const path = require('path');
const args = require('yargs').argv;
const iconfont = require('gulp-iconfont');
const iconfontCss = require('gulp-iconfont-css');
const file = require('gulp-file');
const watch = require('gulp-watch');
const fontName = 'icons';

/**
 * createFont
 */
gulp.task('createFont', function () {
    gulp.src('./icons/' + args.arg + '/*.svg')
        .pipe(iconfontCss({
            fontName: fontName,
            targetPath: 'style.css',
            fontPath: './',
            cssClass: 'icon',
        }))
        .pipe(iconfont({
            fontName: fontName,
            fontHeight: 1001,
            normalize: true,
            prependUnicode: true, // recommended option
            centerHorizontally: true
        }))
        .pipe(gulp.dest('./icons/' + args.arg + '/css'));
});