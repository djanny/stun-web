var gulp = require('gulp'),
	gutil = require('gulp-util'),
	sourcemaps = require('gulp-sourcemaps'),
	uglify  = require('gulp-uglify'),
	browserify = require('browserify'),
	vinylStream  = require('vinyl-source-stream'),
	buffer  = require('vinyl-buffer'),
	autoprefixer = require('autoprefixer'),
	cssnano = require('cssnano'),
	assets  = require('postcss-assets'),
	sass = require('gulp-sass'),
	postcss = require('gulp-postcss'),
	del = require('del');

var source = 'src/',
	assets = 'assets/',
	dest = 'www/dist/',
	destJs = dest + '/js'
	destCss = dest + '/css';

gulp.task('clean', function() {
	return del([dest + 'maps', dest + 'scripts', dest + 'css', dest + 'fonts']);
});

//Bootstrap scss source
var bootstrapSass = {
        in: './node_modules/bootstrap-sass/'
};
var animateSass = {
        in: './node_modules/animate.scss/'
};

var ioniconsSass = {
        in: './node_modules/ionicons/'
};

var sassOpts = {
        outputStyle: 'nested',
        precison: 3,
        errLogToConsole: true,
        includePaths: [bootstrapSass.in + 'assets/stylesheets', 
        	animateSass.in + 'vendor/assets/stylesheets/', 
        	ioniconsSass.in + 'dist/scss/']
}

var fonts = {
        in: [assets+'fonts/*.*', bootstrapSass.in + 'assets/fonts/**/*', 
        	ioniconsSass.in + 'dist/fonts/**/*'],
        	out: dest + 'fonts/'
};

gulp.task('fonts', function () {
    return gulp
        .src(fonts.in)
        .pipe(gulp.dest(fonts.out));
});

gulp.task('styles', function() {
	var processors = [
		autoprefixer
	];
	/*
	var processors = [
		autoprefixer,
		cssnano({safe: true})
	];
	*/
	
	gulp.src('assets/scss/**/*.scss')
		.pipe(sass(sassOpts).on('error', sass.logError))
		.pipe(postcss(processors))
		.pipe(gulp.dest(destCss));
});

//.pipe(sourcemaps.init({loadMaps: true}))
//.pipe(uglify({mangle: false}))

gulp.task('scripts', function() {
	browserify({
		entries: 'assets/js/scripts.js',
			debug: true
		})
		.bundle()
		.on('error', err => {
			gutil.log("Browserify Error", gutil.colors.red(err.message))
		})
		.pipe(vinylStream('scripts.min.js'))
		.pipe(buffer())
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(sourcemaps.write('maps'))
		.pipe(gulp.dest(destJs));
});




gulp.task('default', ['clean'], function() {
	gulp.start('fonts', 'styles', 'scripts');
	gulp.watch('assets/scss/**/*.scss',['styles']);
	gulp.watch('assets/js/**/*.js',['scripts']);
});
