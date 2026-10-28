<?php
/**
 * Contact Page Settings Customizer
 *
 * @package jobscout
 */

if ( ! function_exists( 'jobscout_customize_register_contact_page' ) ) :

function jobscout_customize_register_contact_page( $wp_customize ) {

    $wp_customize->add_section(
        'contact_page_settings',
        array(
            'title'      => __( 'Contact Page Settings (Trang Liên Hệ)', 'jobscout' ),
            'priority'   => 35,
            'capability' => 'edit_theme_options',
        )
    );

    /* ==========================================
       1. HERO BANNER
       ========================================== */
    $wp_customize->add_setting(
        'contact_banner_image',
        array(
            'default'           => get_template_directory_uri() . '/images/contact-banner-kimono.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'contact_banner_image',
            array(
                'label'       => __( '[Khối 1] Ảnh Banner', 'jobscout' ),
                'description' => __( 'Tải lên hoặc thay đổi ảnh nền banner đầu trang.', 'jobscout' ),
                'section'     => 'contact_page_settings',
                'priority'    => 10,
            )
        )
    );

    $wp_customize->add_setting(
        'contact_banner_title',
        array(
            'default'           => 'CONTACT US',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_banner_title',
        array(
            'label'       => __( '[Khối 1] Tiêu đề Banner', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 15,
        )
    );

    /* ==========================================
       2. HEADQUARTERS ADDRESS
       ========================================== */
    $wp_customize->add_setting(
        'contact_hq_title',
        array(
            'default'           => 'Our Headquarters Address',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_hq_title',
        array(
            'label'       => __( '[Khối 2] Tiêu đề Trụ sở chính', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 20,
        )
    );

    $wp_customize->add_setting(
        'contact_hq_address',
        array(
            'default'           => '60 Nguyen Van Thu, Ward Da Kao, District 1, Ho Chi Minh City, Viet Nam',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'contact_hq_address',
        array(
            'label'       => __( '[Khối 2] Địa chỉ Trụ sở', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'textarea',
            'priority'    => 25,
        )
    );

    /* ==========================================
       3. FOR EMPLOYERS (CỘT 1)
       ========================================== */
    $wp_customize->add_setting(
        'contact_employers_heading',
        array(
            'default'           => 'For Employers',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_employers_heading',
        array(
            'label'       => __( '[Khối 3] Tiêu đề Cột Nhà tuyển dụng', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 30,
        )
    );

    $wp_customize->add_setting(
        'contact_employers_subtext',
        array(
            'default'           => 'Call our Sales Hotline',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_employers_subtext',
        array(
            'label'       => __( '[Khối 3] Dòng phụ Nhà tuyển dụng', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 35,
        )
    );

    $wp_customize->add_setting(
        'contact_hcm_label',
        array(
            'default'           => 'Ho Chi Minh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_hcm_label',
        array(
            'label'       => __( '[Khối 3] Nhãn Hotline Hồ Chí Minh', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 40,
        )
    );

    $wp_customize->add_setting(
        'contact_hcm_phone',
        array(
            'default'           => '+84 28 3911 2000',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_hcm_phone',
        array(
            'label'       => __( '[Khối 3] Số điện thoại Hotline HCM', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 45,
        )
    );

    $wp_customize->add_setting(
        'contact_hn_label',
        array(
            'default'           => 'Ha Noi',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_hn_label',
        array(
            'label'       => __( '[Khối 3] Nhãn Hotline Hà Nội', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 50,
        )
    );

    $wp_customize->add_setting(
        'contact_hn_phone',
        array(
            'default'           => '+84 24 3936 8888',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_hn_phone',
        array(
            'label'       => __( '[Khối 3] Số điện thoại Hotline Hà Nội', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 55,
        )
    );

    $wp_customize->add_setting(
        'contact_employers_note',
        array(
            'default'           => "Request a call from one of our\nCustomer Love Account Managers\nWe're ready to help you grow!",
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        'contact_employers_note',
        array(
            'label'       => __( '[Khối 3] Lời nhắn / Ghi chú Nhà tuyển dụng', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'textarea',
            'priority'    => 60,
        )
    );

    /* ==========================================
       4. FOR JOBSEEKERS (CỘT 2)
       ========================================== */
    $wp_customize->add_setting(
        'contact_jobseekers_heading',
        array(
            'default'           => 'For Jobseekers',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_jobseekers_heading',
        array(
            'label'       => __( '[Khối 3] Tiêu đề Cột Ứng viên', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 65,
        )
    );

    $wp_customize->add_setting(
        'contact_fb_text',
        array(
            'default'           => 'Ask a question on our',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_fb_text',
        array(
            'label'       => __( '[Khối 3] Text hỏi đáp Facebook', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 70,
        )
    );

    $wp_customize->add_setting(
        'contact_fb_url',
        array(
            'default'           => 'https://facebook.com',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'contact_fb_url',
        array(
            'label'       => __( '[Khối 3] Link Fanpage Facebook', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'url',
            'priority'    => 75,
        )
    );

    $wp_customize->add_setting(
        'contact_blog_text',
        array(
            'default'           => 'Read our blog posts on interview and CV tips',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_blog_text',
        array(
            'label'       => __( '[Khối 3] Text bài viết Blog/Tips', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 80,
        )
    );

    $wp_customize->add_setting(
        'contact_seeker_phone_label',
        array(
            'default'           => 'Call us at',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_seeker_phone_label',
        array(
            'label'       => __( '[Khối 3] Nhãn Hotline Ứng viên', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 85,
        )
    );

    $wp_customize->add_setting(
        'contact_seeker_phone',
        array(
            'default'           => '+84 28 3822 1234',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'contact_seeker_phone',
        array(
            'label'       => __( '[Khối 3] Số điện thoại Hotline Ứng viên', 'jobscout' ),
            'section'     => 'contact_page_settings',
            'type'        => 'text',
            'priority'    => 90,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_contact_page' );

