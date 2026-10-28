<?php
/**
 * Call To Action Section - CAREER WITH US
 *
 * @package jobscout
 */

if ( ! function_exists( 'jobscout_customize_register_frontpage_cta' ) ) :

function jobscout_customize_register_frontpage_cta( $wp_customize ){

    /** Call To Action Section */
    $wp_customize->add_section(
        'cta_section',
        array(
            'title'    => __( 'Career With Us (CTA Section)', 'jobscout' ),
            'priority' => 30,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Enable/Disable */
    $wp_customize->add_setting(
        'ed_career_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_sanitize_checkbox',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'ed_career_section',
        array(
            'label'       => __( 'Bật / Tắt khối Career With Us', 'jobscout' ),
            'section'     => 'cta_section',
            'type'        => 'checkbox',
            'priority'    => 5,
        )
    );

    /** Background Image */
    $wp_customize->add_setting(
        'career_bg_image',
        array(
            'default'           => get_template_directory_uri() . '/images/home-career-sakura.jpg',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'career_bg_image',
            array(
                'label'       => __( 'Ảnh nền (Background Image)', 'jobscout' ),
                'description' => __( 'Tải lên hoặc chọn ảnh nền cho khối Career With Us.', 'jobscout' ),
                'section'     => 'cta_section',
                'priority'    => 10,
            )
        )
    );

    /** Section Title */
    $wp_customize->add_setting(
        'career_title',
        array(
            'default'           => __( 'CAREER WITH US', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'career_title',
        array(
            'label'       => __( 'Tiêu đề (Title)', 'jobscout' ),
            'section'     => 'cta_section',
            'type'        => 'text',
            'priority'    => 15,
        )
    );

    /** Section Content */
    $default_career_desc = "Plan Do See Global is a hospitality group founded in Japan and rooted in \"Omotenashi\", the Japanese principle of selfless hospitality. We strive to deliver unforgettable and bespoke experiences, to understand local cultures like natives, to provide service that is warm but not intrusive, and to foresee our guests' every need at all times. That is our sole mission and our pride.\n\nWe are experts in all stages of project development: concept, design, implementation and management. We love to find unique ways to create experiences that surprise and delight guests and customers.";

    $wp_customize->add_setting(
        'career_content',
        array(
            'default'           => $default_career_desc,
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'career_content',
        array(
            'label'       => __( 'Nội dung mô tả (Content)', 'jobscout' ),
            'description' => __( 'Các đoạn văn cách nhau bằng 1 dòng trống.', 'jobscout' ),
            'section'     => 'cta_section',
            'type'        => 'textarea',
            'priority'    => 20,
        )
    );

    /** Button Text */
    $wp_customize->add_setting(
        'career_btn_text',
        array(
            'default'           => __( 'MORE ABOUT US', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'career_btn_text',
        array(
            'label'       => __( 'Chữ trên nút bấm (Button Text)', 'jobscout' ),
            'section'     => 'cta_section',
            'type'        => 'text',
            'priority'    => 25,
        )
    );

    /** Button URL */
    $wp_customize->add_setting(
        'career_btn_url',
        array(
            'default'           => home_url( '/about/' ),
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'career_btn_url',
        array(
            'label'       => __( 'Liên kết nút bấm (Button URL)', 'jobscout' ),
            'section'     => 'cta_section',
            'type'        => 'url',
            'priority'    => 30,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_frontpage_cta' );