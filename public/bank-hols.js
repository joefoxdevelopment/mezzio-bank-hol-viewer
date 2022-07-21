$(document).ready(function () {
    var today = new Date();

    $('table').each(function () {
        var next = null;

        $(this).find('.js-bank-hol-row').each(function () {
            var bankHolDate = new Date($(this).data('date'));

            if (today > bankHolDate) {
                return;
            }

            if (null === next) {
                next = this;
                return;
            }

            if (bankHolDate < (new Date($(next).data('date')))) {
                next = this;
            }
        });

        $(next).addClass('table-success');
    });
});
