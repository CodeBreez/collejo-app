$(function() {

    $(document).on('click', '[data-toggle="ajax-link"]', function(e) {
        e.preventDefault();
        Collejo.link.ajax($(this));
    });

    Collejo.link.ajax = function(link) {

        link.attr('disabled', true).append(Collejo.templates.spinnerTemplate());

        Collejo.getView(link.attr('href'), function(response) {
            if (response.success) {
                if (link.data('target')) {
                    $('#' + link.data('target')).empty().append(response.data.html);
                } else {
                    link.replaceWith(response.data.html);
                }
            }
        });
    }

});