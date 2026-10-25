<?php
/**
 * Job Detail Page Settings Customizer
 *
 * @package jobscout
 */

if ( ! function_exists( 'jobscout_customize_register_job_single_page' ) ) :

function jobscout_customize_register_job_single_page( $wp_customize ) {

    $wp_customize->add_section(
        'job_single_settings',
        array(
            'title'       => __( 'Job Detail Settings (Chi Tiết Việc Làm)', 'jobscout' ),
            'description' => __( 'Tùy chỉnh trang chi tiết việc làm (Single Job): Tiêu đề, Breadcrumbs, Các nút hành động, 4 phần mô tả chính, Đánh giá nhân viên (Staff Rating), Hình ảnh công ty (Company Photos), và Việc làm liên quan (Other Jobs).', 'jobscout' ),
            'priority'    => 153,
            'capability'  => 'edit_theme_options',
        )
    );

    /* ==========================================
       0. HIỂN THỊ BANNER ĐẦU TRANG (HEADER BANNER)
       ========================================== */
    $wp_customize->add_setting(
        'ed_job_banner',
        array(
            'default'           => false,
            'sanitize_callback' => 'jobscout_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'ed_job_banner',
        array(
            'label'       => __( 'Bật Banner hình ảnh cô gái ở đầu trang chi tiết', 'jobscout' ),
            'description' => __( 'Tắt tùy chọn này để trang chi tiết bắt đầu ngay từ Breadcrumbs và thông tin việc làm, không bị ảnh banner lớn che khuất.', 'jobscout' ),
            'section'     => 'job_single_settings',
            'type'        => 'checkbox',
            'priority'    => 5,
        )
    );

    /* ==========================================
       1. BREADCRUMBS & NÚT HÀNH ĐỘNG
       ========================================== */
    $wp_customize->add_setting(
        'job_single_breadcrumb_home',
        array(
            'default'           => 'Home',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_breadcrumb_home',
        array(
            'label'    => __( 'Breadcrumb: Chữ "Home"', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 10,
        )
    );

    $wp_customize->add_setting(
        'job_single_breadcrumb_all_jobs',
        array(
            'default'           => 'All Jobs',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_breadcrumb_all_jobs',
        array(
            'label'    => __( 'Breadcrumb: Chữ "All Jobs"', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 15,
        )
    );

    $wp_customize->add_setting(
        'job_single_breadcrumb_all_jobs_url',
        array(
            'default'           => home_url( '/jobs/' ),
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'job_single_breadcrumb_all_jobs_url',
        array(
            'label'    => __( 'Breadcrumb: Đường dẫn "All Jobs"', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'url',
            'priority' => 20,
        )
    );

    $wp_customize->add_setting(
        'job_single_breadcrumb_detail',
        array(
            'default'           => 'Job Detail',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_breadcrumb_detail',
        array(
            'label'    => __( 'Breadcrumb: Chữ "Job Detail"', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 25,
        )
    );

    // Button SHARE
    $wp_customize->add_setting(
        'job_single_share_text',
        array(
            'default'           => 'SHARE',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_share_text',
        array(
            'label'    => __( 'Nút SHARE', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 30,
        )
    );

    // Button APPLY JOB
    $wp_customize->add_setting(
        'job_single_apply_text',
        array(
            'default'           => 'APPLY JOB',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_apply_text',
        array(
            'label'    => __( 'Nút APPLY JOB', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting(
        'job_single_apply_url',
        array(
            'default'           => '#apply-modal',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_apply_url',
        array(
            'label'       => __( 'Hành động nút APPLY JOB (Mặc định: #apply-modal để mở popup nộp CV)', 'jobscout' ),
            'description' => __( 'Nhập #apply-modal để mở popup nộp hồ sơ kèm upload CV, hoặc nhập đường dẫn URL/email khác.', 'jobscout' ),
            'section'     => 'job_single_settings',
            'type'        => 'text',
            'priority'    => 40,
        )
    );

    // Apply Modal Title
    $wp_customize->add_setting(
        'job_single_modal_title',
        array(
            'default'           => 'Ứng tuyển công việc',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_modal_title',
        array(
            'label'    => __( 'Tiêu đề Popup Nộp Hồ Sơ', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 42,
        )
    );

    // Apply Modal Subtitle
    $wp_customize->add_setting(
        'job_single_modal_subtitle',
        array(
            'default'           => 'Vui lòng điền thông tin và đính kèm CV (PDF, DOC, DOCX tối đa 10MB)',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_modal_subtitle',
        array(
            'label'    => __( 'Mô tả hướng dẫn trong Popup', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 44,
        )
    );

    // Apply Modal Submit Button
    $wp_customize->add_setting(
        'job_single_modal_submit_text',
        array(
            'default'           => 'GỬI HỒ SƠ ỨNG TUYỂN',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_modal_submit_text',
        array(
            'label'    => __( 'Nút gửi trong Popup', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 46,
        )
    );

    // Success Modal Title
    $wp_customize->add_setting(
        'job_single_success_modal_title',
        array(
            'default'           => 'Nộp Hồ Sơ Thành Công!',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_success_modal_title',
        array(
            'label'    => __( 'Tiêu đề Popup Thành Công', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 47,
        )
    );

    // Success Modal Description
    $wp_customize->add_setting(
        'job_single_success_modal_desc',
        array(
            'default'           => 'Cảm ơn bạn! Hồ sơ ứng tuyển của bạn đã được chuyển tới nhà tuyển dụng. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất qua email.',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );
    $wp_customize->add_control(
        'job_single_success_modal_desc',
        array(
            'label'    => __( 'Nội dung Popup Thành Công', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'textarea',
            'priority' => 48,
        )
    );

    // Success Modal Button Text
    $wp_customize->add_setting(
        'job_single_success_modal_btn',
        array(
            'default'           => 'Đã Hiểu / Đóng',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_success_modal_btn',
        array(
            'label'    => __( 'Nút đóng Popup Thành Công', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 49,
        )
    );

    /* ==========================================
       1.1 CẤU HÌNH GIAO DIỆN EMAIL THÔNG BÁO (HTML EMAIL)
       ========================================== */
    // Email Header Color
    $wp_customize->add_setting(
        'job_email_primary_color',
        array(
            'default'           => '#ea580c',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'job_email_primary_color',
            array(
                'label'       => __( 'Màu sắc chủ đạo Email thông báo', 'jobscout' ),
                'description' => __( 'Tùy chỉnh màu header và nút bấm trong email gửi đến nhà tuyển dụng.', 'jobscout' ),
                'section'     => 'job_single_settings',
                'priority'    => 47,
            )
        )
    );

    // Email Header Brand Title
    $wp_customize->add_setting(
        'job_email_brand_title',
        array(
            'default'           => 'CAREERHUB - THÔNG BÁO ỨNG TUYỂN MỚI',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_email_brand_title',
        array(
            'label'       => __( 'Tiêu đề Banner trong Email', 'jobscout' ),
            'section'     => 'job_single_settings',
            'type'        => 'text',
            'priority'    => 48,
        )
    );

    // Default Recipient Email
    $wp_customize->add_setting(
        'job_email_recipient',
        array(
            'default'           => 'nhanbao410@gmail.com',
            'sanitize_callback' => 'sanitize_email',
        )
    );
    // CF7 Form Selector / Shortcode
    $wp_customize->add_setting(
        'job_single_cf7_form_id',
        array(
            'default'           => '1167',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    // Lấy danh sách các form Contact Form 7 có sẵn
    $cf7_choices = array( 'none' => __( '-- Không sử dụng CF7 (Dùng form Native) --', 'jobscout' ) );
    if ( class_exists( 'WPCF7_ContactForm' ) ) {
        $cf7_posts = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'numberposts' => -1 ) );
        foreach ( $cf7_posts as $f ) {
            $cf7_choices[ $f->ID ] = $f->post_title . ' (ID: ' . $f->ID . ')';
        }
    }
    
    $wp_customize->add_control(
        'job_single_cf7_form_id',
        array(
            'label'       => __( 'Chọn Form Contact Form 7 nộp CV', 'jobscout' ),
            'description' => __( 'Chọn form trong Contact Form 7 để nhúng vào popup hoặc trang chi tiết. Bạn có thể chỉnh sửa trường nhập, email nhận và giao diện email trực tiếp trong trang quản trị Contact Forms.', 'jobscout' ),
            'section'     => 'job_single_settings',
            'type'        => 'select',
            'choices'     => $cf7_choices,
            'priority'    => 41,
        )
    );
    /**
     * 2. BỐN PHẦN NỘI DUNG CHÍNH (LEFT COLUMN)
     * ========================================== */
    // 2.1 Overview about Company
    $wp_customize->add_setting(
        'job_single_overview_title',
        array(
            'default'           => 'Overview about Company',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_overview_title',
        array(
            'label'    => __( 'Tiêu đề Mục 1: Overview', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 50,
        )
    );

    $wp_customize->add_setting(
        'job_single_overview_content',
        array(
            'default'           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui. Ut placerat aenean accumsan a, aenean lacus eu. Aliquet urna, habitasse elit lorem id enim quam. Ea varius nulla nullam dignissim massa tempor, massa tortor. Eget auctor nulla maecenas ac tortor.\n\nOrnare faucibus sed vitae dolor eu ea faucibus leo enim. Tincidunt quisque sed netus nibh pharetra. Gravida venenatis, lobortis id mi. Metus, ultrices duis pellentesque aliquet amet cras blandit. Aliquet purus quam laoreet ipsum pretium. Odio quis eu nunc, diam habitant nunc massa sed. Placerat arcu quis est, magna facilisis amet. Dignissim vel adipiscing elit facilisi praesent platea. Nulla posuere feugiat turpis magna etiam. Non nec felis eu praesent cras.",
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );
    $wp_customize->add_control(
        'job_single_overview_content',
        array(
            'label'       => __( 'Nội dung mặc định Mục 1: Overview', 'jobscout' ),
            'description' => __( 'Hiển thị nếu bài đăng chưa có nội dung riêng hoặc làm nội dung chuẩn chung.', 'jobscout' ),
            'section'     => 'job_single_settings',
            'type'        => 'textarea',
            'priority'    => 55,
        )
    );

    // 2.2 Our Key Skills
    $wp_customize->add_setting(
        'job_single_skills_title',
        array(
            'default'           => 'Our Key Skills',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_skills_title',
        array(
            'label'    => __( 'Tiêu đề Mục 2: Key Skills', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 60,
        )
    );

    $wp_customize->add_setting(
        'job_single_skills_content',
        array(
            'default'           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui. Ut placerat aenean accumsan a, aenean lacus eu. Aliquet urna, habitasse elit lorem id enim quam. Ea varius nulla nullam dignissim massa tempor, massa tortor. Eget auctor nulla maecenas ac tortor.",
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );
    $wp_customize->add_control(
        'job_single_skills_content',
        array(
            'label'    => __( 'Nội dung mặc định Mục 2: Key Skills', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'textarea',
            'priority' => 65,
        )
    );

    // 2.3 Why You'll Love Working Here
    $wp_customize->add_setting(
        'job_single_love_title',
        array(
            'default'           => "Why You'll Love Working Here",
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_love_title',
        array(
            'label'    => __( 'Tiêu đề Mục 3: Why Love Working Here', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 70,
        )
    );

    $wp_customize->add_setting(
        'job_single_love_content',
        array(
            'default'           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui. Ut placerat aenean accumsan a, aenean lacus eu. Aliquet urna, habitasse elit lorem id enim quam. Ea varius nulla nullam dignissim massa tempor, massa tortor. Eget auctor nulla maecenas ac tortor.\n\nOrnare faucibus sed vitae dolor eu ea faucibus leo enim. Tincidunt quisque sed netus nibh pharetra. Gravida venenatis, lobortis id mi. Metus, ultrices duis pellentesque aliquet amet cras blandit. Aliquet purus quam laoreet ipsum pretium. Odio quis eu nunc, diam habitant nunc massa sed. Placerat arcu quis est, magna facilisis amet. Dignissim vel adipiscing elit facilisi praesent platea. Nulla posuere feugiat turpis magna etiam. Non nec felis eu praesent cras.",
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );
    $wp_customize->add_control(
        'job_single_love_content',
        array(
            'label'    => __( 'Nội dung mặc định Mục 3: Why Love Working Here', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'textarea',
            'priority' => 75,
        )
    );

    // 2.4 Location
    $wp_customize->add_setting(
        'job_single_location_title',
        array(
            'default'           => 'Location',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_location_title',
        array(
            'label'    => __( 'Tiêu đề Mục 4: Location', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 80,
        )
    );

    $wp_customize->add_setting(
        'job_single_location_content',
        array(
            'default'           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui.",
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );
    $wp_customize->add_control(
        'job_single_location_content',
        array(
            'label'    => __( 'Nội dung mặc định Mục 4: Location', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'textarea',
            'priority' => 85,
        )
    );

    /* ==========================================
       3. SIDEBAR: STAFF RATING
       ========================================== */
    $wp_customize->add_setting(
        'job_single_show_rating',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'job_single_show_rating',
        array(
            'label'    => __( 'Hiển thị khối Staff Rating', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'checkbox',
            'priority' => 90,
        )
    );

    $wp_customize->add_setting(
        'job_single_rating_title',
        array(
            'default'           => 'Staff Rating',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_rating_title',
        array(
            'label'    => __( 'Tiêu đề Staff Rating', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 95,
        )
    );

    $wp_customize->add_setting(
        'job_single_rating_score',
        array(
            'default'           => '4.0',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_rating_score',
        array(
            'label'    => __( 'Điểm số đánh giá (ví dụ: 4.0)', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 100,
        )
    );

    $wp_customize->add_setting(
        'job_single_rating_stars',
        array(
            'default'           => '4',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_rating_stars',
        array(
            'label'    => __( 'Số sao sáng (1 đến 5)', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'select',
            'choices'  => array(
                '1' => '1 sao',
                '2' => '2 sao',
                '3' => '3 sao',
                '4' => '4 sao (Mặc định)',
                '5' => '5 sao',
            ),
            'priority' => 105,
        )
    );

    /* ==========================================
       4. SIDEBAR: COMPANY PHOTOS
       ========================================== */
    $wp_customize->add_setting(
        'job_single_show_photos',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'job_single_show_photos',
        array(
            'label'    => __( 'Hiển thị khối Company Photos', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'checkbox',
            'priority' => 110,
        )
    );

    $wp_customize->add_setting(
        'job_single_photos_title',
        array(
            'default'           => 'Company Photos',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_photos_title',
        array(
            'label'    => __( 'Tiêu đề Company Photos', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 115,
        )
    );

    $wp_customize->add_setting(
        'job_single_photo_image',
        array(
            'default'           => home_url( '/wp-content/uploads/2026/10/tokyo.jpg' ),
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'job_single_photo_image',
            array(
                'label'       => __( 'Ảnh chụp Công ty / Văn phòng', 'jobscout' ),
                'description' => __( 'Tải lên hoặc chọn ảnh chụp công ty.', 'jobscout' ),
                'section'     => 'job_single_settings',
                'priority'    => 120,
            )
        )
    );

    $wp_customize->add_setting(
        'job_single_photos_count',
        array(
            'default'           => '+5',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_photos_count',
        array(
            'label'    => __( 'Nhãn số lượng ảnh (ví dụ: +5)', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 125,
        )
    );

    /* ==========================================
       5. OTHER JOBS SECTION
       ========================================== */
    $wp_customize->add_setting(
        'job_single_show_other',
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'job_single_show_other',
        array(
            'label'    => __( 'Hiển thị mục "OTHER JOBS" ở chân trang', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'checkbox',
            'priority' => 130,
        )
    );

    $wp_customize->add_setting(
        'job_single_other_title',
        array(
            'default'           => 'OTHER JOBS',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'job_single_other_title',
        array(
            'label'    => __( 'Tiêu đề mục Other Jobs', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'text',
            'priority' => 135,
        )
    );

    $wp_customize->add_setting(
        'job_single_other_count',
        array(
            'default'           => 6,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'job_single_other_count',
        array(
            'label'    => __( 'Số lượng việc làm liên quan hiển thị (Mặc định: 6)', 'jobscout' ),
            'section'  => 'job_single_settings',
            'type'     => 'number',
            'priority' => 140,
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_job_single_page' );
