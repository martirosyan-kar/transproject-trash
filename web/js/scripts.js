/**
 * Created by karen on 2/4/16.
 */
$(function () {
    $(document).on('change', '.quantity', function () {
        var inputs = $('.quantity');
        var sum = 0;
        $.each(inputs, function (key, input) {
            var value = parseInt($(input).val());
            if (!isNaN(value)) {
                sum += value;
            }
        });
        $('#main-resident').val(sum);
    });
});