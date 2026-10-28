<?php
/**
 * Jobs Page Settings Customizer
 *
 * @package jobscout
 */

if ( ! function_exists( 'jobscout_customize_register_jobs_page' ) ) :

function jobscout_customize_register_jobs_page( $wp_customize ) {

    $wp_customize->add_section(
        'jobs_page_settings',
        array(
            'title'       => __( 'Jobs Page Settings (Trang Việc Làm)', 'jobscout' ),
            'description' => __( 'Tùy chỉnh tiêu đề, ảnh banner và các thông tin trên trang danh sách việc làm (All Jobs). Để xem trước trực quan, hãy click vào mục JOBS trên menu xem trước.', 'jobscout' ),
            'priority'    => 152,
            'capability'  => 'edit_theme_options',
        )
    );

    /* ==========================================
       1. HERO BANNER
       ========================================== */
    // Banner Image
    $wp_customize->add_setting(
        'jobs_banner_image',
        array(
            'default'           => 'http://wordpress.local/wp-content/uploads/2026/10/images.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'jobs_banner_image',
            array(
                'label'       => __( 'Ảnh nền Banner', 'jobscout' ),
                'description' => __( 'Tải lên hoặc thay đổi ảnh nền banner đầu trang việc làm.', 'jobscout' ),
                'section'     => 'jobs_page_settings',
                'priority'    => 10,
            )
        )
    );

    // Banner Title (Slogan)
    $wp_customize->add_setting(
        'jobs_banner_title',
        array(
            'default'           => 'CAREER WITH US',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jobs_banner_title',
        array(
            'label'       => __( 'Tiêu đề Banner', 'jobscout' ),
            'section'     => 'jobs_page_settings',
            'type'        => 'text',
            'priority'    => 15,
        )
    );

    /* ==========================================
       2. DANH SÁCH VIỆC LÀM (ALL JOBS GRID)
       ========================================== */
    // Page / Section Heading
    $wp_customize->add_setting(
        'jobs_page_title',
        array(
            'default'           => 'ALL JOBS',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jobs_page_title',
        array(
            'label'       => __( 'Tiêu đề khối danh sách', 'jobscout' ),
            'section'     => 'jobs_page_settings',
            'type'        => 'text',
            'priority'    => 20,
        )
    );

    // Số việc làm hiển thị mỗi trang
    $wp_customize->add_setting(
        'jobs_posts_per_page',
        array(
            'default'           => 12,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'jobs_posts_per_page',
        array(
            'label'       => __( 'Số lượng việc làm mỗi trang', 'jobscout' ),
            'description' => __( 'Mặc định là 12 việc làm (2 cột x 6 hàng).', 'jobscout' ),
            'section'     => 'jobs_page_settings',
            'type'        => 'number',
            'priority'    => 25,
            'input_attrs' => array(
                'min'  => 2,
                'max'  => 50,
                'step' => 2,
            ),
        )
    );

    // Nút Load More Jobs
    $wp_customize->add_setting(
        'jobs_load_more_text',
        array(
            'default'           => 'LOAD MORE JOBS',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jobs_load_more_text',
        array(
            'label'       => __( 'Nút Xem Thêm Việc Làm', 'jobscout' ),
            'section'     => 'jobs_page_settings',
            'type'        => 'text',
            'priority'    => 30,
        )
    );

    // Thông báo khi chưa có việc làm
    $wp_customize->add_setting(
        'jobs_no_jobs_text',
        array(
            'default'           => 'Hiện tại chưa có vị trí tuyển dụng nào khả dụng.',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jobs_no_jobs_text',
        array(
            'label'       => __( 'Thông báo khi không có việc làm', 'jobscout' ),
            'section'     => 'jobs_page_settings',
            'type'        => 'text',
            'priority'    => 35,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_jobs_page' );
