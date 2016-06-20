var elixir = require('laravel-elixir');

var srcDir = './resources/assets/src/';
var buildDir = './resources/assets/build/';

elixir(function(mix) {
    mix
        .sass([
            srcDir + 'sass/collejo.scss'
        ], buildDir + 'css/collejo.css')

    .scripts([
        srcDir + 'js/collejo.js'
    ], buildDir + 'js/collejo.js');
});