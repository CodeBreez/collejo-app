$(function() {
    $.fn.datetimepicker.defaults.icons = Collejo.templates.dateTimePickerIcons();

    $('.date-input').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('.time-input').datetimepicker({
        format: 'HH:i:s'
    });

    $('.date-time-input').datetimepicker({
        format: 'YYYY-MM-DD HH:i:s'
    });
});