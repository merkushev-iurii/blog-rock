// Установи зависимости (Node.js должен быть установлен)
// npm install gulp gulp-sass sass gulp-autoprefixer browser-sync --save-dev

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();

const paths = {
    scss: './scss/**/*.scss',
    cssDest: './'
};

function styles() {
    return gulp.src(paths.scss)
        .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
        .pipe(autoprefixer({ cascade: false }))
        .pipe(gulp.dest(paths.cssDest))
        .pipe(browserSync.stream());
}

function watchFiles() {
    browserSync.init({
        proxy: "http://blogrock.test/" 
    });
    gulp.watch(paths.scss, styles);
    gulp.watch("./**/*.php").on('change', browserSync.reload);
}

exports.styles = styles;
exports.watch = gulp.series(styles, watchFiles);