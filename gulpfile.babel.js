const gulp = require('gulp');
const fs = require('fs');
const maps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const browserSync = require('browser-sync');
const del = require('del');
const reload = browserSync.reload;
const sass = require('gulp-sass');
const prefix = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const config = JSON.parse(fs.readFileSync('project-config.json'));

gulp.task('compileSassDev', function () {
	return gulp
		.src('app/scss/app.scss')
		.pipe(maps.init())
		.pipe(sass())
		.pipe(rename('style.css'))
		.pipe(prefix('last 1 version', '> 1%', 'ie 8', 'ie 7'))
		.pipe(maps.write('./'))
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain))
		.pipe(browserSync.stream());
});

gulp.task('compileScriptsDev', function () {
	return gulp
		.src('app/js/**/**.js')
		.pipe(concat('main.js'))
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain))
		.pipe(browserSync.stream());
});

gulp.task('clean', function () {
	del('dist');
});

gulp.task('serve', ['compileSassDev'], function () {
	browserSync({
		proxy: config.host.local,
		host: 'localhost',
		notify: false
	});
	gulp.watch('app/scss/**/*.scss', ['compileSassDev']);
	gulp.watch(['**/*.php', 'js/**/*.js', 'app/scss/**/*.scss']).on('change', browserSync.reload);
});
