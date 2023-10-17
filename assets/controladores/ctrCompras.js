$(document).ready(function() {
    $(".qtyminus").on("click", function() {
        var input = $(this).closest('.count-inlineflex').find('.qty');
        var now = input.val();
        if ($.isNumeric(now)) {
            if (parseInt(now) - 1 > 0) {
                now--;
                input.val(now);
                input.closest('form').submit(); // Envía el formulario al actualizar la cantidad
            }
        }
    });

    $(".qtyplus").on("click", function() {
        var input = $(this).closest('.count-inlineflex').find('.qty');
        var now = input.val();
        if ($.isNumeric(now)) {
            input.val(parseInt(now) + 1);
            input.closest('form').submit(); // Envía el formulario al actualizar la cantidad
        }
    });
});

