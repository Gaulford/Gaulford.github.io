// Inserindo dependências do projeto
var gulp = require("gulp"),
	del = require("del"),
	vinylPaths = require('vinyl-paths'),
	browserSync = require("browser-sync"),
	reload = browserSync.reload,
	plugins = require("gulp-load-plugins")();

	sourceRoot = "source/", // DEV - Código fonte
	devRoot = "dev/", // DEV - Arquivos para homologação
	prodRoot = "prod/", // PROD - Arquivos para publicação

	// SOURCE - Diretórios de código fonte
	srcSass = sourceRoot + "sass/",
	srcCoffee = sourceRoot + "coffee/application/",
	srcJsLibs = sourceRoot + "coffee/lib/",
	srcImages = sourceRoot + "assets/img/",
	srcFonts = sourceRoot + "assets/fonts/",

	// DEV - Diretórios para homologação
	devCss = devRoot + "css/",
	devJs = devRoot + "js/",
	devJsApp = devJs + "application/",
	devJsLibs = devJs + "lib/",
	devImages = devRoot + "assets/img/",
	devFonts = devRoot + "assets/fonts/",

	// PROD - Diretórios para publicação
	prodCss = prodRoot + "css/",
	prodJs = prodRoot + "js/",
	prodImages = prodRoot + "assets/img/",
	prodFonts = prodRoot + "assets/fonts/";


// SOURCE - Task's do ambiente de desenvolvimento

// Cria o servidor para o livereload
gulp.task("buildServer", function() {
	browserSync({
		browser: "chrome",
		logPrefix : "dev", 
		notify: true,
		open: true,
		port: 3000,
		server: {
			baseDir: devRoot,
			index: "index.html"
		}
	});
});

// Verifica alterações no Gulpfile.js
gulp.task("gulpfile", function() {
	return gulp.src("/Gulpfile.js")
		.pipe(plugins.plumber())
		.pipe(gulp.dest("/Gulpfile.js"))
		.pipe(reload({stream:true}));
});

