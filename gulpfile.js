const gulp = require('gulp');
const sass = require('gulp-sass');
const minify = require('gulp-minify');
const browserSync = require('browser-sync').create();
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const replace = require('gulp-replace');
const concat = require('gulp-concat');
const cssnano = require('cssnano');
const autoprefixer = require('autoprefixer');
const rename = require('gulp-rename');

//compile scss into css
function style() {
  return gulp.src('assets/scss/**/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error',sass.logError))
  .pipe(postcss([ autoprefixer(), cssnano()]))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest('assets/dist/css'))
  .pipe(browserSync.stream());
}

function minify_js(){
  return gulp.src(
    [
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'assets/js/**/*.js'
    ]
  )
  .pipe(concat('scripts.js'))
  
  // .pipe(minify({noSource: true}))
  .pipe(uglify())
  .pipe(rename({
    suffix: '.min'
  }))
  .pipe(gulp.dest('assets/dist/js'))
  .pipe(browserSync.stream());
}

var cbString = new Date().getTime();
function cacheBustTask(){
  return gulp.src(['index.php'])
  .pipe(replace(/cb=\d+/, 'cb=' + cbString))
  .pipe(gulp.dest('.'));
}

function watch() {
  browserSync.init({
    proxy: "http://globe-bank-2.localhost"
  });
  gulp.watch('assets/scss/**/*.scss', style, cacheBustTask);
  gulp.watch('assets/js/**/*.js', minify_js, cacheBustTask);
  gulp.watch('./**/*.php').on('change',browserSync.reload, cacheBustTask);
}



exports.style = style;
exports.minify_js = minify_js;
exports.watch = watch;