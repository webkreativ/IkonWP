<?php

/**
 * Class IkonWP_Customize_Alpha_Color_Control
 */
class IkonWP_Customize_Alpha_Color_Control extends WP_Customize_Control {

	/**
	 * Type
	 */
	public $type = 'alpha-color';

	/**
	 * Add support for palettes to be passed in
	 * supported palette values are true, false, or an array of RGBa and Hex colors
	 */
	public $palette;

	/**
	 * Add support for showing the opacity value on the slider handle
	 */
	public $show_opacity;

	/**
	 * Enqueue scripts and styles
	 */
	public function enqueue() {
		/** customize alpha color picker css */
		wp_enqueue_style( 'customize-alpha-color-picker', get_template_directory_uri() . '/css/customize-alpha-color-picker.css', array( 'wp-color-picker' ), '1.0.0' );

		/** customize alpha color picker js */
		wp_enqueue_script( 'customize-alpha-color-picker', get_template_directory_uri() . '/js/customize-alpha-color-picker.js', array(
			'jquery',
			'wp-color-picker'
		), '1.0.0', true );
	}

	/**
	 * Render the control
	 */
	public function render_content() {
		/** process the palette */
		if ( is_array( $this->palette ) ) {
			$palette = implode( '|', $this->palette );
		} else {
			/** default to true */
			$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
		}

		/** support passing show_opacity as string or boolean. Default to true */
		$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
		?>

		<?php if ( isset( $this->label ) && '' !== $this->label ): ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( isset( $this->description ) && '' !== $this->description ): ?>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

        <div class="customize-control-content">
            <label>
                <input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>"
                       data-palette="<?php echo esc_attr( $palette ); ?>"
                       data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?> />
            </label>
        </div>
		<?php
	}
}