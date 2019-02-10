'use strict';

const { series } = require( 'gulp' );

let gulp = require('gulp');
let sass = require('gulp-sass');
let rename = require('gulp-rename');
let uglify = require('gulp-uglify');
let cleanCSS = require('gulp-clean-css');
let sourcemaps = require('gulp-sourcemaps');

sass.compiler = require('node-sass');

function complieSass(cb) {
    return gulp.src('./assets/css/public/src/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/css/public/src'));
}

function complieAdminSass(cb) {
    return gulp.src('./assets/css/public/src/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/css/public/src'));
}

function minifyCSS(cb) {
    return gulp.src('./assets/css/public/src/styles.css')
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(sourcemaps.write())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./assets/css/public/dist'));
}

function minifyAdminCSS(cb) {
    return gulp.src('./assets/css/admin/src/styles.css')
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(sourcemaps.write())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./assets/css/admin/dist'));
}

function minifyJS(cb) {
    return gulp.src('./assets/js/public/src/scripts.js')
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./assets/js/public/dist'));
}

function minifyAdminJS(cb) {
    return gulp.src('./assets/js/admin/src/scripts.js')
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./assets/js/admin/dist'));
}


exports.default = series(complieSass, minifyCSS, minifyJS, complieAdminSass, minifyAdminCSS, minifyAdminJS);