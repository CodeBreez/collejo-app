Collejo.form.lock = function(form) {
    $(form).find('input').attr('readonly', true);
    $(form).find('.selectized').each(function() {
        $(this)[0].selectize.lock();
    });
    $(form).find('button[type="submit"]')
        .attr('disabled', true)
        .append(Collejo.templates.spinnerTemplate());
}

Collejo.form.unlock = function(form) {
    $(form).find('input').attr('readonly', false);
    $(form).find('.selectized').each(function() {
        $(this)[0].selectize.unlock();
    });
    $(form).find('button[type="submit"]')
        .attr('disabled', false)
        .find('.spinner-wrap')
        .remove();
}