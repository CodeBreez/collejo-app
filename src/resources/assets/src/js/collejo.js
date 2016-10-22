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
    ready: {
        push: function(callback, recall) {
            C.f.push({
                callback: callback,
                recall: recall === true ? true : false
            })
        },
        call: function(ns) {
            $.each(C.f, function(i, func) {
                func.callback(ns);
            })
        },
        recall: function(ns) {
            $.each(C.f, function(i, func) {
                if (func.recall) {
                    func.callback(ns);
                }
            })
        }
    }
};

jQuery.events = function(expr) {
    var rez = [],
        evo;
    jQuery(expr).each(
        function() {
            if (evo = jQuery._data(this, "events"))
                rez.push({
                    element: this,
                    events: evo
                });
        });
    return rez.length > 0 ? rez : null;
}

$(function() {
    Collejo.ready.call($(document));
});