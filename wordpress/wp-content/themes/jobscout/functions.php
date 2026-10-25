<?php
/**
 * JobScout functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JobScout
 */

$jobscout_theme_data = wp_get_theme();
if (!defined('JOBSCOUT_THEME_VERSION'))
    define('JOBSCOUT_THEME_VERSION', $jobscout_theme_data->get('Version'));
if (!defined('JOBSCOUT_THEME_NAME'))
    define('JOBSCOUT_THEME_NAME', $jobscout_theme_data->get('Name'));

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

if (jobscout_is_rara_theme_companion_activated()):
    /**
     * Modify filter hooks of RTC plugin.
     */
    require get_template_directory() . '/inc/rtc-filters.php';
endif;

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/custom-footer-widgets.php';
require get_template_directory() . '/inc/widget-top-jobs.php';
require get_template_directory() . '/inc/widget-newest-blog.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Getting Started
 */
require get_template_directory() . '/inc/dashboard/dashboard.php';

/**
 * Plugin Recommendation
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Add theme compatibility function for woocommerce if active
 */
if (jobscout_is_woocommerce_activated()) {
    require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
 * Modify filter hooks of WP Job Manager plugin.
 */
if (jobscout_is_wp_job_manager_activated()):
    require get_template_directory() . '/inc/wp-job-manager-filters.php';
endif;

/**
 * Đồng bộ số lượng bài viết mỗi trang cho Blog/News để tránh lỗi 404 khi phân trang
 */
function jobscout_modify_news_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && ($query->is_home() || $query->is_post_type_archive('post'))) {
        $posts_per_page = get_theme_mod('news_posts_per_page', 8);
        $query->set('posts_per_page', $posts_per_page);
    }
}
add_action('pre_get_posts', 'jobscout_modify_news_posts_per_page');

/**
 * Shortcode hiển thị danh sách bài viết dạng lưới: [news_grid posts="4" cat="tin-tuc"]
 */
function jobscout_news_grid_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'posts' => 4,      // Số bài viết muốn hiển thị
        'cat' => '',     // Lọc theo slug chuyên mục (để trống là lấy tất cả)
        'title' => '',     // Tiêu đề khối (nếu muốn có)
    ), $atts, 'news_grid');

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => intval($atts['posts']),
    );

    if (!empty($atts['cat'])) {
        $args['category_name'] = sanitize_text_field($atts['cat']);
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()):
        echo '<div class="news-main-section" style="padding: 30px 0;">';
        if (!empty($atts['title'])) {
            echo '<h2 class="news-section-title">' . esc_html($atts['title']) . '</h2>';
        }
        echo '<div class="news-grid-2col">';
        while ($query->have_posts()):
            $query->the_post();
            get_template_part('template-parts/content', 'news-card');
        endwhile;
        echo '</div>';
        echo '</div>';
        wp_reset_postdata();
    endif;

    return ob_get_clean();
}
add_shortcode('news_grid', 'jobscout_news_grid_shortcode');

/**
 * Redirect /news/ to /blog/ to prevent 404
 */
function jobscout_redirect_news_to_blog() {
    $request_uri = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( $request_uri === 'news' ) {
        $posts_page_id = get_option( 'page_for_posts' );
        $target_url    = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
        wp_safe_redirect( $target_url, 301 );
        exit;
    }
}
add_action( 'template_redirect', 'jobscout_redirect_news_to_blog' );

/**
 * AJAX Load More Jobs cho trang All Jobs
 */
function jobscout_ajax_load_more_jobs() {
    $paged = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 2;
    $posts_per_page = absint( get_theme_mod( 'jobs_posts_per_page', 12 ) );
    if ( $posts_per_page <= 0 ) {
        $posts_per_page = 12;
    }

    $sort = isset( $_POST['sort'] ) ? sanitize_text_field( $_POST['sort'] ) : 'latest';

    $args = array(
        'post_type'      => 'job_listing',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => ( $sort === 'oldest' ) ? 'ASC' : 'DESC',
    );

    if ( in_array( $sort, array( 'full-time', 'part-time', 'freelance', 'internship' ), true ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'job_listing_type',
                'field'    => 'slug',
                'terms'    => $sort,
            ),
        );
    }

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        ob_start();
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/content', 'job-card' );
        }
        $html = ob_get_clean();
        wp_reset_postdata();

        wp_send_json_success( array(
            'html'      => $html,
            'max_pages' => $query->max_num_pages,
            'current'   => $paged,
            'has_more'  => ( $paged < $query->max_num_pages ),
        ) );
    } else {
        wp_send_json_error( array(
            'message' => 'No more jobs found.',
        ) );
    }
}
add_action( 'wp_ajax_load_more_jobs', 'jobscout_ajax_load_more_jobs' );
add_action( 'wp_ajax_nopriv_load_more_jobs', 'jobscout_ajax_load_more_jobs' );

