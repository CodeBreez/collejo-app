Collejo.ready.push(function(scope) {
    Collejo.components.dropDown($(scope).find('[data-toggle="select-dropdown"]'));
});

Collejo.components.dropDown = function(el) {
    el.each(function() {
        var element = $(this);

        element.selectize({
            placeholder: Collejo.lang.select
        });

        var selectize = element[0].selectize;

        selectize.on('change', function() {
            element.valid();
        });

        return selectize;
    });
}