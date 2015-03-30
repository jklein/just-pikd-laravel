var elixir = require('laravel-elixir');

require('laravel-elixir-sass-compass');
require('laravel-elixir-browserify');
require("laravel-elixir-react");


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

// elixir(function(mix) {
//     mix.browserify('main.js', {
//         debug: true,
//         output: 'public/build/js',
//         rename: 'bundle.js'
//     });
// });

elixir(function(mix) {
    mix.react("main.jsx", {
        output: "public/build/js",
        sourceMap: false,
        harmony: false,
        stripTypes: false
    });
});