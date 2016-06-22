$(function() {

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
        return null;
    }

});