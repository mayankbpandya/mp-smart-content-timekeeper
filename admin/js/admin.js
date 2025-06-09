jQuery(document).ready(function($) {
    // Initialize color picker
    $('.mp-sct-color-picker').wpColorPicker({
        defaultColor: '#0073aa',
        change: function(event, ui) {
            $(this).val(ui.color.toString()).trigger('change');
        }
    });
});