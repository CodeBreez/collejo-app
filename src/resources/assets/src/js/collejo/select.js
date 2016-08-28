Collejo.ready.push(function(scope) {
    Collejo.components.dropDown($(scope).find('[data-toggle="select-dropdown"]'));
});

Collejo.components.dropDown = function(el) {
    el.each(function() {
        var element = $(this);

        if (element.data('toggle') == null) {
            element.data('toggle', 'select-dropdown');
        }

        element.selectize({
            placeholder: Collejo.lang.select
        });

        var selectize = element[0].selectize;

        selectize.on('change', function() {
            element.valid();
        });
    });

    if (el.length == 1) {
        var selectize = el[0].selectize;
        return selectize;
    }
}