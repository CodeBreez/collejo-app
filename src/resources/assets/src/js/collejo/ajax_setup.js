$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="token"]').attr('content'),
        'X-User-Time': new Date()
    }
});

Collejo.ajaxComplete = function(event, xhr, settings) {

    var code, status, timeout, response = 0;

    try {
        response = $.parseJSON(xhr.responseText);
    } catch (e) {
        console.log(e)
    }

    status = (response == 0) ? xhr.status : response;

    if (status == 403 || status == 401) {
        Collejo.alert('danger', Collejo.lang.ajax_unauthorize, 3000);
        $('.modal,.modal-backdrop').remove();
    }

    if (status == 400) {
        Collejo.alert('warning', response.message, false);
        $('.modal,.modal-backdrop').remove();
    }

    if (status != 0 && status != null) {
        var code = status.code != undefined ? status.code : 0;
        if (code == 0) {
            if (response.data != undefined && response.data.partial != undefined) {
                var target = response.data.target ? response.data.target : 'ajax-target';

                var target = $('#' + target);
                var partial = $(response.data.partial);

                Collejo.dynamics.prependRow(partial, target);

                Collejo.ready.recall(partial);
            }

            if (response.data != undefined && response.data.redir != undefined) {
                if (response.message != null) {
                    Collejo.alert(response.success ? 'success' : 'warning', response.message + '. redirecting&hellip;', 1000);
                    timeout = 0;
                }
                setTimeout(function() {
                    window.location = response.data.redir;
                }, timeout);
            }

            if (response.message != undefined && response.message != null && response.message.length > 0 && response.data.redir == undefined) {
                Collejo.alert(response.success ? 'success' : 'warning', response.message, 3000);
            }

            if (response.data != undefined && response.data.errors != undefined) {
                var msg = '<strong>' + Collejo.lang.validation_failed + '</strong> ' + Collejo.lang.validation_correct + ' <br/>';
                $.each(response.data.errors, function(field, err) {
                    $.each(err, function(i, e) {
                        msg = msg + e + '<br/>';
                    });
                });

                Collejo.alert('warning', msg, 5000);
            }
        }
    }

    $(window).resize();
}

$(document).ajaxComplete(Collejo.ajaxComplete);