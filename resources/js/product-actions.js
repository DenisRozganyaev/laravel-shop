$(function () {
    $('#addStar').change('.star', function(e) {
        $(this).submit();
    });

    $(document).on('click', '.reply', function(e) {
        e.preventDefault();

        $(this).parent().find('form').removeClass('d-none');
    });
});
