/**
 * Created by karen on 2/4/16.
 */
$(function () {
    $(document).on('change', '.quantity', function () {
        var inputs = $('.quantity');
        var sum = 0;
        $.each(inputs, function (key, input) {
            var value = parseInt($(input).val());
            if (value == '')
                value = 0;
            if (!isNaN(value)) {
                sum += value;
            }
        });
        $('#main-resident').val(sum);
    });

    $(document).on('click', '#main-recycles label input', function () {
        var child = $(this);
        var value = $(this).val();
        if (value == 12) {
            if ($(child).prop('checked') === true) {
                $('#rubberSection').removeClass('hidden');
            }
            else {
                $('#rubberSection').addClass('hidden');
            }
        }
    });

    var inputs = $('#main-recycles label input:checked');
    $.each(inputs, function (key, input) {
        if ($(input).val() == 12) {
            $('#rubberSection').removeClass('hidden');
        }
    });
});