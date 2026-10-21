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
