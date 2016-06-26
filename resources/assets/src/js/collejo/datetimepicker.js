$(function() {
    $.fn.datetimepicker.defaults.icons = Collejo.templates.dateTimePickerIcons();

    $('[data-toggle="date-input]').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('[data-toggle="time-input]').datetimepicker({
        format: 'HH:i:s'
    });

    $('[data-toggle="date-time-input]').datetimepicker({
        format: 'YYYY-MM-DD HH:i:s'
    });
});