/**
 * Xử lý nộp hồ sơ ứng tuyển kèm CV qua AJAX
 */
function jobscout_ajax_submit_job_application() {
    check_ajax_referer( 'jobscout_apply_nonce', 'apply_nonce' );

    $job_id    = isset( $_POST['job_id'] ) ? absint( $_POST['job_id'] ) : 0;
    $full_name = isset( $_POST['applicant_name'] ) ? sanitize_text_field( $_POST['applicant_name'] ) : '';
    $email     = isset( $_POST['applicant_email'] ) ? sanitize_email( $_POST['applicant_email'] ) : '';
    $phone     = isset( $_POST['applicant_phone'] ) ? sanitize_text_field( $_POST['applicant_phone'] ) : '';
    $message   = isset( $_POST['applicant_message'] ) ? sanitize_textarea_field( $_POST['applicant_message'] ) : '';

    if ( empty( $full_name ) || empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Vui lòng nhập họ tên và email hợp lệ.', 'jobscout' ) ) );
    }

    $cv_url  = '';
    $cv_path = '';

    // Xử lý upload file CV
    if ( ! empty( $_FILES['applicant_cv']['name'] ) ) {
        $allowed_types = array( 'pdf', 'doc', 'docx' );
        $file_info     = pathinfo( $_FILES['applicant_cv']['name'] );
        $extension     = strtolower( $file_info['extension'] ?? '' );

        if ( ! in_array( $extension, $allowed_types, true ) ) {
            wp_send_json_error( array( 'message' => __( 'Định dạng CV không được hỗ trợ. Vui lòng tải lên file PDF, DOC hoặc DOCX.', 'jobscout' ) ) );
        }

        // Tối đa 10MB
        if ( $_FILES['applicant_cv']['size'] > 10 * 1024 * 1024 ) {
            wp_send_json_error( array( 'message' => __( 'Kích thước file vượt quá 10MB.', 'jobscout' ) ) );
        }

        require_once ABSPATH . 'wp-admin/includes/file.php';
        $uploaded = wp_handle_upload( $_FILES['applicant_cv'], array( 'test_form' => false ) );

        if ( isset( $uploaded['error'] ) ) {
            wp_send_json_error( array( 'message' => $uploaded['error'] ) );
        }

        $cv_url  = $uploaded['url'] ?? '';
        $cv_path = $uploaded['file'] ?? '';
    }

    // Lấy thông tin bài đăng công việc và email nhận hồ sơ
    $job_title = $job_id ? get_the_title( $job_id ) : __( 'Việc làm chung', 'jobscout' );
    $company   = $job_id ? get_post_meta( $job_id, '_company_name', true ) : '';
    $target_email = $job_id ? get_post_meta( $job_id, '_application', true ) : '';
    if ( empty( $target_email ) || ! is_email( $target_email ) ) {
        $target_email = get_option( 'admin_email' );
    }

    // Gửi email thông báo cho nhà tuyển dụng
    $subject = sprintf( '[Ứng tuyển mới] %s - %s', $full_name, $job_title );
    $headers = array( 'Content-Type: text/html; charset=UTF-8' );
    if ( is_email( $email ) ) {
        $headers[] = 'Reply-To: ' . $full_name . ' <' . $email . '>';
    }

    $body  = "<h2>Thông tin ứng viên mới nộp hồ sơ:</h2>";
    $body .= "<p><strong>Vị trí ứng tuyển:</strong> " . esc_html( $job_title ) . ( $company ? " (" . esc_html( $company ) . ")" : "" ) . "</p>";
    $body .= "<p><strong>Họ và tên:</strong> " . esc_html( $full_name ) . "</p>";
    $body .= "<p><strong>Email:</strong> " . esc_html( $email ) . "</p>";
    $body .= "<p><strong>Số điện thoại:</strong> " . esc_html( $phone ) . "</p>";
    if ( ! empty( $message ) ) {
        $body .= "<p><strong>Lời nhắn:</strong><br/>" . nl2br( esc_html( $message ) ) . "</p>";
    }
    if ( ! empty( $cv_url ) ) {
        $body .= "<p><strong>File CV đính kèm:</strong> <a href='" . esc_url( $cv_url ) . "' target='_blank'>Xem và tải xuống CV</a></p>";
    }

    $attachments = ( ! empty( $cv_path ) && file_exists( $cv_path ) ) ? array( $cv_path ) : array();

    @wp_mail( $target_email, $subject, $body, $headers, $attachments );

    wp_send_json_success( array(
        'message' => __( 'Chúc mừng! Hồ sơ của bạn đã được gửi thành công đến nhà tuyển dụng.', 'jobscout' ),
        'cv_url'  => $cv_url,
    ) );
}
add_action( 'wp_ajax_submit_job_application', 'jobscout_ajax_submit_job_application' );
add_action( 'wp_ajax_nopriv_submit_job_application', 'jobscout_ajax_submit_job_application' );


