$.fn.datetimepicker.defaults.icons = Collejo.templates.dateTimePickerIcons();

Collejo.ready.push(function(scope) {
    $(scope).find('[data-toggle="date-input"]').datetimepicker({
        format: 'YYYY-MM-DD'
    });
}, true);

Collejo.ready.push(function(scope) {
    $(scope).find('[data-toggle="time-input"]').datetimepicker({
        format: 'HH:i:s'
    });
}, true);

Collejo.ready.push(function(scope) {
    $(scope).find('[data-toggle="date-time-input"]').datetimepicker({
        format: 'YYYY-MM-DD HH:i:s'
    });
}, true);