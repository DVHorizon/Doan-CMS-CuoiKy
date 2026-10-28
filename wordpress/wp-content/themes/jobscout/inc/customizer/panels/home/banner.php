<?php
/**
 * Banner Section
 *
 * @package jobscout
 */
if ( ! function_exists( 'jobscout_customize_register_frontpage_banner' ) ) :

function jobscout_customize_register_frontpage_banner( $wp_customize ) {
	
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'jobscout' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> true,
			'sanitize_callback' => 'jobscout_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		new JobScout_Toggle_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'       => __( 'Enable Banner Section', 'jobscout' ),
                'description' => __( 'Enable to show banner section.', 'jobscout' ),
                'section'     => 'header_image',
                'priority'    => 5	
     		)            
		)
	);
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'FIND YOUR DREAM JOBS', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'jobscout' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'priority'        => 10
        )
    );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( "The secret behind our company is simple: to always put ourselves in the other person's shoes-employee, guest or customer. This allows us to see the world through their eyes, anticipate their needs and better understand their feelings.", 'jobscout' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Sub Title / Description', 'jobscout' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'priority'        => 15
        )
    );

    /** Search Keywords Placeholder */
    $wp_customize->add_setting(
        'banner_search_placeholder',
        array(
            'default'           => __( 'Search for jobs, companies, skills', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );

    $wp_customize->add_control(
        'banner_search_placeholder',
        array(
            'label'           => __( 'Search Keywords Placeholder', 'jobscout' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'priority'        => 20
        )
    );

    /** Location Dropdown Label */
    $wp_customize->add_setting(
        'banner_search_location_label',
        array(
            'default'           => __( 'Khu vực', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );

    $wp_customize->add_control(
        'banner_search_location_label',
        array(
            'label'           => __( 'Location Dropdown Label', 'jobscout' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'priority'        => 25
        )
    );

    /** Search Button Text */
    $wp_customize->add_setting(
        'banner_search_btn_label',
        array(
            'default'           => __( 'SEARCH JOB', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );

    $wp_customize->add_control(
        'banner_search_btn_label',
        array(
            'label'           => __( 'Search Button Label', 'jobscout' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'priority'        => 30
        )
    );
    
}
endif;
add_action( 'customize_register', 'jobscout_customize_register_frontpage_banner' );