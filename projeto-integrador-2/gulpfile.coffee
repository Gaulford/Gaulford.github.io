do ->

	# Load all plugins
	gulp = require "gulp"
	browserSync = require "browser-sync"
	connect = require "gulp-connect-php"
	del = require "del"
	htmlmin = require "gulp-htmlmin"
	imagemin = require "gulp-imagemin"
	uncss = require "gulp-uncss"
	plumber = require "gulp-plumber"
	notify = require "gulp-notify"
	sftp = require "gulp-sftp"
	changed = require "gulp-changed"
	ftp = require "gulp-ftp"
	uglify = require "gulp-uglify"
	coffee = require "gulp-coffee"
	compass = require "gulp-compass"
	include = require "gulp-include"
	csso = require "gulp-csso"

	# Inserting paths variable
	paths =
		source:
			root: "source/"
			css: "source/assets/css/"
			font: "source/assets/font/"
			image: "source/assets/img/"
		hml:
			root: "hml/"
			css: "hml/assets/css/"
			font: "hml/assets/font/"
			image: "hml/assets/img/"
		prod:
			root: "prod/"
			css: "prod/assets/css/"
			font: "prod/assets/font/"
			image: "prod/assets/img/"

	# Decode password to conect to paixaoporvoareservir.com.br sftp
	# Build settings to publish content in server
	ftp =
		pass: "insert_ftp_pass (encoded with base64)"
		config:
			host: "insert_host"
			port: 21
			user: "insert_user"
			pass: ""#ftp.pass = new Buffer(ftp.pass, "base64").toString "ascii"
			remotePath: "insert_path"

	# Start server with php
	gulp.task "up-server", ->
		connect.server 
			base: "./#{paths.hml.root}"
			hostname: "localhost"
			port: 3000
			bin: "C:/xampp/php/php.exe"
			ini: "C:/xampp/php/php.ini"
			open: true, ->
				# Build browser sync task
				browserSync
					proxy: "localhost:3000"
					port: 8000

		# Set files to watch
		gulp.watch "#{paths.source.root}**/*.php", ["php-files"]
		.on "change", browserSync.reload
		gulp.watch "#{paths.source.root}**/*.scss", ["sass"]
		.on "change", browserSync.reload
		gulp.watch "#{paths.source.root}**/*.coffee", ["coffeescript"]
		.on "change", browserSync.reload
		gulp.watch "#{paths.source.root}**/*.js", ["javascript"]
		.on "change", browserSync.reload
		gulp.watch [
			"#{paths.source.root}**/*.jpg"
			"#{paths.source.root}**/*.gif"
			"#{paths.source.root}**/*.png"
		], ["images"]
		.on "change", browserSync.reload
		gulp.watch [
			"#{paths.source.root}**/*.eot"
			"#{paths.source.root}**/*.svg"
			"#{paths.source.root}**/*.ttf"
			"#{paths.source.root}**/*.woff"
			"#{paths.source.root}**/*.woff2"
		], ["fonts"]
		.on "change", browserSync.reload
		return

	# Build HTML check task
	gulp.task "php-files", ->
		gulp.src "./#{paths.source.root}**/*.php", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro de código no PHP: <%= error.message %>"
		.pipe changed "./#{paths.hml.root}",
			hasChanged: changed.compareSha1Digest
		.pipe gulp.dest paths.hml.root
		.pipe browserSync.stream()
		return

	# Build sass compile task
	gulp.task "sass", ["php-files"], ->
		gulp.src "./{paths.source.root}**/*.scss", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao compilar o SASS: <%= error.message %>"
		.pipe changed "./#{paths.hml.root}",
			extension: ".css"
			hasChanged: changed.compareSha1Digest
		.pipe compass
			style: "expanded"
			sass: "#{paths.source.css}"
			css: "#{paths.hml.css}"
			javascript: "{paths.hml.js}"
			font: "#{paths.hml.font}"
			image: "#{paths.source.image}"
			comments: true
			logging: true
			time: true
		.pipe csso()
		.pipe uncss
			html: ["./#{paths.hml.root}**/*.php"]
		.pipe gulp.dest paths.hml.root
		.pipe browserSync.stream()
		return

	# Build coffee compile task
	gulp.task "coffeescript", ->
		gulp.src "./#{paths.source.root}**/*.coffee", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao compilar o Coffeescript: <%= error.message %>"
		.pipe changed "./#{paths.hml.root}",
			extension: ".js"
			hasChanged: changed.compareSha1Digest
		.pipe include()
		.pipe coffee
			bare: true
		.pipe gulp.dest paths.hml.root
		.pipe browserSync.stream()
		return

	# Build task to pass required libraries to HML environment
	gulp.task "javascript", ->
		gulp.src "./#{paths.source.root}**/*.js", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao mover os JS para HML: <%= error.message %>"
		.pipe changed "./#{paths.hml.root}",
			hasChanged: changed.compareSha1Digest
		.pipe gulp.dest paths.hml.root
		.pipe browserSync.stream()
		return

	# Move images to homologation environment
	gulp.task "images", ->
		gulp.src "./#{paths.source.root}{**/*.{jpg,png,gif},*.{jpg,png,gif}}", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao transportar as imagens de SOURCE para HML: <%= error.message %>"
		.pipe changed "./#{paths.hml.root}",
			hasChanged: changed.compareSha1Digest
		.pipe gulp.dest paths.hml.root
		.pipe browserSync.stream()
		return

	# Move fonts to homologation environment
	gulp.task "fonts", ->
		gulp.src "./#{paths.source.root}{**/*.{eot,svg,ttf,woff,woff2},*.{eot,svg,ttf,woff,woff2}}", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao transportar as fontes de SOURCE para HML: <%= error.message %>"
		.pipe changed "./#{paths.hml.root}",
			hasChanged: changed.compareSha1Digest
		.pipe gulp.dest paths.hml.root
		.pipe browserSync.stream()
		return

	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

	# Production code environment
	# Clean directories for consistent files tree
	gulp.task "clean-hml-and-prod", ->
		del ["./#{paths.hml.root}/*","./#{paths.prod.root}/*"], (err, paths) ->
    		console.log "Arquivos/pastas deletadas:\n", paths.join "\n"
    	return
		

	# Build PHP move task
	gulp.task "prod-php-files", ["clean-hml-and-prod"], ->
		gulp.src "./#{paths.source.root}**/*.php", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao mover os arquivos PHP: <%= error.message %>"
		.pipe gulp.dest paths.prod.root
		return

	# Build css optmizer task
	gulp.task "optmize-css", ["clean-hml-and-prod"], ->
		gulp.src "./#{paths.source.root}**/*.scss", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao otimizar o SCSS: <%= error.message %>"
		.pipe compass
			style: "compressed"
			sass: "#{paths.source.css}"
			css: "#{paths.prod.css}"
			javascript: "{paths.prod.js}"
			font: "#{paths.prod.font}"
			image: "#{paths.source.image}"
			comments: false
			logging: false
			time: false
		.pipe csso()
		.pipe uncss
			html: ["./#{paths.prod.root}**/*.php"]
		.pipe gulp.dest paths.prod.root
		return

	# Build coffee optmizer task
	gulp.task "optmize-coffee", ["clean-hml-and-prod"], ->
		gulp.src "./#{paths.source.root}**/*.coffee", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao otimizar o Coffeescript: <%= error.message %>"
		.pipe include()
		.pipe conffee
			bare: true
		.pipe uglify()
		.pipe gulp.dest paths.prod.root
		return

	# Build task to pass required js
	gulp.task "optmize-js", ->
		gulp.src "./#{paths.source.root.libraries}**/*.js", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao mover as bibliotecas JS: <%= error.message %>"
		.pipe gulp.dest paths.prod.root
		return

	# Build image optmizer task
	gulp.task "optmize-images", ["clean-hml-and-prod"], ->
		gulp.src "./#{paths.source.root.img}{**/*.{jpg,png,gif},*.{jpg,png,gif}}", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao otimizar as imagens: <%= error.message %>"
		.pipe imagemin
			progressive: yes
			interlaced: yes
			optimizationLevel: 7
			svgoPlugins: [
				removeViewBox: no
			]
		.pipe gulp.dest paths.prod.root
		return

	# Build font optmizer task
	gulp.task "optmize-fonts", ["clean-hml-and-prod"], ->
		gulp.src "./#{paths.source.root.font}{**/*.{eot,svg,ttf,woff,woff2},*.{eot,svg,ttf,woff,woff2}}", base: "./#{paths.source.root}"
		.pipe plumber
			errorHandler: notify.onError "Erro ao otimizar as fontes: <%= error.message %>"
		.pipe gulp.dest paths.prod.root
		return

	# Set task for homologation
	gulp.task "default", ["up-server","sass","coffeescript","javascript","images","fonts"]

	# Set task for production
	gulp.task "prod", ["prod-php-files","optmize-css","optmize-coffee","optmize-js","optmize-images","optmize-fonts"]

	# Set task for publication
	gulp.task "upload-files", ["prod"], ->
		gulp.src ["#{paths.prod.root.root}/*","#{paths.prod.root.root}/**/*"]
		.pipe plumber
			errorHandler: notify.onError "Erro ao publicar o projeto: <%= error.message %>"
		.pipe ftp ftpConfig
		return

	# Clean directory after publication
	gulp.task "publish", ["upload-files"], ->
		del ["./#{paths.hml.root}/*","./#{paths.prod.root}/*"], (err, paths) ->
    		console.log "Arquivos/pastas deletadas:\n", paths.join "\n"
    	return