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
		.pipe(prefix('last 4 version', '> 1%'))
		.pipe(maps.write('./'))
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain))
		.pipe(browserSync.stream());
});

gulp.task('compileScriptsDev', function () {
	return gulp
		.src('app/js/**/**.js')
		.pipe(concat('main.js'))
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain) + '/js')
		.pipe(browserSync.stream());
});

gulp.task('compilePHP', function () {
	return gulp
		.src('app/php/**/**.php')
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain))
		.pipe(browserSync.stream());
});

gulp.task('compileLanguages', function () {
	return gulp
		.src('app/languages/**/**.*')
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain + '/languages'))
		.pipe(browserSync.stream());
});

gulp.task('compileOthers', function () {
	return gulp
		.src('app/others/**/**.*')
		.pipe(gulp.dest('www/wp-content/themes/' + config.theme.textdomain + '/others'))
		.pipe(browserSync.stream());
});

gulp.task('serve', ['compileSassDev', 'compilePHP', 'compileLanguages', 'compileOthers'], function () {
	browserSync({
		proxy: config.host.local,
		host: 'localhost',
		notify: false
	});
	gulp.watch('app/scss/**/*.scss', ['compileSassDev']);
	gulp.watch('app/php/**/*.php', ['compilePHP']);
	gulp.watch('app/languages/**/**.*', ['compileLanguages']);
	gulp.watch('app/others/**/**.*', ['compileOthers']);
	gulp.watch('app/php/**/*.php', ['compilePHP']);
	gulp.watch(['app/**/**.*']).on('change', reload);
});
