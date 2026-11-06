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
       0. SẮP XẾP THỨ TỰ CÁC KHỐI (REORDER)
       ========================================== */
    $wp_customize->add_setting(
        'news_sections_order',
        array(
            'default'           => 'banner,grid,newsletter',
            'sanitize_callback' => 'jobscout_sanitize_news_sections_order',
        )
    );

    $wp_customize->add_control(
        new JobScout_Sortable_Control(
            $wp_customize,
            'news_sections_order',
            array(
                'label'       => __( 'Sắp Xếp Thứ Tự Khối Trang News', 'jobscout' ),
                'description' => __( 'Kéo thả để sắp xếp thứ tự hiển thị các khối nội dung trên trang News.', 'jobscout' ),
                'section'     => 'news_page_settings',
                'priority'    => 5,
                'choices'     => array(
                    'banner'     => __( 'Khối 1: Banner / Hero', 'jobscout' ),
                    'grid'       => __( 'Khối 2: Danh Sách Tin Tức (Grid & Phân Trang)', 'jobscout' ),
                    'newsletter' => __( 'Khối 3: Đăng Ký Bản Tin (Newsletter)', 'jobscout' ),
                ),
            )
        )
    );

    $wp_customize->add_setting(
        'news_detail_sections_order',
        array(
            'default'           => 'breadcrumb,header,description,content,related',
            'sanitize_callback' => 'jobscout_sanitize_news_detail_sections_order',
        )
    );
    $wp_customize->add_control(
        new JobScout_Sortable_Control(
            $wp_customize,
            'news_detail_sections_order',
            array(
                'label'       => __( 'Sắp Xếp Vị Trí Khối Trang Chi Tiết (News Detail)', 'jobscout' ),
                'description' => __( 'Kéo thả để sắp xếp thứ tự hiển thị các khối nội dung trên trang chi tiết bài viết.', 'jobscout' ),
                'section'     => 'news_page_settings',
                'priority'    => 6,
                'choices'     => array(
                    'breadcrumb'  => __( 'Khối 1: Breadcrumb (Đường dẫn điều hướng)', 'jobscout' ),
                    'header'      => __( 'Khối 2: Header Card (Ảnh, tiêu đề, ngày, share)', 'jobscout' ),
                    'description' => __( 'Khối 3: Mô tả ngắn in nghiêng (50 ký tự)', 'jobscout' ),
                    'content'     => __( 'Khối 4: Nội dung chi tiết bài viết', 'jobscout' ),
                    'related'     => __( 'Khối 5: Bài viết liên quan (Newest Blog)', 'jobscout' ),
                ),
            )
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

    // Fallback Post Thumbnail Image
    $wp_customize->add_setting(
        'news_fallback_image',
        array(
            'default'           => get_template_directory_uri() . '/images/default-thumbnail.svg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'news_fallback_image',
            array(
                'label'       => __( 'Ảnh mặc định bài viết (Fallback Image)', 'jobscout' ),
                'description' => __( 'Tải lên hoặc chọn ảnh mặc định khi bài viết không có thumbnail hoặc khi ảnh gặp lỗi tải (404/broken image). Hiển thị trên cả trang danh sách tin tức và chi tiết bài viết.', 'jobscout' ),
                'section'     => 'news_page_settings',
                'priority'    => 28,
            )
        )
    );

    // News Detail Short Description (Editable Text)
    $wp_customize->add_setting(
        'news_detail_short_desc',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_detail_short_desc',
        array(
            'label'       => __( 'Mô tả ngắn chi tiết tin tức (Tối đa 50 ký tự)', 'jobscout' ),
            'description' => __( 'Nhập mô tả in nghiêng hiển thị đầu bài viết trang chi tiết (mặc định cho bài viết không có mô tả riêng).', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'text',
            'priority'    => 29,
            'input_attrs' => array(
                'maxlength'   => 50,
                'placeholder' => __( 'Tối đa 50 ký tự...', 'jobscout' ),
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

    /* ==========================================
       4. TÙY CHỈNH ĐỘ RỘNG KHUNG (MAX-WIDTH) & VỊ TRÍ CĂN LỀ (LEFT / CENTER / RIGHT)
       ========================================== */
    $align_choices = array(
        'left'   => __( 'Căn trái (Left)', 'jobscout' ),
        'center' => __( 'Căn giữa (Center)', 'jobscout' ),
        'right'  => __( 'Căn phải (Right)', 'jobscout' ),
    );

    // News Detail Content Max Width & Alignment
    $wp_customize->add_setting(
        'news_detail_content_max_width',
        array(
            'default'           => 1140,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'news_detail_content_max_width',
        array(
            'label'       => __( 'Độ rộng tối đa khung nội dung chi tiết (px)', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'number',
            'priority'    => 40,
            'input_attrs' => array(
                'min'  => 500,
                'max'  => 1400,
                'step' => 10,
            ),
        )
    );

    $wp_customize->add_setting(
        'news_detail_content_align',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_detail_content_align',
        array(
            'label'    => __( 'Căn lề khung nội dung chi tiết (Trái / Giữa / Phải)', 'jobscout' ),
            'section'  => 'news_page_settings',
            'type'     => 'select',
            'priority' => 41,
            'choices'  => $align_choices,
        )
    );

    // News Detail Header Max Width & Alignment
    $wp_customize->add_setting(
        'news_detail_header_max_width',
        array(
            'default'           => 1140,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'news_detail_header_max_width',
        array(
            'label'       => __( 'Độ rộng tối đa khung tiêu đề/header chi tiết (px)', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'number',
            'priority'    => 45,
            'input_attrs' => array(
                'min'  => 500,
                'max'  => 1400,
                'step' => 10,
            ),
        )
    );

    $wp_customize->add_setting(
        'news_detail_header_align',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_detail_header_align',
        array(
            'label'    => __( 'Căn lề khung tiêu đề/header chi tiết (Trái / Giữa / Phải)', 'jobscout' ),
            'section'  => 'news_page_settings',
            'type'     => 'select',
            'priority' => 46,
            'choices'  => $align_choices,
        )
    );

    // News Detail Related Max Width & Alignment
    $wp_customize->add_setting(
        'news_detail_related_max_width',
        array(
            'default'           => 1140,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'news_detail_related_max_width',
        array(
            'label'       => __( 'Độ rộng tối đa bài viết liên quan (px)', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'number',
            'priority'    => 50,
            'input_attrs' => array(
                'min'  => 500,
                'max'  => 1400,
                'step' => 10,
            ),
        )
    );

    $wp_customize->add_setting(
        'news_detail_related_align',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_detail_related_align',
        array(
            'label'    => __( 'Căn lề bài viết liên quan (Trái / Giữa / Phải)', 'jobscout' ),
            'section'  => 'news_page_settings',
            'type'     => 'select',
            'priority' => 51,
            'choices'  => $align_choices,
        )
    );

    // News List Container Max Width & Alignment
    $wp_customize->add_setting(
        'news_list_container_max_width',
        array(
            'default'           => 1140,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'news_list_container_max_width',
        array(
            'label'       => __( 'Độ rộng tối đa danh sách tin tức (px)', 'jobscout' ),
            'section'     => 'news_page_settings',
            'type'        => 'number',
            'priority'    => 55,
            'input_attrs' => array(
                'min'  => 500,
                'max'  => 1400,
                'step' => 10,
            ),
        )
    );

    $wp_customize->add_setting(
        'news_list_container_align',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'news_list_container_align',
        array(
            'label'    => __( 'Căn lề danh sách tin tức (Trái / Giữa / Phải)', 'jobscout' ),
            'section'  => 'news_page_settings',
            'type'     => 'select',
            'priority' => 56,
            'choices'  => $align_choices,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_news_page' );
