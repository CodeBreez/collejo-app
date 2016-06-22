var elixir = require('laravel-elixir');
var gulp = require('gulp');
var shell = require('gulp-shell');
var watch = require('gulp-watch');
var runSequence = require('run-sequence');

var srcDir = './resources/assets/src/';
var buildDir = './resources/assets/build/';

elixir(function(mix) {
    mix
        .sass(srcDir + 'sass/collejo.scss', buildDir + 'css/collejo.css')
        .scripts([
            '../../../node_modules/jquery/jquery.js',
            '../../../node_modules/moment/moment.js',
            '../../../node_modules/bootstrap/dist/js/bootstrap.js',
            '../../../node_modules/jquery-form/jquery.form.js',
            '../../../node_modules/jquery-validation/dist/jquery.validate.js',
            '../../../node_modules/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
            '../../../node_modules/bootbox/bootbox.js',
            '../../../node_modules/d3/d3.js',
            '../../../node_modules/c3/c3.js',
            '../../../node_modules/selectize/dist/js/standalone/selectize.js',
            srcDir + 'js/**/*.js'
        ], buildDir + 'js/collejo.js');
});

gulp.task('copy', function() {
    return watch(buildDir + '**/**/*')
        .pipe(shell([
            'php ' + __dirname + '/../../../artisan asset:copy'
        ]));
});