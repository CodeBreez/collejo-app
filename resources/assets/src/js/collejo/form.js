$(function() {

    Collejo.form.lock = function(form) {
        $(form).find('button[type="submit"]')
            .attr('disabled', true)
            .append(Collejo.templates.spinnerTemplate());
    }

    Collejo.form.unlock = function(form) {
        $(form).find('button[type="submit"]')
            .attr('disabled', false)
            .find('.spinner-wrap')
            .remove();
    }

});