Collejo.ready.push(function(scope) {
    $(scope).on('click', '[data-toggle="dynamic-delete"]', function(e) {
        e.preventDefault();

        Collejo.dynamics.delete($(this));
    });

    Collejo.dynamics.checkRowCount($(scope).find('.table-list'));
    Collejo.dynamics.checkRowCount($(scope).find('.column-list'));
});

Collejo.dynamics.delete = function(element) {

    Collejo.link.ajax(element, function(link, response) {

        var list = link.parents('.table-list');

        link.closest('.' + link.data('delete-block')).fadeOut().remove();

        Collejo.dynamics.checkRowCount(link.parents('.table-list'));
    });
}

Collejo.dynamics.prependRow = function(partial, list) {

    var type = Collejo.dynamics.getListType(list);

    var id = partial.prop('id');
    var replacing = list.find('#' + id);

    if (replacing.length) {
        replacing.replaceWith(partial);
    } else {
        if (type == 'table') {
            partial.hide().insertAfter(list.find('table').find('th').parent()).fadeIn();
        } else if (type == 'columns') {
            partial.hide().prependTo(list.find('.columns')).fadeIn();
        } else {
            partial.hide().prependTo(list).fadeIn();
        }
    }

    Collejo.dynamics.checkRowCount(list);
}

Collejo.dynamics.getListType = function(list) {
    var type;

    if (list.find('table').length) {
        type = 'table';
    } else if (list.find('columns').length) {
        type = 'columns';
    }

    return type;
}

Collejo.dynamics.checkRowCount = function(list) {

    var type = Collejo.dynamics.getListType(list);

    if (type = 'table') {
        var table = list.find('table');

        if (table.find('tr').length == 1) {
            list.find('.placeholder').show();
            table.hide();
        } else {
            list.find('.placeholder').hide();
            table.show();
        }
    }

    if (type = 'columns') {
        var columns = list.find('columns');

        if (columns.find('.col-md-6').children().length == 0) {
            columns.siblings('.col-md-6').show();
            columns.hide();
        } else {
            list.siblings('.col-md-6').hide();
            columns.show();
        }
    }
}