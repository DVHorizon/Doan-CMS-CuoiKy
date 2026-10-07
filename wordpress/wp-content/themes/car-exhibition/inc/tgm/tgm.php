<?php
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function car_exhibition_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Contact Form 7', 'car-exhibition' ),
			'slug'             => 'contact-form-7',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'      => esc_html__( 'Essential Blocks', 'car-exhibition' ),
			'slug'      => 'essential-blocks',
			'source'    => '',
			'required'  => false,
			'force_activation' => false,
        ),
		array(
			'name'             => __( 'Classic Blog Grid', 'car-exhibition' ),
			'slug'             => 'classic-blog-grid',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'car_exhibition_register_recommended_plugins' );