var Collejo = Collejo || {
    settings: {
        alertInClass: 'bounceInDown',
        alertOutClass: 'fadeOutUp'
    },
    lang: {},
    templates: {},
    form: {},
    link: {},
    modal: {},
    dynamics: {},
    browser: {},
    components: {},
    image: {},
    ready: []
};

$(function() {
    $.each(Collejo.ready, function(i, f) {
        f($(document));
    });
});