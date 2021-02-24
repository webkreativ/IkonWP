<?php
defined( 'ABSPATH' ) or die();

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'IkonWP_Customize_Pro_Link_Section' ) ) {

	/**
	 * Class IkonWP_Customize_Pro_Link_Section
	 */
	class IkonWP_Customize_Pro_Link_Section extends WP_Customize_Section {

		/**
		 * @var string
		 */
		public $type = 'ikonwp-pro-link-section';

		/**
		 * @var string
		 */
		public $url = '#';

		/**
		 * Setup parameters for content rendering by Underscore JS template.
		 */
		public function json() {
			$json        = parent::json();
			$json['url'] = $this->url;

			return $json;
		}

		/**
		 * Render Underscore JS template for this control's content.
		 */
		protected function render_template() {
			?>
            <li id="accordion-section-{{ data.id }}"
                class="accordion-section control-section control-section-{{ data.type }}">
                <a class="accordion-section-title" href="{{ data.url }}" target="_blank" rel="noopener">
                    <h3>{{{ data.title }}}</h3>
                </a>
            </li>
			<?php
		}
	}
}