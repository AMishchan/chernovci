$(document).ready(function() {

    $('li.dropdown > a').click(function (e) {
        e.preventDefault();
    });

    $('.dropdown').click(
        function (e) {
            if ($(this).find('.dropdown-menu').css('display') == 'none') {
                $('.dropdown-menu').css('display', 'none');
                $(this).find('.dropdown-menu').css('display', 'block');

                $(document).mouseup(function(e) {
                    var $target = $(e.target);
                    if ($target.closest(".nav").length == 0) {
                        $('.dropdown-menu').css('display', 'none');
                    }
                });
            } else {
                $(this).find('.dropdown-menu').css('display', 'none');
            }
        }
    );
}); //ready