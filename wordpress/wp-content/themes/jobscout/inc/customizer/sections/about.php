<?php
/**
 * About Page Settings Customizer
 *
 * @package jobscout
 */

if ( ! function_exists( 'jobscout_customize_register_about_page' ) ) :

function jobscout_customize_register_about_page( $wp_customize ) {

    $wp_customize->add_section(
        'about_page_settings',
        array(
            'title'      => __( 'About Page Settings (Trang About)', 'jobscout' ),
            'priority'   => 150,
            'capability' => 'edit_theme_options',
        )
    );

    /* ==========================================
       1. BANNER SECTION
       ========================================== */
    // Banner Image
    $wp_customize->add_setting(
        'about_banner_image',
        array(
            'default'           => get_template_directory_uri() . '/images/about-banner.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_banner_image',
            array(
                'label'       => __( '[Khối 1] Ảnh Banner Phố Cổ', 'jobscout' ),
                'description' => __( 'Tải lên hoặc chọn ảnh banner phố cổ Nhật Bản.', 'jobscout' ),
                'section'     => 'about_page_settings',
                'priority'    => 10,
            )
        )
    );

    // Banner Title
    $wp_customize->add_setting(
        'about_banner_title',
        array(
            'default'           => "SHARE “OMOTENASHI”\nWITH THE WORLD",
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'about_banner_title',
        array(
            'label'       => __( '[Khối 1] Tiêu Đề Banner (Slogan)', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'textarea',
            'priority'    => 15,
        )
    );

    /* ==========================================
       2. ABOUT US SECTION
       ========================================== */
    // Torii Image
    $wp_customize->add_setting(
        'about_torii_image',
        array(
            'default'           => get_template_directory_uri() . '/images/about-torii.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_torii_image',
            array(
                'label'       => __( '[Khối 2] Ảnh Cổng Torii Bên Hồ', 'jobscout' ),
                'section'     => 'about_page_settings',
                'priority'    => 20,
            )
        )
    );

    // Vision
    $wp_customize->add_setting(
        'about_vision_desc',
        array(
            'default'           => 'Create hotels and restaurants around the world that offer memorable experiences while building a lasting, positive relationship together with our guests, partners, team members and communities.',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'about_vision_desc',
        array(
            'label'       => __( '[Khối 2] Mô tả Our Vision', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'textarea',
            'priority'    => 25,
        )
    );

    // Mission
    $wp_customize->add_setting(
        'about_mission_desc',
        array(
            'default'           => 'Share “Omotenashi” with the world',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'about_mission_desc',
        array(
            'label'       => __( '[Khối 2] Mô tả Our Mission', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'textarea',
            'priority'    => 30,
        )
    );

    // Core Value Quote
    $wp_customize->add_setting(
        'about_core_value_quote',
        array(
            'default'           => '“If I were the guest…”',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_core_value_quote',
        array(
            'label'       => __( '[Khối 2] Trích dẫn Core Value', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 35,
        )
    );

    // Core Value Description
    $wp_customize->add_setting(
        'about_core_value_desc',
        array(
            'default'           => 'To provide guests with the hospitality you would want to receive as a guest.',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'about_core_value_desc',
        array(
            'label'       => __( '[Khối 2] Mô tả Core Value', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'textarea',
            'priority'    => 40,
        )
    );

    /* ==========================================
       3. SERVICES SECTION
       ========================================== */
    // Services Highlight Title
    $wp_customize->add_setting(
        'about_services_title',
        array(
            'default'           => 'Hotels, restaurants, banquets/weddings management',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_services_title',
        array(
            'label'       => __( '[Khối 3] Tiêu Đề Màu Cam (Lĩnh vực)', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 50,
        )
    );

    // Services Description 1
    $wp_customize->add_setting(
        'about_services_desc_1',
        array(
            'default'           => 'Plan Do See developed and operates 17 properties worldwide including 3 award-winning resorts in Japan; 17 restaurants of diverse cuisines in cities including New York, Miami and Los Angeles; and other countries including Japan, Indonesia, Malaysia and Bali.',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'about_services_desc_1',
        array(
            'label'       => __( '[Khối 3] Đoạn Văn 1', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'textarea',
            'priority'    => 55,
        )
    );

    // Services Description 2
    $wp_customize->add_setting(
        'about_services_desc_2',
        array(
            'default'           => 'Each venue carries its own concept and design. Many of them are originally historical landmarks that were loved by the local people.',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'about_services_desc_2',
        array(
            'label'       => __( '[Khối 3] Đoạn Văn 2', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'textarea',
            'priority'    => 60,
        )
    );

    /* ==========================================
       4. COMPANY INFO SECTION
       ========================================== */
    // Tokyo Tower Image
    $wp_customize->add_setting(
        'about_company_image',
        array(
            'default'           => get_template_directory_uri() . '/images/about-tokyo-tower.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_company_image',
            array(
                'label'       => __( '[Khối 4] Ảnh Tokyo Tower', 'jobscout' ),
                'section'     => 'about_page_settings',
                'priority'    => 70,
            )
        )
    );

    // Established since
    $wp_customize->add_setting(
        'about_company_est',
        array(
            'default'           => 'April 1993',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_company_est',
        array(
            'label'       => __( '[Khối 4] Established since (Năm thành lập)', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 75,
        )
    );

    // Head Office
    $wp_customize->add_setting(
        'about_company_headoffice',
        array(
            'default'           => 'Marunouchi 2-1-1, Chiyoda, Tokyo',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_company_headoffice',
        array(
            'label'       => __( '[Khối 4] Head Office (Trụ sở)', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 80,
        )
    );

    // Capital
    $wp_customize->add_setting(
        'about_company_capital',
        array(
            'default'           => '100,000,000 JPY',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_company_capital',
        array(
            'label'       => __( '[Khối 4] Capital (Vốn điều lệ)', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 85,
        )
    );

    // CEO
    $wp_customize->add_setting(
        'about_company_ceo',
        array(
            'default'           => 'Yutaka Noda',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_company_ceo',
        array(
            'label'       => __( '[Khối 4] CEO', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 90,
        )
    );

    // Number of Employees
    $wp_customize->add_setting(
        'about_company_employees',
        array(
            'default'           => 'Full time: 830 / Total: 1,600',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'about_company_employees',
        array(
            'label'       => __( '[Khối 4] Number of Employees (Nhân sự)', 'jobscout' ),
            'section'     => 'about_page_settings',
            'type'        => 'text',
            'priority'    => 95,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_about_page' );
