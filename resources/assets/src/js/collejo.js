var Collejo = Collejo || {
    settings: {
        alertInClass: 'bounceInDown',
        alertOutClass: 'fadeOutUp'
    },
    templates: {},
    form: {},
    link: {},
    modal: {},
    browser: {},
    ready: []
};

$(function() {
    $.each(Collejo.ready, function(i, f) {
        f($(document));
    });
});