// Compila .jade para .html
gulp.task("compileJade", function () {
	return gulp.src(sourceRoot + "**/*.jade")
		.pipe(plugins.plumber())
		.pipe(plugins.jade({
			pretty: true,
			debug: false,
			compileDebug: false
		}))
		.pipe(vinylPaths(del([devRoot + "**/*.html"], function(err, deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(devRoot))
		.pipe(reload({stream:true}));
});

// Compila SASS
gulp.task("compileSass", function() {
	return gulp.src(srcSass + "**/*.scss")
		.pipe(plugins.plumber({
	    	errorHandler: function (error) {
		        console.log(error.message);
		        this.emit('end');
		   	}
		}))
		.pipe(plugins.compass({
				style: "expanded",
				sass: srcSass,
				css: devCss,
				javascript: devJs,
				font: devFonts,
				image: devImages,
				comments: true,
				logging: true,
				time: true
			}
		))
		.pipe(vinylPaths(del([devCss + "**/*.css"], function(err, deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(devCss))
		.pipe(reload({stream:true}));
});

// Compila Coffeescript
gulp.task("compileCoffee", function() {
	return gulp.src(srcCoffee + "**/*.coffee")
		.pipe(plugins.plumber())
		.pipe(plugins.include())
		.pipe(plugins.coffee({
				bare: true
			}
		))
		.pipe(vinylPaths(del([devJsApp + "**/*.js"], function(err, deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(devJsApp))
		.pipe(reload({stream:true}));
});

// Compila Javascript
gulp.task("copyJavascript", function() {
	return gulp.src(srcJsLibs + "**/*.js")
		.pipe(plugins.plumber())
		.pipe(vinylPaths(del([devJsLibs + "**/*.js"], function(err, deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(devJsLibs))
		.pipe(reload({stream:true}));
});

// Copia imagens para Dev
gulp.task("copyImages", function() {
	return gulp.src(srcImages + "{**/*.{jpg,png,gif,svg}, *.{jpg,png,gif,svg}}")
		.pipe(plugins.plumber())
		.pipe(vinylPaths(del([devImages + "{**/*.{jpg,png,gif,svg}, *.{jpg,png,gif,svg}}"], function(err, deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(devImages))
		.pipe(reload({stream:true}));
}) 

// Copia fonts para Dev
gulp.task("copyFonts", function() {
	return gulp.src(srcFonts + "{**/*.{eot,svg,ttf,woff}, *.{eot,svg,ttf,woff}")
		.pipe(plugins.plumber())
		.pipe(vinylPaths(del([devFonts + "{**/*.{eot,svg,ttf,woff}, *.{eot,svg,ttf,woff}"], function(err, deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(devFonts))
		.pipe(reload({stream:true}));
})

// Verifica alterações no Gulpfile
gulp.task("watchGulpfile", function() {
	gulp.watch('Gulpfile.js', ['gulpfile']);
});

// Verifica alterações no Jade
gulp.task("watchJade", function() {
	gulp.watch(sourceRoot + "**/*.jade", ['compileJade']);
});

// Verifica alterações no SCSS
gulp.task("watchSass", function() {
	gulp.watch(srcSass + "**/*.scss", ['compileSass']);
});

// Verifica alterações no Coffeescript
gulp.task("watchCoffee", function() {
	gulp.watch(srcCoffee + "**/*.coffee", ['compileCoffee']);
});

// Verifica alterações nas bibliotecas Javascript
gulp.task("watchJavascript", function() {
	gulp.watch(srcJsLibs + "**/*.js", ['copyJavascript']);
});

// Verifica alterações nas imagens
gulp.task("watchImages", function() {
	gulp.watch(srcImages + "{**/*.{jpg,png,gif}, *.{jpg,png,gif}}", ['copyImages']);
});

// Verifica alterações nas fontes
gulp.task("watchFonts", function() {
	gulp.watch(srcFonts + "{**/*.{eot,svg,ttf,woff}, *.{eot,svg,ttf,woff}", ['copyFonts']);
});

// Executa DEV
gulp.task("default",["buildServer","watchGulpfile","watchJade","watchSass","watchCoffee","watchJavascript","watchImages","watchFonts"]);


// PROD - Task's do ambiente de produção

// Minifica HTML
gulp.task("minifyHtml", function() {
	return gulp.src(devRoot + "**/*.html")
		.pipe(plugins.htmlmin({
			removeComments : true,
			collapseWhitespace: true
		}))
		.pipe(vinylPaths(del([prodRoot + "**/*.html"], function (err,deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(prodRoot));
});

// Minifica CSS
gulp.task("minifyCss", function() {
	return gulp.src(devCss + "**/*.css")
		.pipe(plugins.cssmin({
			showLog: true
		}))
		.pipe(vinylPaths(del([prodCss + "**/*.css"], function (err,deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(prodCss));
});

// Minifica Scripts
gulp.task("minifyJs", function() {
	return gulp.src(devJs + "**/*.js")
		.pipe(plugins.uglify())
		.pipe(vinylPaths(del([prodJs + "**/*.js"], function (err,deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(prodJs));
});

// Copia fonts para produção
gulp.task("fontsToProd", function() {
	return gulp.src(devFonts + "**/*.{eot,svg,ttf,woff}")
		.pipe(vinylPaths(del([prodFonts + "{**/*.{eot,svg,ttf,woff}, *.{eot,svg,ttf,woff}"], function (err,deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(prodFonts));
});

// Otimiza imagens
gulp.task("optmizeImg", function() {
	return gulp.src(devImages + "{**/*.{jpg,png,gif,svg}, *.{jpg,png,gif,svg}}")
		.pipe(plugins.imagemin({
			progressive: true,
			interlaced: true,
			optimizationLevel: 7,
			svgoPlugins: [{removeViewBox: false}]
		}))
		.pipe(vinylPaths(del([prodImages + "{**/*.{jpg,png,gif,svg}, *.{jpg,png,gif,svg}}"], function (err,deletedFiles) {
			if( err === null ) {
				console.log('Files deleted:', deletedFiles.join(', '));
			} else {
				console.log('Error:',err);
			}
		})))
		.pipe(gulp.dest(prodImages));
});

// Executa Prod
gulp.task("prod",["minifyHtml","minifyCss","minifyJs","optmizeImg","fontsToProd"]);