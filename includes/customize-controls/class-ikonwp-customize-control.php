<?php
defined( 'ABSPATH' ) or die();

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'IkonWP_Customize_Control' ) ) {

	/**
	 * Class IkonWP_Customize_Control
	 */
	class IkonWP_Customize_Control extends WP_Customize_Control {

		/**
		 * @var string
		 */
		public $type = 'ikonwp-base';

		/**
		 * Render control's content
		 */
		protected function render_content() {

		}

		/**
		 * Render Underscore JS template for this control's content.
		 */
		protected function content_template() {

		}

	}
}