<?php
defined( 'ABSPATH' ) or die();

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'IkonWP_Customize_Spacer_Section' ) ) {

	/**
	 * Class IkonWP_Customize_Spacer_Section
	 */
	class IkonWP_Customize_Spacer_Section extends WP_Customize_Section {

		/**
		 * @var string
		 */
		public $type = 'ikonwp-spacer-section';

		/**
		 * Render Underscore JS template for this section.
		 */
		protected function render_template() {
			?>
            <li id="accordion-section-{{ data.id }}"
                class="accordion-section control-section control-section-{{ data.type }}"></li>
			<?php
		}
	}
}
