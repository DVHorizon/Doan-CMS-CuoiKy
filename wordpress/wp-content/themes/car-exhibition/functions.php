<?php
/**
 * Car Exhibition functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @subpackage Car Exhibition
 * @since Car Exhibition 1.0
 */

if ( ! function_exists( 'car_exhibition_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function car_exhibition_setup() {
	load_theme_textdomain( 'car-exhibition', get_template_directory() . '/languages' );

	/**
	 * Load TGM.
	 */
	require get_template_directory() . '/inc/tgm/tgm.php';

	/**
	 * Notice.
	 */
	require_once get_template_directory() . '/inc/notice/notice.php';

	/**
	 * Theme Info Page.
	 */
	require get_template_directory() . '/inc/addon.php';

	/**
	 * Customizer
	 */
	require get_template_directory() . '/inc/customizer.php';

}
endif;
add_action( 'after_setup_theme', 'car_exhibition_setup' );

function car_exhibition_block_assets(){
	wp_enqueue_style( 'car-exhibition-fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.css', array(), '7.1.0' );
	wp_enqueue_style( 'car-exhibition-animatecss', get_template_directory_uri() . '/assets/css/animate.css');
	wp_enqueue_style( 'car-exhibition-owlcarousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');
	wp_enqueue_style( 'car-exhibition-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script('car-exhibition-wow-script', get_template_directory_uri() . '/assets/js/wow.js', array('jquery'));
	wp_enqueue_script('car-exhibition-owlcarousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'));
	wp_enqueue_script('car-exhibition-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
	wp_style_add_data( 'car-exhibition-style', 'rtl', 'replace' );
}
add_action('enqueue_block_assets', 'car_exhibition_block_assets');

function car_exhibition_setup_theme() {
	if ( ! defined( 'CAR_EXHIBITION_PREMIUM_PAGE' ) ) {
		define('CAR_EXHIBITION_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/auto-expo-wordpress-theme','car-exhibition'));
	}
	if ( ! defined( 'CAR_EXHIBITION_PRO_NAME' ) ) {
		define( 'CAR_EXHIBITION_PRO_NAME', __( 'About Car Exhibition', 'car-exhibition' ));
	}
	if ( ! defined( 'CAR_EXHIBITION_THEME_PAGE' ) ) {
		define('CAR_EXHIBITION_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','car-exhibition'));
	}
	if ( ! defined( 'CAR_EXHIBITION_SUPPORT' ) ) {
		define('CAR_EXHIBITION_SUPPORT',__('https://wordpress.org/support/theme/car-exhibition/','car-exhibition'));
	}
	if ( ! defined( 'CAR_EXHIBITION_REVIEW' ) ) {
		define('CAR_EXHIBITION_REVIEW',__('https://wordpress.org/support/theme/car-exhibition/reviews/','car-exhibition'));
	}
	if ( ! defined( 'CAR_EXHIBITION_PRO_DEMO' ) ) {
		define('CAR_EXHIBITION_PRO_DEMO',__('https://live.theclassictemplates.com/car-exhibition-pro/','car-exhibition'));
	}
	if ( ! defined( 'CAR_EXHIBITION_THEME_DOCUMENTATION' ) ) {
		define('CAR_EXHIBITION_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/car-exhibition-free/','car-exhibition'));
	}
	if ( ! defined( 'CAR_EXHIBITION_BUNDLE_PAGE' ) ) {
		define('CAR_EXHIBITION_BUNDLE_PAGE',__('https://www.theclassictemplates.com/products/wordpress-theme-bundle','car-exhibition'));
	}
}
add_action('after_setup_theme', 'car_exhibition_setup_theme');

function car_exhibition_enqueue_admin_script($hook) {
    // Enqueue admin JS for notices
    wp_enqueue_script('car-exhibition-welcome-notice', get_template_directory_uri() . '/inc/notice/notice.js', array('jquery'), '', true);
    
    // Localize script to pass data to JavaScript
    wp_localize_script('car-exhibition-welcome-notice', 'car_exhibition_localize', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('car_exhibition_welcome_nonce'),
        'dismiss_nonce' => wp_create_nonce('car_exhibition_welcome_nonce'), 
        'redirect_url' => admin_url('themes.php?page=car-exhibition')
    ));
}
add_action('admin_enqueue_scripts', 'car_exhibition_enqueue_admin_script');

add_action( 'admin_init', function() {
  update_option( 'essential_blocks_quick_setup_shown', true );
  update_option( 'essential_blocks_user_type', 'old' );
  remove_submenu_page( 'admin.php', 'eb-quick-setup' );
});