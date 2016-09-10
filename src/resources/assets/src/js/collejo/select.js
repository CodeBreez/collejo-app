Selectize.define('allow-clear', function(options) {
    var that = this;
    var html = $('<span class="clear-selection" title="Clear"><i class="fa fa-fw fa-times"><i></span>');

    this.setup = (function() {
        var original = that.setup;

        return function() {

            original.apply(this, arguments);
            if (this.getValue() == '') {
                html.addClass('disabled');
            }
            this.$wrapper.append(html);

            this.$wrapper.on('click', '.clear-selection', function(e) {
                e.preventDefault();
                if (that.isLocked) return;
                that.clear();
                that.$control_input.focus();
            });

            this.on('change', function(value) {
                if (value == '') {
                    this.$wrapper.find('.clear-selection').addClass('disabled');
                } else {
                    this.$wrapper.find('.clear-selection').removeClass('disabled');
                }
            });
        };
    })();
});

Collejo.ready.push(function(scope) {
    Collejo.components.dropDown($(scope).find('[data-toggle="select-dropdown"]'));
});

Collejo.components.dropDown = function(el) {
    el.each(function() {
        var element = $(this);

        if (element.data('toggle') == null) {
            element.data('toggle', 'select-dropdown');
        }

        var plugins = [];

        if (element.data('allow-clear') == true) {
            plugins.push('allow-clear');
        }

        element.selectize({
            placeholder: Collejo.lang.select,
            plugins: plugins
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