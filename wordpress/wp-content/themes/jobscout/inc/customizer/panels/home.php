<?php
/**
 * Front Page Settings
 *
 * @package jobscout
 */
if ( ! function_exists( 'jobscout_customize_register_frontpage' ) ) :

function jobscout_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'jobscout' ),
            'description' => __( 'Static Home Page settings.', 'jobscout' ),
        ) 
    );     

    /** Section Reorder Settings */
    $wp_customize->add_section(
        'home_sections_reorder_section',
        array(
            'title'       => __( 'Sắp xếp thứ tự các khối (Reorder)', 'jobscout' ),
            'priority'    => 1,
            'panel'       => 'frontpage_settings',
            'description' => __( 'Dùng chuột kéo thả để hoán đổi vị trí hiển thị giữa các section trên Trang chủ (Ví dụ: kéo Blog lên trước CTA).', 'jobscout' ),
        )
    );

    $wp_customize->add_setting(
        'home_sections_order',
        array(
            'default'           => array( 'banner', 'jobposting', 'cta', 'blog' ),
            'sanitize_callback' => 'jobscout_sanitize_sortable_sections',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        new JobScout_Sortable_Sections_Control(
            $wp_customize,
            'home_sections_order',
            array(
                'label'       => __( 'Thứ tự các khối Trang chủ', 'jobscout' ),
                'description' => __( 'Kéo thả các khối bên dưới để thay đổi thứ tự xuất hiện ngoài trang chủ:', 'jobscout' ),
                'section'     => 'home_sections_reorder_section',
                'priority'    => 10,
                'choices'     => array(
                    'banner'     => __( 'Khối 1: Banner Tìm Việc', 'jobscout' ),
                    'jobposting' => __( 'Khối 2: Top Jobs (Việc làm nổi bật)', 'jobscout' ),
                    'cta'        => __( 'Khối 3: Career With Us (CTA)', 'jobscout' ),
                    'blog'       => __( 'Khối 4: Newest Blog Entries (Tin tức)', 'jobscout' ),
                ),
            )
        )
    );
}
endif;
add_action( 'customize_register', 'jobscout_customize_register_frontpage' );
