Collejo.modal.open = function(link) {
    var id = link.data('modal-id') != null ? link.data('modal-id') : 'ajax-modal-' + moment();
    var size = link.data('modal-size') != null ? ' modal-' + link.data('modal-size') + ' ' : '';

    var backdrop = link.data('modal-backdrop') != null ? link.data('modal-backdrop') : true;
    var keyboard = link.data('modal-keyboard') != null ? link.data('modal-keyboard') : true;

    var modal = $('<div id="' + id + '" class="modal loading fade" role="dialog" aria-labelledby="' + id + '" aria-hidden="true"><div class="modal-dialog ' + size + '"></div></div>');

    var loader = Collejo.templates.ajaxLoader();

    if (loader != null) {
        loader.appendTo(modal);
    }

    $('body').append(modal);

    modal.on('show.bs.modal', function() {
        $.ajax({
            url: link.attr('href'),
            type: 'get',
            success: function(response) {
                if (response.success == true && response.data && response.data.content) {
                    modal.find('.modal-dialog').html(response.data.content);
                    modal.removeClass('loading');

                    if (loader != null) {
                        loader.remove();
                    }

                    $.each(Collejo.ready, function(i, f) {
                        f(modal);
                    });
                }
            }
        });
    }).on('hidden.bs.modal', function() {
        modal.remove();
    }).modal({
        backdrop: backdrop,
        keyboard: keyboard
    });
}

Collejo.modal.close = function(form) {
    $(document).find('#' + $(form).prop('id')).closest('.modal').modal('hide');
}

Collejo.ready.push(function(scope) {
    $(scope).on('click', '[data-toggle="ajax-modal"]', function(e) {
        e.preventDefault();
        Collejo.modal.open($(this));
    });
});