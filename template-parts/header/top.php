<div <?php ikonwp_header_top_class( array( 'header__top' ) ); ?>>
    <div <?php ikonwp_header_top_container_class( array(
		'header__top_container',
		'd-flex',
		'justify-content-between'
	) ); ?>>

        <div class="header__top--left d-none d-lg-flex justify-content-start">
			<?php ikonwp_header_builder_get_elements_html( 'top_left' ); ?>
        </div>
        <div class="header__top--center d-none d-lg-flex justify-content-center">
			<?php ikonwp_header_builder_get_elements_html( 'top_center' ); ?>
        </div>
        <div class="header__top--right d-none d-lg-flex justify-content-end">
			<?php ikonwp_header_builder_get_elements_html( 'top_right' ); ?>
        </div>

        <div class="header__top--left header__top_mobile--left d-flex d-lg-none justify-content-start">
			<?php ikonwp_header_builder_mobile_get_elements_html( 'top_left' ); ?>
        </div>
        <div class="header__top--center header__top_mobile--center d-flex d-lg-none justify-content-center">
			<?php ikonwp_header_builder_mobile_get_elements_html( 'top_center' ); ?>
        </div>
        <div class="header__top--right header__top_mobile--right d-flex d-lg-none justify-content-end">
			<?php ikonwp_header_builder_mobile_get_elements_html( 'top_right' ); ?>
        </div>

    </div>
</div>