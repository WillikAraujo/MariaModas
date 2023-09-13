// Constantes das bibliotecas
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const { plugins } = require('@babel/preset-env/lib/plugins-compat-data');


// Compilando o Sass, adicionando autoprefixer e dando refresh na página
function compilaSass(){
    return gulp.src('scss/*.scss')
    .pipe(sass({outputStyle : 'compressed'}))
    .pipe(autoprefixer({
        overrideBrowserslist: ['last 2 versions'],
        cascade: false,
    }))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}

function pluginsCSS(){
    return gulp
    .src('css/lib/*.css')
    .pipe(concat('plugins.css'))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}

gulp.task('plugincss', pluginsCSS)
//tarefa do sass
gulp.task('sass', compilaSass);

function gulpJs(){
    return gulp.src('js/scripts/*.js')
    .pipe(concat('all.js'))
    .pipe(babel({
        presets: ['@babel/env']
    }))
    .pipe(uglify())
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());

}
gulp.task('alljs', gulpJs);

function pluginsJs(){
    return gulp
    .src(['js/lib/aos.min.js','js/lib/swiper.min.js'])
    .pipe(concat('plugins.js'))
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());
}

gulp.task('pluginjs', pluginsJs);

//função do browserSync
function browser(){
    browserSync.init({
        proxy: "localhost/maria-modas/"
    })
}

//tarefa do browserSync
gulp.task('browser-sync', browser)

// função do watch para a alterações em scss e php
function watch(){
    gulp.watch('scss/*.scss', compilaSass);
    gulp.watch('*.php').on('change', browserSync.reload);
    gulp.watch('woocommerce/*.php').on('change', browserSync.reload);
    gulp.watch('css/lib/*.css', pluginsCSS);
    gulp.watch('js/scripts/*.js', gulpJs);
    gulp.watch('js/lib/*.js', pluginsJs);
}
//tarefa do Watch
gulp.task('watch', watch);

//tarefa do deffult que executa o watch e o browser-sync
gulp.task('default', gulp.parallel('watch', 'browser-sync', 'sass', 'plugincss','alljs', 'pluginjs'));