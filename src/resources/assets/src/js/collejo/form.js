Collejo.form.lock = function(form) {
    $(form).find('input').attr('readonly', true);
    $(form).find('.selectized').each(function() {
        $(this)[0].selectize.lock();
    });
    $(form).find('.fileinput-button').each(function() {
        $(this).addClass('disabled').find('input').attr('disabled', true);
    });
    $(form).find('button[type="submit"]')
        .attr('disabled', true)
        .append(Collejo.templates.spinnerTemplate());
    $(form).find('input[type="checkbox"]')
        .attr('readonly', true)
        .parent('.checkbox-row').addClass('disabled');
}

Collejo.form.unlock = function(form) {
    $(form).find('input').attr('readonly', false);
    $(form).find('.selectized').each(function() {
        $(this)[0].selectize.unlock();
    });
    $(form).find('.fileinput-button').each(function() {
        $(this).removeClass('disabled').find('input').attr('disabled', false);
    });
    $(form).find('button[type="submit"]')
        .attr('disabled', false)
        .find('.spinner-wrap')
        .remove();
    $(form).find('input[type="checkbox"]')
        .attr('readonly', false)
        .parent('.checkbox-row').removeClass('disabled');
}

Collejo.ready.push(function(scope) {
    $.validator.setDefaults({
        ignore: $('.selectize'),
        errorPlacement: function(error, element) {
            if ($(element).parents('.input-group').length) {
                error.insertAfter($(element).parents('.input-group'));
            } else if ($(element).data('toggle') == 'select-dropdown' || $(element).data('toggle') == 'search-dropdown') {
                error.insertAfter($(element).siblings('.selectize-control'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).addClass(errorClass).removeClass(validClass);
            } else if ($(element).data('toggle') == 'select-dropdown' || $(element).data('toggle') == 'search-dropdown') {
                $(element).siblings('.selectize-control').addClass(errorClass).removeClass(validClass)
            } else {
                $(element).addClass(errorClass).removeClass(validClass);
            }
        },
        unhighlight: function(element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).removeClass(errorClass).addClass(validClass);
            } else if ($(element).data('toggle') == 'select-dropdown' || $(element).data('toggle') == 'search-dropdown') {
                $(element).siblings('.selectize-control').removeClass(errorClass).addClass(validClass);
            } else {
                $(element).removeClass(errorClass).addClass(validClass);
            }
        }
    });
});