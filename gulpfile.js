// Load Gulp...of course
var gulp         = require( 'gulp' );

// CSS related plugins
var sass         = require( 'gulp-sass' );
var autoprefixer = require( 'gulp-autoprefixer' );
var minifycss    = require( 'gulp-uglifycss' );

// JS related plugins
var concat       = require( 'gulp-concat' );
var uglify       = require( 'gulp-uglify' );
var babelify     = require( 'babelify' );
var browserify   = require( 'browserify' );
var source       = require( 'vinyl-source-stream' );
var buffer       = require( 'vinyl-buffer' );
var stripDebug   = require( 'gulp-strip-debug' );

// Utility plugins
var rename       = require( 'gulp-rename' );
var sourcemaps   = require( 'gulp-sourcemaps' );
var notify       = require( 'gulp-notify' );
var plumber      = require( 'gulp-plumber' );
var options      = require( 'gulp-options' );
var gulpif       = require( 'gulp-if' );

// Browers related plugins
var browserSync  = require( 'browser-sync' ).create();
var reload       = browserSync.reload;

// Project related variables
var projectURL   = 'http://wp-stepform-plugin.test/';

var styleSRCadmin     = './src/admin/scss/ik-myplugin-admin.scss';
var styleSRCfront     = './src/front/scss/ik-myplugin-front.scss';
var styleURL     = './assets/';
var mapURL       = './';

var jsSRCadmin        = './src/admin/js/ik-myplugin-admin.js';
var jsSRCfront        = './src/front/js/ik-myplugin-front.js';
var jsURL        = './assets/';

var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/js/**/*.js';
var phpWatch     = './**/*.php';

// Tasks
 function browser_sync() {
	 browserSync.init({
		 proxy: projectURL,
		 browser: 'chrome',
	 });
};

function css ( done ) {
	gulp.src( [styleSRCadmin, styleSRCfront] )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			errLogToConsole: true,
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer({ overrideBrowserslist: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
		.pipe( sourcemaps.write( mapURL ) )
		.pipe( gulp.dest( styleURL ) )
		.pipe( browserSync.stream() );
	done();
};


function jsAdmin() {
	return browserify({
		entries: [jsSRCadmin]
	})
	.transform( babelify, { presets: [ '@babel/preset-env' ] } )
	.bundle()
	.pipe( source( 'ik-myplugin-admin.js', './src/admin/js/') )
	.pipe( buffer() )
	.pipe( gulpif( options.has( 'production' ), stripDebug() ) )
	.pipe( sourcemaps.init({ loadMaps: true }) )
	.pipe( uglify() )
	.pipe( sourcemaps.write( '.' ) )
	.pipe( gulp.dest( jsURL ) )
	.pipe( browserSync.stream() );
 };

function jsFront() {
	return browserify({
		entries: [jsSRCfront]
	})
		.transform( babelify, { presets: [ '@babel/preset-env' ] } )
		.bundle()
		.pipe( source( 'ik-myplugin-front.js', './src/front/js/') )
		.pipe( buffer() )
		.pipe( gulpif( options.has( 'production' ), stripDebug() ) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( jsURL ) )
		.pipe( browserSync.stream() );
};

function triggerPlumber( src, url ) {
	return gulp.src( src )
	.pipe( plumber() )
	.pipe( gulp.dest( url ) );
}

function watch_files() {

	gulp.watch( [styleSRCadmin, styleSRCfront], gulp.series(css ));
	gulp.watch( [ jsSRCadmin, jsSRCfront ],  gulp.series( jsAdmin, jsFront, reload));
	gulp.src( jsURL + 'ik-myplugin-admin.js')
		.pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );
}

gulp.task('css',  css );
gulp.task('js',  gulp.parallel( jsAdmin, jsFront ) );
gulp.task("watch", gulp.parallel( watch_files, browser_sync ));
