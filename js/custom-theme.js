/** Create jQuery anonymous function */
(function ($) {

    var $window = $(window),
        $body = $('body');

    var fn = {

        /**
         * Launch
         */
        Launch: function () {

            fn.Navigation();
            fn.App();
        },

        /**
         * Navigation
         */
        Navigation: function () {

            $('#ikonwp-main-navbar').find('.navbar-toggler').on('click', function (e) {
                e.preventDefault();

                $(this).find('.fa').toggleClass('d-none');
            });
        },

        /**
         * App
         */
        App: function () {

            $('[data-toggle="header-search"]').on('click', function (e) {
                e.preventDefault();

                $(this).find('.fa').toggleClass('d-none');
                $('.header__search').toggleClass('d-xl-block');
            });
        }
    };

    $(function () {
        fn.Launch();
    });

}(jQuery));