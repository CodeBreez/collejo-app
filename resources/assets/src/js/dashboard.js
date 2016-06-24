$(function() {
    $(window).resize();

    $('.dash-content a').click(function(e) {
        var url = $(this).prop('href');
        if (url.substr(url.length - 1) == '#') {
            e.preventDefault();
        }
    });
});

$(window).on('resize', function() {
    var tab = $('.dash-content .tab-content');
    if (tab && tab.offset()) {
        tab.css({
            'min-height': ($(document).height() - tab.offset().top - 30) + 'px'
        });
    }
});