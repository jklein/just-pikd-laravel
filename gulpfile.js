var gulp         = require('gulp');
var elixir       = require('laravel-elixir');
var browserify   = require('browserify');
var source       = require('vinyl-source-stream');
var reactify     = require('reactify');
var Notification = require('laravel-elixir/ingredients/commands/Notification');


require('laravel-elixir-sass-compass');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

// Create a new command for Laravel Elixir that will browserify and Reactify
elixir.extend('reactifyBrowserifyElixir', function(inputFile, inputFileName, outputDirectory) {

    gulp.task('browserify_and_reactify', function() {
        var b = browserify();

        b.transform(reactify);

        b.add(inputFile);

        return b.bundle()
            .pipe(source(inputFileName))
            .pipe(gulp.dest(outputDirectory))
            .pipe(new Notification().message('React and Browserify Compiled!'));
    });

    this.registerWatcher("browserify_and_reactify", "resources/assets/**/*.js");
    return this.queueTask('browserify_and_reactify');
});

elixir(function(mix) {
    mix.reactifyBrowserifyElixir('./resources/assets/js/app.js', 'app.js', './public/build/js/');
});


elixir(function(mix) {
    mix.compass("", "public/build/css", {
        sass: "resources/assets/sass",
        image: 'public/assets/images',
        relative: true,
        sourcemap: true
    });
});


elixir(function(mix) {
    mix.copy('resources/fonts/zocial/css', 'public/build/fonts/zocial');
});

elixir(function(mix) {
    mix.copy('resources/assets/js/lib', 'public/build/js/lib');
});

elixir(function(mix) {
    mix.copy('resources/assets/sass/sass-bootstrap/fonts', 'public/build/css/sass-bootstrap/fonts');
});

