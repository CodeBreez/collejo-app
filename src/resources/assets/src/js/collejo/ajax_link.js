Collejo.ready.push(function(scope) {
    $(scope).on('click', '[data-toggle="ajax-link"]', function(e) {
        e.preventDefault();
        Collejo.link.ajax($(this));
    });
});

Collejo.link.ajax = function(link, callback) {

    if (link.data('confirm') == null) {

        callAjax(link);

    } else {

        bootbox.confirm({
            message: link.data('confirm'),
            buttons: {
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result) {
                    callAjax(link);
                }
            }
        });
    }

    function callAjax(link) {
        $.getJSON(link.attr('href'), function(response) {

            if (link.data('success-callback') == null) {

                if (typeof callback == 'function') {
                    callback(link, response);
                }

            } else {

                var func = window[link.data('success-callback')];

                if (typeof func == 'function') {
                    func(link, response);
                }
            }

        });
    }

}