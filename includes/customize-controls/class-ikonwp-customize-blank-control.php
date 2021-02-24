<?php
defined( 'ABSPATH' ) or die();

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'IkonWP_Customize_Blank_Control' ) ) {

	/**
	 * Class IkonWP_Customize_Control_Blank
	 */
	class IkonWP_Customize_Blank_Control extends IkonWP_Customize_Control {

		/**
		 * @var string
		 */
		public $type = 'ikonwp-blank';

		/**
		 * Render control's content
		 */
		protected function render_content() {

			if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo $this->label; ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif;
		}
	}
}