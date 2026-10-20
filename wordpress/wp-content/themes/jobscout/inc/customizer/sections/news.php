<?php
/**
 * News Page Settings Customizer
 *
 * @package jobscout
 */

if ( ! function_exists( 'jobscout_customize_register_news_page' ) ) :

function jobscout_customize_register_news_page( $wp_customize ) {

    $wp_customize->add_section(
        'news_page_settings',
        array(
            'title'      => __( 'News Page Settings (Trang News)', 'jobscout' ),
            'priority'   => 151,
            'capability' => 'edit_theme_options',
        )
    );

    /* ==========================================
       1. BANNER SECTION
       ========================================== */
    // Banner Image
    $wp_customize->add_setting(
        'news_banner_image',
        array(
            'default'           => get_template_directory_uri() . '/images/banner-image.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'news_banner_image',
            array(
                'label'       => __( '[Khối 1] Ảnh Banner News', 'jobscout' ),
                'description' => __( 'Tải lên hoặc chọn ảnh banner toà nhà / thành phố trên cùng.', 'jobscout' ),
                'section'     => 'news_page_settings',
                'priority'    => 10,
            )
        )
    );

    // Banner Title
    $wp_customize->add_setting(
        'news_banner_title',
        array(
            'default'           => 'PDS NEWS',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_banner_title',
        array(
            'label'       => __( '[Khối 1] Tiêu Đề Banner', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'text',
            'priority'    => 15,
        )
    );

    /* ==========================================
       2. BLOG ENTRIES SECTION
       ========================================== */
    // Section Heading Title
    $wp_customize->add_setting(
        'news_section_title',
        array(
            'default'           => 'NEWEST BLOG ENTRIES',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_section_title',
        array(
            'label'       => __( '[Khối 2] Tiêu Đề Mục Bài Viết', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'text',
            'priority'    => 20,
        )
    );

    // Posts Per Page
    $wp_customize->add_setting(
        'news_posts_per_page',
        array(
            'default'           => 8,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'news_posts_per_page',
        array(
            'label'       => __( '[Khối 2] Số lượng bài viết hiển thị mỗi trang', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'number',
            'priority'    => 25,
            'input_attrs' => array(
                'min'  => 2,
                'max'  => 40,
                'step' => 2,
            ),
        )
    );

    /* ==========================================
       3. NEWSLETTER SECTION
       ========================================== */
    // Newsletter Title
    $wp_customize->add_setting(
        'news_newsletter_title',
        array(
            'default'           => 'Subscribe To Our Newsletter',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_newsletter_title',
        array(
            'label'       => __( '[Khối 3] Tiêu Đề Newsletter', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'text',
            'priority'    => 30,
        )
    );

    // Newsletter Button Text
    $wp_customize->add_setting(
        'news_newsletter_btn',
        array(
            'default'           => 'SUBSCRIBE',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_newsletter_btn',
        array(
            'label'       => __( '[Khối 3] Chữ Trên Nút Đăng Ký', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'text',
            'priority'    => 35,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_news_page' );
