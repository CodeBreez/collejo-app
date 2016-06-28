Collejo.alert = function(type, msg, duration) {
    var alertWrap = Collejo.templates.alertWrap();
    var alertContainer = Collejo.templates.alertContainer();

    alertWrap.css({
        position: 'fixed',
        top: '60px',
        width: '100%',
        height: 0,
        'z-index': 99999
    });

    alertContainer.css({
        width: '400px',
        margin: '0 auto'
    });

    alertWrap.append(alertContainer);
    var alert = Collejo.templates.alertTemplate(type, msg, duration);

    if ($('#alert-wrap').length == 0) {
        $('body').append(alertWrap);
    }

    var alertContainer = $('#alert-wrap').find('.alert-container');

    if (duration === false) {
        alertContainer.empty();
    }

    alert.appendTo(alertContainer).addClass('animated ' + Collejo.settings.alertInClass);

    if (duration > 0) {
        window.setTimeout(function() {
            if (Collejo.browser.isFirefox || Collejo.browser.isChrome) {
                alert.removeClass(Collejo.settings.alertInClass)
                    .addClass(Collejo.settings.alertOutClass)
                    .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                        alert.remove();
                    });
            } else {
                alert.remove();
            }
        }, duration);
    }

}