(function ($) {

    wp.customize('blogname', function (value) {
        value.bind(function (blogname) {
            $('.header').find('.header__logo').find('.header__blogname').html(blogname);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (blogname) {
            $('.header').find('.header__logo').find('.header__blogdescription').html(blogname);
        });
    });

    wp.customize('ikonwp_header_default_background_color', 'ikonwp_header_default_background_type', function (value, backgroundTypeValue) {
        value.bind(function (backgroundColor) {
            var $header = $('.header');

            if (backgroundColor && 'custom_color' === backgroundTypeValue()) {
                $header.addClass('bg--custom_color');
                $header.css('cssText', 'background-color: ' + backgroundColor + '!important');
            } else {
                $header.css('background-color', '');
                $header.removeClass('bg--custom_color');
            }
        });
    });

    wp.customize('ikonwp_header_navbar_background_color', 'ikonwp_header_navbar_background_type', function (value, backgroundTypeValue) {
        value.bind(function (backgroundColor) {
            var $headerNavbar = $('.header .header__navbar');

            if (backgroundColor && 'custom_color' === backgroundTypeValue()) {
                $headerNavbar.addClass('bg--custom_color');
                $headerNavbar.css('cssText', 'background-color: ' + backgroundColor + '!important');
            } else {
                $headerNavbar.css('background-color', '');
                $headerNavbar.removeClass('bg--custom_color');
            }
        });
    });

    wp.customize('header_textcolor', 'ikonwp_header_navbar_text_color', 'ikonwp_header_title_text_color', function (value, navbarValue, titleValue) {
        value.bind(function (headerTextcolor) {
            var headerTextcolorSelector = ['.header.text--custom_color'];

            if (!navbarValue()) {
                headerTextcolorSelector.push(
                    '.header.text--custom_color .header__navbar .header__logo, .header.text--custom_color .header__navbar .header__logo a, ' +
                    '.header .header__navbar.text--custom_color .header__logo, .header .header__navbar.text--custom_color .header__logo a, ' +
                    '.header.text--custom_color .header__navbar .navbar-toggler, ' +
                    '.header .header__navbar.text--custom_color .navbar-toggler' +
                    '.header.text--custom_color .header__navbar .navbar-nav .nav-link, ' +
                    '.header .header__navbar.text--custom_color .navbar-nav .nav-link, ' +
                    '.header.text--custom_color .header__navbar .navbar-nav.sm-collapsible .dropdown .dropdown-menu .dropdown-item, ' +
                    '.header .header__navbar.text--custom_color .navbar-nav.sm-collapsible .dropdown .dropdown-menu .dropdown-item, ' +
                    '.header.text--custom_color .header__navbar .header__icons, .header.text--custom_color .header__navbar .header__icons a, ' +
                    '.header .header__navbar.text--custom_color .header__icons, .header .header__navbar.text--custom_color .header__icons a'
                );
            }
            if (!titleValue()) {
                headerTextcolorSelector.push(
                    '.header.text--custom_color .header__title, ' +
                    '.header .header__title.text--custom_color'
                );
            }

            if (headerTextcolor) {
                $('.header').addClass('text--custom_color');
                $(headerTextcolorSelector.join(', ')).css('cssText', 'color: ' + headerTextcolor + '!important');
            } else {
                $(headerTextcolorSelector.join(', ')).css('color', '');
                $('.header').removeClass('text--custom_color');
            }
        });
    });

    wp.customize('ikonwp_header_navbar_text_color', function (value) {
        value.bind(function (navbarTextColor) {
            var navbarTextColorSelector =
                '.header.text--custom_color .header__navbar .header__logo, .header.text--custom_color .header__navbar .header__logo a, ' +
                '.header .header__navbar.text--custom_color .header__logo, .header .header__navbar.text--custom_color .header__logo a, ' +
                '.header.text--custom_color .header__navbar .navbar-toggler, ' +
                '.header .header__navbar.text--custom_color .navbar-toggler' +
                '.header.text--custom_color .header__navbar .navbar-nav .nav-link, ' +
                '.header .header__navbar.text--custom_color .navbar-nav .nav-link, ' +
                '.header.text--custom_color .header__navbar .navbar-nav.sm-collapsible .dropdown .dropdown-menu .dropdown-item, ' +
                '.header .header__navbar.text--custom_color .navbar-nav.sm-collapsible .dropdown .dropdown-menu .dropdown-item, ' +
                '.header.text--custom_color .header__navbar .header__icons, .header.text--custom_color .header__navbar .header__icons a, ' +
                '.header .header__navbar.text--custom_color .header__icons, .header .header__navbar.text--custom_color .header__icons a';

            if (navbarTextColor) {
                $('.header .header__navbar').addClass('text--custom_color');
                $(navbarTextColorSelector).css('cssText', 'color: ' + navbarTextColor + '!important');
            } else {
                $(navbarTextColorSelector).css('color', '');
                $('.header .header__navbar').removeClass('text--custom_color');
            }
        });
    });

    wp.customize('ikonwp_header_title_text_color', function (value) {
        value.bind(function (titleTextColor) {
            var titleTextColorSelector =
                '.header.text--custom_color .header__title, ' +
                '.header .header__title.text--custom_color';

            if (titleTextColor) {
                $('.header .header__title').addClass('text--custom_color');
                $(titleTextColorSelector).css('cssText', 'color: ' + titleTextColor + '!important');
            } else {
                $(titleTextColorSelector).css('color', '');
                $('.header .header__title').removeClass('text--custom_color');
            }
        });
    });

    wp.customize('ikonwp_footer_text', function (value) {
        value.bind(function (text) {
            $('.footer').find('.footer__text').text(text);
        });
    });

})(jQuery);