<?php

/**
 * Class IkonWP_Customize_Checkbox_Multiple_Control
 */
class IkonWP_Customize_Checkbox_Multiple_Control extends WP_Customize_Control {

	/**
	 * Type
	 */
	public $type = 'checkbox-multiple';

	/**
	 * Enqueue scripts
	 */
	public function enqueue() {

		/** customize checkbox multiple js */
		wp_enqueue_script( 'customize-checkbox-multiple', get_template_directory_uri() . '/js/customize-checkbox-multiple.js', array( 'jquery' ), '1.0.0', true );
	}

	/**
	 * Render the control
	 */
	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}
		?>

		<?php if ( ! empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>

		<?php $multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

        <ul>
			<?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox"
                               value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
						<?php echo esc_html( $label ); ?>
                    </label>
                </li>

			<?php endforeach; ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>"/>
		<?php
	}
}