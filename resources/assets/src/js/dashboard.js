$(function() {
    $(document).resize();
});

$(document).on('resize', function() {
    var tab = $('.dash-content .tab-content');
    tab.css({
        'min-height': ($(document).height() - tab.offset().top - 30) + 'px'
    });
});