var elixir = require('laravel-elixir');
var gulp = require('gulp');
var shell = require('gulp-shell');
var watch = require('gulp-watch');
var runSequence = require('run-sequence');

var srcDir = './resources/assets/src/';
var outDir = './resources/assets/';
var buildDir = './resources/assets/build/';

elixir(function(mix) {
    mix
        .sass(srcDir + 'sass/collejo.scss', outDir + 'css/collejo.css')
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
            srcDir + 'js/collejo.js',
            srcDir + 'js/collejo/browser.js',
            srcDir + 'js/collejo/templates.js',
            srcDir + 'js/collejo/ajax_setup.js',
            srcDir + 'js/collejo/datetimepicker.js',
            srcDir + 'js/collejo/select.js',
            srcDir + 'js/collejo/ajax_link.js',
            srcDir + 'js/collejo/alert.js',
            srcDir + 'js/collejo/form.js',
            srcDir + 'js/collejo/dynamics.js',
            srcDir + 'js/collejo/modal.js',
            srcDir + 'js/dashboard.js'
        ], outDir + 'js/collejo.js')
    /*.version([
            outDir + 'css/collejo.css',
            outDir + 'js/collejo.js'
        ]);*/
});

gulp.task('copy', function() {
    return watch([outDir + '**/*.css', outDir + '**/*.js'])
        .pipe(shell([
            'php ' + __dirname + '/../../../../artisan asset:copy'
        ]));
});