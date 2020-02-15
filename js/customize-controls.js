/**
 * @typedef {object} ikonwp_l10n
 *
 * @typedef {object} wpColorPickerL10n
 */
jQuery(function () {

    var $customizeThemeControls = jQuery('#customize-theme-controls');

    var ikonWPSections = [
        $customizeThemeControls.find('#accordion-section-ikonwp_display'),
        $customizeThemeControls.find('#accordion-panel-ikonwp_header'),
        $customizeThemeControls.find('#accordion-section-ikonwp_header_default'),
        $customizeThemeControls.find('#accordion-section-ikonwp_header_navbar'),
        $customizeThemeControls.find('#accordion-section-ikonwp_header_title'),
        $customizeThemeControls.find('#accordion-section-colors'),
        $customizeThemeControls.find('#accordion-panel-ikonwp_typography'),
        $customizeThemeControls.find('#accordion-section-ikonwp_typography_body'),
        $customizeThemeControls.find('#accordion-section-ikonwp_typography_header'),
        $customizeThemeControls.find('#accordion-panel-ikonwp_post_type'),
        $customizeThemeControls.find('#accordion-panel-ikonwp_sidebars'),
        $customizeThemeControls.find('#accordion-section-ikonwp_footer')
    ];

    jQuery.each(ikonWPSections, function (id, section) {
        section.find('.accordion-section-title').append(
            jQuery('<span>').addClass('pull-right').addClass('label').addClass('label-primary').text(ikonwp_l10n['ikonwp_label'])
        );
    });

    var ikonWPPostTypeSections = [
        $customizeThemeControls.find('#accordion-section-ikonwp_sidebars_post_type_post'),
        $customizeThemeControls.find('#accordion-section-ikonwp_sidebars_post_type_page')
    ];

    /** ikonwp - post type tag */
    jQuery.each(ikonWPPostTypeSections, function (id, section) {
        section.find('.accordion-section-title').append(
            jQuery('<span>').addClass('pull-right').addClass('label').addClass('label-primary').text(ikonwp_l10n['post_type_label'])
        );
    });

    var ikonWPCustomPostTypeSections = [];

    /** ikonwp - custom post type tag */
    jQuery.each(ikonWPCustomPostTypeSections, function (id, section) {
        section.find('.accordion-section-title').append(
            jQuery('<span>').addClass('pull-right').addClass('label').addClass('label-primary').text(ikonwp_l10n['custom_post_type_label'])
        );
    });

    /** ikonwp - display header text */
    wp.customize.control('display_header_text', function (control) {
        control.element.bind(function () {
            wp.customize.previewer.refresh();
        });
    });

    /** toggle custom colors */
    function ikonwpToggleCustomColors(themeColor) {
        var $primaryColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_colors_primary_color_color'),
            $primaryHoverColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_colors_primary_color_hover_color'),
            $primaryGradientColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_colors_primary_color_gradient_color'),
            isCustomThemeColor = ('custom' === themeColor);

        $primaryColorCustomizeControl.toggle(isCustomThemeColor);
        $primaryHoverColorCustomizeControl.toggle(isCustomThemeColor);
        $primaryGradientColorCustomizeControl.toggle(isCustomThemeColor);
    }

    /** ikonwp - theme color - toggle custom colors */
    wp.customize('ikonwp_colors_theme_color', function (value) {
        value.bind(function (themeColor) {
            ikonwpToggleCustomColors(themeColor);
        });
    });

    /** init custom colors */
    ikonwpToggleCustomColors(wp.customize.value('ikonwp_colors_theme_color')());

    /** toggle header default background type */
    function ikonwpToggleHeaderDefaultBackgroundType(backgroundType) {
        var $headerImageCustomizeControl = $customizeThemeControls.find('#customize-control-header_image'),
            $headerDefaultBackgroundColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_default_background_color_color'),
            isCustomBackgroundImage = ('custom_image' === backgroundType),
            isCustomBackgroundColor = ('custom_color' === backgroundType);

        $headerImageCustomizeControl.toggle(isCustomBackgroundImage);
        $headerDefaultBackgroundColorCustomizeControl.toggle(isCustomBackgroundColor);
    }

    /** ikonwp - toggle header default background type */
    wp.customize('ikonwp_header_default_background_type', function (value) {
        value.bind(function (backgroundType) {
            ikonwpToggleHeaderDefaultBackgroundType(backgroundType);
        });
    });

    /** init header default background type */
    ikonwpToggleHeaderDefaultBackgroundType(wp.customize.value('ikonwp_header_default_background_type')());

    /** toggle header navbar background type */
    function ikonwpToggleHeaderNavbarBackgroundType(backgroundType) {
        var $headerNavbarBackgroundColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_navbar_background_color_color'),
            isCustomBackgroundColor = ('custom_color' === backgroundType);

        $headerNavbarBackgroundColorCustomizeControl.toggle(isCustomBackgroundColor);
    }

    /** ikonwp - toggle header navbar background type */
    wp.customize('ikonwp_header_navbar_background_type', function (value) {
        value.bind(function (backgroundType) {
            ikonwpToggleHeaderNavbarBackgroundType(backgroundType);
        });
    });

    /** init header navbar background type */
    ikonwpToggleHeaderNavbarBackgroundType(wp.customize.value('ikonwp_header_navbar_background_type')());

    /** toggle header title display */
    function ikonwpToggleHeaderTitleDisplay(display) {
        var $headerTitleTextColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_title_text_color_color'),
            $headerTitleTextAlignCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_title_text_align_select'),
            isEnabled = ('1' === display);

        $headerTitleTextColorCustomizeControl.toggle(isEnabled);
        $headerTitleTextAlignCustomizeControl.toggle(isEnabled);
    }

    /** ikonwp - toggle header title display */
    wp.customize('ikonwp_header_title_display', function (value) {
        value.bind(function (display) {
            ikonwpToggleHeaderTitleDisplay(display);
        });
    });

    /** init header title display */
    ikonwpToggleHeaderTitleDisplay(wp.customize.value('ikonwp_header_title_display')());


    /** toggle typography body font family */
    function ikonwpToggleTypographyFontFamily(section, fontFamily) {
        var $headerTypographyFontSubsetsCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_typography_' + section + '_font_subsets_checkbox_multiple'),
            isGoogleFonts = ('' !== fontFamily);

        $headerTypographyFontSubsetsCustomizeControl.toggle(isGoogleFonts);
    }

    /** ikonwp - toggle typography body font family */
    wp.customize('ikonwp_typography_body_font_family', function (value) {
        value.bind(function (fontFamily) {
            ikonwpToggleTypographyFontFamily('body', fontFamily);
        });
    });

    /** ikonwp - toggle typography header font family */
    wp.customize('ikonwp_typography_header_font_family', function (value) {
        value.bind(function (fontFamily) {
            ikonwpToggleTypographyFontFamily('header', fontFamily);
        });
    });

    /** init typography font family */
    ikonwpToggleTypographyFontFamily('body', wp.customize.value('ikonwp_typography_body_font_family')());
    ikonwpToggleTypographyFontFamily('header', wp.customize.value('ikonwp_typography_header_font_family')());
});