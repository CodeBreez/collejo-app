Collejo.ready.push(function(scope) {
    Collejo.components.dropDown($(scope).find('[data-toggle="select-dropdown"]'));
});

Collejo.components.dropDown = function(el) {
    var component = el.selectize({
        placeholder: 'Select...'
    });

    if (component.length) {
        selectize = component[0].selectize;

        selectize.on('change', function() {
            component.valid();
        });

        return selectize;
    }
}