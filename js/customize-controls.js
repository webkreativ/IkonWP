/**
 * @typedef {object} ikonwp_l10n
 * @typedef {object} wpColorPickerL10n
 */

(function (exports, $) {
    'use strict';

    var $window = $(window),
        $document = $(document),
        $body = $('body');


    jQuery(function () {

        var $customizeThemeControls = jQuery('#customize-theme-controls');

        var ikonWPSections = [
            $customizeThemeControls.find('#accordion-section-ikonwp_display'),
            $customizeThemeControls.find('#accordion-panel-ikonwp_header'),
            $customizeThemeControls.find('#accordion-section-ikonwp_header_default'),
            $customizeThemeControls.find('#accordion-section-ikonwp_header_top'),
            $customizeThemeControls.find('#accordion-section-ikonwp_header_navbar'),
            $customizeThemeControls.find('#accordion-section-ikonwp_header_title'),
            $customizeThemeControls.find('#accordion-section-ikonwp_header_elements_menu'),
            $customizeThemeControls.find('#accordion-section-colors'),
            $customizeThemeControls.find('#accordion-panel-ikonwp_typography'),
            $customizeThemeControls.find('#accordion-section-ikonwp_typography_body'),
            $customizeThemeControls.find('#accordion-section-ikonwp_typography_header'),
            $customizeThemeControls.find('#accordion-panel-ikonwp_post_type'),
            $customizeThemeControls.find('#accordion-section-ikonwp_blog'),
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
            var $primaryColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_colors_primary_color'),
                $primaryHoverColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_colors_primary_color_hover'),
                $primaryGradientColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_colors_primary_color_gradient'),
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
                $headerDefaultBackgroundColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_default_background_color'),
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
            var $headerNavbarBackgroundColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_navbar_background_color'),
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
            var $headerTitleTextColorCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_title_text_color'),
                $headerTitleTextAlignCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_header_title_text_align'),
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
            var $headerTypographyFontSubsetsCustomizeControl = $customizeThemeControls.find('#customize-control-ikonwp_typography_' + section + '_font_subsets'),
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

        /**
         * footer text
         * empty text - refresh previewer
         */
        wp.customize('ikonwp_footer_text', function (value) {
            value.bind(function (text) {

                if (!text.length) {
                    wp.customize.previewer.refresh();
                }
            });
        });
    });

    /**
     * Contentless sections like:
     * ikonwp-spacer-section,
     * ikonwp-pro-link-section
     */
    wp.customize.sectionConstructor['ikonwp-pro-link-section'] =
        wp.customize.sectionConstructor['ikonwp-spacer-section'] = wp.customize.Section.extend({
            // No events for this type of section.
            attachEvents: function () {
            },
            // Always make the section active.
            isContextuallyActive: function () {
                return true;
            }
        });

    /**
     * IkonWP base control
     */
    wp.customize.IkonWPControl = wp.customize.Control.extend({
        initialize: function (id, options) {
            var control = this,
                args = options || {};

            args.params = args.params || {};
            if (!args.params.type) {
                args.params.type = 'ikonwp-base';
            }
            if (!args.params.content) {
                args.params.content = jQuery('<li></li>');
                args.params.content.attr('id', 'customize-control-' + id.replace(/]/g, '').replace(/\[/g, '-'));
                args.params.content.attr('class', 'customize-control customize-control-' + args.params.type);
            }

            control.propertyElements = [];
            wp.customize.Control.prototype.initialize.call(control, id, args);
        },

        /**
         * Add bidirectional data binding links between inputs and the setting(s).
         *
         * This is copied from wp.customize.Control.prototype.initialize(). It
         * should be changed in Core to be applied once the control is embedded.
         *
         * @private
         * @returns {null}
         */
        _setUpSettingRootLinks: function () {
            var control = this,
                nodes = control.container.find('[data-customize-setting-link]');

            nodes.each(function () {
                var node = jQuery(this);

                wp.customize(node.data('customizeSettingLink'), function (setting) {
                    var element = new wp.customize.Element(node);
                    control.elements.push(element);
                    element.sync(setting);
                    element.set(setting());
                });
            });
        },

        /**
         * Add bidirectional data binding links between inputs and the setting properties.
         *
         * @private
         * @returns {null}
         */
        _setUpSettingPropertyLinks: function () {
            var control = this,
                nodes;

            if (!control.setting) {
                return;
            }

            nodes = control.container.find('[data-customize-setting-property-link]');

            nodes.each(function () {
                var node = jQuery(this),
                    element,
                    propertyName = node.data('customizeSettingPropertyLink');

                element = new wp.customize.Element(node);
                control.propertyElements.push(element);
                element.set(control.setting()[propertyName]);

                element.bind(function (newPropertyValue) {
                    var newSetting = control.setting();
                    if (newPropertyValue === newSetting[propertyName]) {
                        return;
                    }
                    newSetting = _.clone(newSetting);
                    newSetting[propertyName] = newPropertyValue;
                    control.setting.set(newSetting);
                });
                control.setting.bind(function (newValue) {
                    if (newValue[propertyName] !== element.get()) {
                        element.set(newValue[propertyName]);
                    }
                });
            });
        },

        /**
         * @inheritdoc
         */
        ready: function () {
            var control = this;

            control._setUpSettingRootLinks();
            control._setUpSettingPropertyLinks();

            wp.customize.Control.prototype.ready.call(control);

            control.deferred.embedded.done(function () {
            });
        },

        /**
         * Embed the control in the document.
         *
         * Override the embed() method to do nothing,
         * so that the control isn't embedded on load,
         * unless the containing section is already expanded.
         *
         * @returns {null}
         */
        embed: function () {
            var control = this,
                sectionId = control.section();

            if (!sectionId) {
                return;
            }

            wp.customize.section(sectionId, function (section) {
                if (section.expanded() || wp.customize.settings.autofocus.control === control.id) {
                    control.actuallyEmbed();
                } else {
                    section.expanded.bind(function (expanded) {
                        if (expanded) {
                            control.actuallyEmbed();
                        }
                    });
                }
            });
        },

        /**
         * Deferred embedding of control when actually
         *
         * This function is called in Section.onChangeExpanded() so the control
         * will only get embedded when the Section is first expanded.
         *
         * @returns {null}
         */
        actuallyEmbed: function () {
            var control = this;
            if ('resolved' === control.deferred.embedded.state()) {
                return;
            }
            control.renderContent();
            control.deferred.embedded.resolve(); // This triggers control.ready().

            // Fire event after control is initialized.
            control.container.trigger('init');
        },

        /**
         * This is not working with autofocus.
         *
         * @param {object} [args] Args.
         * @returns {null}
         */
        focus: function (args) {
            var control = this;
            control.actuallyEmbed();
            wp.customize.Control.prototype.focus.call(control, args);
        },
    });
    wp.customize.controlConstructor['ikonwp-base'] = wp.customize.IkonWPControl;

    /**
     * IkonWP slider control
     */
    wp.customize.controlConstructor['ikonwp-slider'] = wp.customize.IkonWPControl.extend({
        ready: function () {
            var control = this;

            control.container.find('.ikonwp-slider-fieldset').each(function (i, el) {
                var $el = $(el),
                    $unit = $el.find('.ikonwp-slider-unit'),
                    $input = $el.find('.ikonwp-slider-input'),
                    $slider = $el.find('.ikonwp-slider-ui'),
                    $reset = $el.find('.ikonwp-slider-reset'),
                    $value = $el.find('.ikonwp-slider-value');

                $slider.slider({
                    value: $input.val(),
                    min: +$input.attr('min'),
                    max: +$input.attr('max'),
                    step: +$input.attr('step'),
                    slide: function (e, ui) {
                        $input.val(ui.value).trigger('change');
                    },
                });

                $reset.on('click', function (e) {
                    var resetNumber = $(this).attr('data-number'),
                        resetUnit = $(this).attr('data-unit');

                    $unit.val(resetUnit);
                    $input.val(resetNumber).trigger('change');
                    $slider.slider('value', resetNumber);
                });

                $unit.on('change', function (e) {
                    var $option = $unit.find('option[value="' + this.value + '"]');

                    $input.attr('min', $option.attr('data-min'));
                    $input.attr('max', $option.attr('data-max'));
                    $input.attr('step', $option.attr('data-step'));

                    $slider.slider('option', {
                        min: +$input.attr('min'),
                        max: +$input.attr('max'),
                        step: +$input.attr('step'),
                    });

                    $input.val('').trigger('change');
                });

                $input.on('change blur', function (e) {
                    $slider.slider('value', this.value);

                    var value = '' === this.value ? '' : this.value.toString() + $unit.val().toString();

                    $value.val(value).trigger('change');
                });
            });
        }
    });

    /**
     * IkonWP dimension control
     */
    wp.customize.controlConstructor['ikonwp-dimension'] = wp.customize.IkonWPControl.extend({
        ready: function () {
            var control = this;

            control.container.find('.ikonwp-dimension-fieldset').each(function (i, el) {
                var $el = $(el),
                    $unit = $el.find('.ikonwp-dimension-unit'),
                    $input = $el.find('.ikonwp-dimension-input'),
                    $value = $el.find('.ikonwp-dimension-value');

                $unit.on('change', function (e) {
                    var $option = $unit.find('option[value="' + this.value + '"]');

                    $input.attr('min', $option.attr('data-min'));
                    $input.attr('max', $option.attr('data-max'));
                    $input.attr('step', $option.attr('data-step'));

                    $input.val('').trigger('change');
                });

                $input.on('change blur', function (e) {
                    var value = '' === this.value ? '' : this.value.toString() + $unit.val().toString();

                    $value.val(value).trigger('change');
                });
            });
        }
    });

    /**
     * IkonWP dimensions control
     */
    wp.customize.controlConstructor['ikonwp-dimensions'] = wp.customize.IkonWPControl.extend({
        ready: function () {
            var control = this;

            control.container.find('.ikonwp-dimensions-fieldset').each(function (i, el) {
                var $el = $(el),
                    $unit = $el.find('.ikonwp-dimensions-unit'),
                    $link = $el.find('.ikonwp-dimensions-link'),
                    $unlink = $el.find('.ikonwp-dimensions-unlink'),
                    $inputs = $el.find('.ikonwp-dimensions-input'),
                    $value = $el.find('.ikonwp-dimensions-value');

                $unit.on('change', function (e) {
                    var $option = $unit.find('option[value="' + this.value + '"]');

                    $inputs.attr('min', $option.attr('data-min'));
                    $inputs.attr('max', $option.attr('data-max'));
                    $inputs.attr('step', $option.attr('data-step'));

                    $inputs.val('').trigger('change');
                });

                $link.on('click', function (e) {
                    e.preventDefault();

                    $el.attr('data-linked', 'true');
                    $inputs.val($inputs.first().val()).trigger('change');
                    $inputs.first().focus();
                });

                $unlink.on('click', function (e) {
                    e.preventDefault();

                    $el.attr('data-linked', 'false');
                    $inputs.first().focus();
                });

                $inputs.on('keyup mouseup', function (e) {
                    if ('true' == $el.attr('data-linked')) {
                        $inputs.not(this).val(this.value).trigger('change');
                    }
                });

                $inputs.on('change blur', function (e) {
                    var values = [],
                        unit = $unit.val().toString(),
                        isEmpty = true,
                        value;

                    $inputs.each(function () {
                        if ('' === this.value) {
                            values.push('0' + unit);
                        } else {
                            values.push(this.value.toString() + unit);
                            isEmpty = false;
                        }
                    });

                    if (isEmpty) {
                        value = '   ';
                    } else {
                        value = values.join(' ');
                    }

                    $value.val(value).trigger('change');
                });
            });
        }
    });

    /**
     * IkonWP builder control
     */
    wp.customize.controlConstructor['ikonwp-builder'] = wp.customize.IkonWPControl.extend({
        ready: function () {
            var control = this;

            control.builder = control.container.find('.ikonwp-builder');
            control.builderLocations = control.builder.find('.ikonwp-builder-location');
            control.builderInactive = control.builder.find('.ikonwp-builder-inactive');

            // Core function to update setting's value.
            control.updateValue = function (location) {
                if ('__inactive' === location) return;

                var $locationPanel = control.builderLocations.filter('[data-location="' + location + '"]'),
                    $elements = $locationPanel.find('.ikonwp-builder-element'),
                    value = [];

                $elements.each(function () {
                    value.push($(this).attr('data-value'));
                });

                if (null !== control.settings) {
                    control.settings[location].set(value);
                } else {
                    control.setting.set(value);
                }
            };

            // Show / hide add button.
            control.showHideAddButton = function () {
                var $addButton = control.builder.find('.ikonwp-builder-element-add');

                if (0 === control.builderInactive.find('.ikonwp-builder-element').length) {
                    $addButton.hide();
                } else {
                    $addButton.show();
                }
            }
            control.showHideAddButton();

            // Trigger click event on all span with tabindex using keyboard.
            control.container.on('keyup', '[tabindex]', function (e) {
                if (13 == e.which || 32 == e.which) {
                    $(this).trigger('click');
                }
            });

            // Expand inactive panel.
            control.container.on('click', '.ikonwp-builder-element-add', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $location = $this.closest('.ikonwp-builder-location'),
                    $wrapper = $this.closest('.ikonwp-builder-locations');

                if (control.builderInactive.prev().get(0) == $location.get(0) && control.builderInactive.hasClass('show')) {
                    control.builderInactive.removeClass('show').appendTo($wrapper);
                } else {
                    control.builderInactive.addClass('show').insertAfter($location);
                }
            });

            // Add element to nearby location.
            control.container.on('click', '.ikonwp-builder-inactive .ikonwp-builder-element', function (e) {
                e.preventDefault();

                if (control.builderInactive.hasClass('show')) {
                    var $element = $(this),
                        $location = control.builderInactive.prev('.ikonwp-builder-location');

                    $element.appendTo($location.children('.ikonwp-builder-sortable-panel'));
                    control.builderInactive.removeClass('show');

                    control.updateValue($location.attr('data-location'));
                    control.showHideAddButton();
                }
            });

            // Delete element from location.
            control.container.on('click', '.ikonwp-builder-element-delete', function (e) {
                e.preventDefault();

                var $element = $(this).parent('.ikonwp-builder-element'),
                    $location = $element.closest('.ikonwp-builder-location');

                $element.prependTo(control.builderInactive.children('.ikonwp-builder-sortable-panel'));
                control.updateValue($location.attr('data-location'));
                control.showHideAddButton();
            });

            // Initialize sortable.
            control.container.find('.ikonwp-builder-sortable-panel').sortable({
                items: '.ikonwp-builder-element:not(.ikonwp-builder-element-disabled)',
                connectWith: '.ikonwp-builder-sortable-panel[data-connect="' + control.builder.attr('data-name') + '"]',
                containment: control.container,
                update: function (e, ui) {
                    control.updateValue($(e.target).parent().attr('data-location'));
                    control.showHideAddButton();
                },

                receive: function (e, ui) {
                    var limitations = $(ui.item).attr('data-limitations').split(',');

                    if (0 <= limitations.indexOf($(this).parent().attr('data-location'))) {
                        $(ui.sender).sortable('cancel');
                    }
                },
                start: function (e, ui) {
                    var limitations = $(ui.item).attr('data-limitations').split(',');

                    for (var i = 0; i < limitations.length; ++i) {
                        var $target = control.builderLocations.filter('[data-location="' + limitations[i] + '"]');
                        if (undefined === $target) continue;

                        $target.addClass('disabled');
                    }
                },
                stop: function (e, ui) {
                    control.builderLocations.removeClass('disabled');
                    control.builderInactive.removeClass('disabled');
                }
            })
                .disableSelection();
        }
    });

    /**
     * API on ready event handlers
     *
     * All handlers need to be inside the 'ready' state.
     */
    wp.customize.bind('ready', function () {

        /**
         * IkonWP responsive control
         */

        // Set handler when custom responsive toggle is clicked.
        $('#customize-controls').on('click', '.ikonwp-responsive-switcher-button', function (e) {
            e.preventDefault();

            wp.customize.previewedDevice.set($(this).attr('data-device'));
        });

        // Set all custom responsive toggles and fieldsets.
        var setCustomResponsiveElementsDisplay = function () {
            var device = wp.customize.previewedDevice.get(),
                $buttons = $('span.ikonwp-responsive-switcher-button'),
                $tabs = $('.ikonwp-responsive-switcher-button.nav-tab'),
                $panels = $('.ikonwp-responsive-fieldset');

            $panels.removeClass('active').filter('.preview-' + device).addClass('active');
            $buttons.removeClass('active').filter('.preview-' + device).addClass('active');
            $tabs.removeClass('nav-tab-active').filter('.preview-' + device).addClass('nav-tab-active');
        }

        // Refresh all responsive elements when previewedDevice is changed.
        wp.customize.previewedDevice.bind(setCustomResponsiveElementsDisplay);

        // Refresh all responsive elements when any section is expanded.
        // This is required to set responsive elements on newly added controls inside the section.
        wp.customize.section.each(function (section) {
            section.expanded.bind(setCustomResponsiveElementsDisplay);
        });

        /**
         * Event handler for links to set preview URL.
         */
        $('#customize-controls').on('click', '.ikonwp-customize-set-preview-url', function (e) {
            e.preventDefault();

            var $this = $(this),
                href = $this.attr('href'),
                url = getUrlParameter('url', href);

            if (url !== wp.customize.previewer.previewUrl()) {
                wp.customize.previewer.previewUrl(url);
            }
        });

        /**
         * Event handler for links to jump to a certain control / section.
         */
        $('#customize-controls').on('click', '.ikonwp-customize-goto-control', function (e) {
            e.preventDefault();

            var $this = $(this),
                href = $this.attr('href'),
                targetControl = getUrlParameter('autofocus[control]', href),
                targetSection = getUrlParameter('autofocus[section]', href),
                targetPanel = getUrlParameter('autofocus[panel]', href);

            if (targetControl) {
                wp.customize.control(targetControl).focus();
            } else if (targetSection) {
                wp.customize.section(targetSection).focus();
            } else if (targetPanel) {
                wp.customize.panel(targetPanel).focus();
            }
        });

        if (ikonwp_customizer_controls_data && ikonwp_customizer_controls_data.contexts) {
            /**
             * Active callback script (JS version)
             */
            _.each(ikonwp_customizer_controls_data.contexts, function (rules, key) {
                var getSetting = function (settingName) {
                    // Get the dependent setting.
                    switch (settingName) {
                        case '__device':
                            return wp.customize.previewedDevice;
                            break;

                        default:
                            return wp.customize(settingName);
                            break;
                    }
                }

                var initContext = function (element) {
                    // Main function returning the conditional value
                    var isDisplayed = function () {
                        var displayed = false,
                            relation = rules['relation'];

                        // Fallback invalid relation type to "AND".
                        // Assign default displayed to true for "AND" relation type.
                        if ('OR' !== relation) {
                            relation = 'AND';
                            displayed = true;
                        }

                        // Each rule iteration
                        _.each(rules, function (rule, i) {
                            // Skip "relation" property.
                            if ('relation' == i) return;

                            // If in "AND" relation and "displayed" already flagged as false, skip the rest rules.
                            if ('AND' == relation && false == displayed) return;

                            // Skip if no setting propery found.
                            if (undefined === rule['setting']) return;

                            var result = false,
                                setting = getSetting(rule['setting']);

                            // Only process the rule if dependent setting is found.
                            // Otherwise leave the result to "false".
                            if (undefined !== setting) {
                                var operator = rule['operator'],
                                    comparedValue = rule['value'],
                                    currentValue = setting.get();

                                if (undefined == operator || '=' == operator) {
                                    operator = '==';
                                }

                                switch (operator) {
                                    case '>':
                                        result = currentValue > comparedValue;
                                        break;

                                    case '<':
                                        result = currentValue < comparedValue;
                                        break;

                                    case '>=':
                                        result = currentValue >= comparedValue;
                                        break;

                                    case '<=':
                                        result = currentValue <= comparedValue;
                                        break;

                                    case 'in':
                                        result = 0 <= comparedValue.indexOf(currentValue);
                                        break;

                                    case 'not_in':
                                        result = 0 > comparedValue.indexOf(currentValue);
                                        break;

                                    case 'contain':
                                        result = 0 <= currentValue.indexOf(comparedValue);
                                        break;

                                    case 'not_contain':
                                        result = 0 > currentValue.indexOf(comparedValue);
                                        break;

                                    case '!=':
                                        result = comparedValue != currentValue;
                                        break;

                                    case 'empty':
                                        result = 0 == currentValue.length;
                                        break;

                                    case '!empty':
                                        result = 0 < currentValue.length;
                                        break;

                                    default:
                                        result = comparedValue == currentValue;
                                        break;
                                }
                            }

                            // Combine to the final result.
                            switch (relation) {
                                case 'OR':
                                    displayed = displayed || result;
                                    break;

                                default:
                                    displayed = displayed && result;
                                    break;
                            }
                        });

                        return displayed;
                    };

                    // Wrapper function for binding purpose
                    var setActiveState = function () {
                        element.active.set(isDisplayed());
                    };

                    // Setting changes bind
                    _.each(rules, function (rule, i) {
                        // Skip "relation" property.
                        if ('relation' == i) return;

                        var setting = getSetting(rule['setting']);

                        if (undefined !== setting) {
                            // Bind the setting for future use.
                            setting.bind(setActiveState);
                        }
                    });

                    // Initial run
                    element.active.validate = isDisplayed;
                    setActiveState();
                };

                wp.customize.control(key, initContext);
            });
        }

        /**
         * Resize Preview Frame when show / hide Builder.
         */
        var resizePreviewer = function () {
            var $section = $('.control-section.ikonwp-builder-active');

            if (1324 <= window.innerWidth && $body.hasClass('ikonwp-has-builder-active') && 0 < $section.length && !$section.hasClass('ikonwp-hide')) {
                wp.customize.previewer.container.css({"bottom": $section.outerHeight() + 'px'});
            } else {
                wp.customize.previewer.container.css({"bottom": ""});
            }
        }
        $window.on('resize', resizePreviewer);
        wp.customize.previewedDevice.bind(function (device) {
            setTimeout(function () {
                resizePreviewer();
            }, 250);
        });

        /**
         * Init Header & Footer Builder
         */
        var initHeaderFooterBuilder = function (panel) {
            var section = 'ikonwp_header' === panel.id ? wp.customize.section('ikonwp_header_builder') : wp.customize.section('ikonwp_footer_builder'),
                $section = section.contentContainer;

            // If Header panel is expanded, add class to the body tag (for CSS styling).
            panel.expanded.bind(function (isExpanded) {
                _.each(section.controls(), function (control) {
                    if ('resolved' === control.deferred.embedded.state()) {
                        return;
                    }
                    control.renderContent();
                    control.deferred.embedded.resolve(); // This triggers control.ready().

                    // Fire event after control is initialized.
                    control.container.trigger('init');
                });

                if (isExpanded) {
                    $body.addClass('ikonwp-has-builder-active');
                    $section.addClass('ikonwp-builder-active');
                } else {
                    $body.removeClass('ikonwp-has-builder-active');
                    $section.removeClass('ikonwp-builder-active');
                }

                resizePreviewer();
            });

            // Attach callback to builder toggle.
            $section.on('click', '.ikonwp-builder-toggle', function (e) {
                e.preventDefault();
                $section.toggleClass('ikonwp-hide');

                resizePreviewer();
            });

            $section.find('.ikonwp-builder-sortable-panel').on('sortover', function (e, ui) {
                resizePreviewer();
            });

            var moveHeaderFooterBuilder = function () {
                if (1324 <= window.innerWidth) {
                    $section.insertAfter($('.wp-full-overlay-sidebar-content'));

                    if (section.expanded()) {
                        section.collapse();
                    }
                } else {
                    $section.appendTo($('#customize-theme-controls'));
                }
            }
            wp.customize.bind('pane-contents-reflowed', moveHeaderFooterBuilder);
            $window.on('resize', moveHeaderFooterBuilder);
        };
        wp.customize.panel('ikonwp_header', initHeaderFooterBuilder);
        wp.customize.panel('ikonwp_footer', initHeaderFooterBuilder);

        /**
         * Init Header Elements Locations Grouping
         */
        var initHeaderFooterBuilderElements = function (e) {
            var $control = $(this),
                mode = 0 <= $control.attr('id').indexOf('header') ? 'header' : 'footer',
                $groupWrapper = $control.find('.ikonwp-builder-locations').addClass('ikonwp-builder-groups'),
                verticalSelector = '.ikonwp-builder-location-vertical_top, .ikonwp-builder-location-vertical_middle, .ikonwp-builder-location-vertical_bottom',
                $verticalLocations = $control.find(verticalSelector),
                $horizontalLocations = $control.find('.ikonwp-builder-location').not(verticalSelector);

            if ($verticalLocations.length) {
                $(document.createElement('div')).addClass('ikonwp-builder-group ikonwp-builder-group-vertical ikonwp-builder-layout-block').appendTo($groupWrapper).append($verticalLocations);
            }

            if ($horizontalLocations.length) {
                $(document.createElement('div')).addClass('ikonwp-builder-group ikonwp-builder-group-horizontal ikonwp-builder-layout-inline').appendTo($groupWrapper).append($horizontalLocations);
            }

            // Make logo element has button-primary colors.
            $control.find('.ikonwp-builder-element[data-value="logo"], .ikonwp-builder-element[data-value="mobile-logo"]').addClass('button-primary');

            // Element on click jump to element options.
            $control.on('click', '.ikonwp-builder-location .ikonwp-builder-element > span', function (e) {
                e.preventDefault();

                var $element = $(this).parent('.ikonwp-builder-element'),
                    targetKey = 'heading_' + mode + '_' + $element.attr('data-value').replace('-', '_'),
                    targetControl = wp.customize.control(targetKey);

                if (targetControl) targetControl.focus();
            });

            // Group edit button on click jump to group section.
            $control.on('click', '.ikonwp-builder-group-edit', function (e) {
                e.preventDefault();

                var targetKey = 'ikonwp_' + ('footer_elements' == control.id ? 'footer' : 'header') + '_' + $(this).attr('data-value').replace('-', '_'),
                    targetSection = wp.customize.section(targetKey);

                if (targetSection) targetSection.focus();
            });
        };
        wp.customize.control('ikonwp_header_builder_elements').container.on('init', initHeaderFooterBuilderElements);
        wp.customize.control('ikonwp_header_builder_mobile_elements').container.on('init', initHeaderFooterBuilderElements);
    });

})(wp, jQuery);