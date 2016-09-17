Collejo.templates.spinnerTemplate = function() {
    return $('<span class="spinner-wrap"><span class="spinner"></span></span>');
}

Collejo.templates.alertTemplate = function(type, message, duration) {
    return $('<div class="alert alert-' + type + ' ' + (duration !== false ? 'alert-dismissible' : '') + '" role="alert">' +
        (duration !== false ? '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button>' : '') + message + '</div>');
}

Collejo.templates.alertWrap = function() {
    return $('<div id="alert-wrap"></div>');
}

Collejo.templates.alertContainer = function() {
    return $('<div class="alert-container"></div>');
}

Collejo.templates.ajaxLoader = function() {
    return $('<div class="loading-wrap"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>');
}

Collejo.templates.dateTimePickerIcons = function() {
    return {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-calendar-check-o',
        clear: 'fa fa-trash-o',
        close: 'fa fa-close'
    }
}