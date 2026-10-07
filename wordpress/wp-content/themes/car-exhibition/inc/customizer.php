<?php
/**
 * Car Exhibition: Customizer
 *
 * @subpackage Car Exhibition
 * @since 1.0
 */

 function car_exhibition_upgrade_pro_options( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customize-controls.css');

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => esc_html__( 'About Car Exhibition', 'car-exhibition' ),
			'priority' => 1,
		)
	);

	class Car_Exhibition_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
					<li><a class="upgrade-to-pro pro-btn" href="<?php echo esc_url( CAR_EXHIBITION_PREMIUM_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'car-exhibition' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_EXHIBITION_PRO_DEMO ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'car-exhibition' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_EXHIBITION_REVIEW ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'car-exhibition' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_EXHIBITION_SUPPORT ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'car-exhibition' ); ?> </a></li>	
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_EXHIBITION_THEME_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e( 'Theme Page', 'car-exhibition' ); ?> </a></li>
				
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( CAR_EXHIBITION_THEME_DOCUMENTATION ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'car-exhibition' ); ?> </a></li>
				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'car_exhibition_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Car_Exhibition_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'car_exhibition_upgrade_pro_options' );