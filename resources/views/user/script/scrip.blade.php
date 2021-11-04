<script>
    $(window).on("load", function () { $("#nivo-slider").nivoSlider() })

    $("[data-trigger]").on("click", function () {
        var trigger_id = $(this).attr('data-trigger');
        $(trigger_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
    });

    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').addClass('animate__fadeIn');
    })

    $('.dropdown').on('hidden.bs.dropdown', function () {
        $(this).find('.dropdown-menu').removeClass('animate__fadeIn');

    })
    $('#nav-icon4').click(function () {
        $(this).toggleClass('change');
    });
</script>
