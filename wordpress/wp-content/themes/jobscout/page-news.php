<?php
/**
 * Template Name: News Page Template
 *
 * @package JobScout
 */

get_header();

// 1. Cấu hình Banner
$banner_img = get_theme_mod('news_banner_image', get_template_directory_uri() . '/images/banner-image.jpg');
$banner_title = get_theme_mod('news_banner_title', 'PDS NEWS');
$section_title = get_theme_mod('news_section_title', 'NEWEST BLOG ENTRIES');
$posts_per_page = get_theme_mod('news_posts_per_page', 8);
$newsletter_title = get_theme_mod('news_newsletter_title', 'Subscribe To Our Newsletter');
$newsletter_btn = get_theme_mod('news_newsletter_btn', 'SUBSCRIBE');

// 2. Query danh sách bài viết có phân trang
if (is_home()) {
    global $wp_query;
    $news_query = $wp_query;
    $paged = max(1, get_query_var('paged'));
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
    $news_query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    ));
}
?>

<div class="custom-news-page">

    <!-- 1. HERO BANNER TRÊN CÙNG -->
    <section class="news-hero-banner" style="background-image: url('<?php echo esc_url($banner_img); ?>');">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1 class="banner-title"><?php echo esc_html($banner_title); ?></h1>
        </div>
    </section>

    <!-- 2. DANH SÁCH BÀI VIẾT DẠNG LƯỚI -->
    <section class="news-main-section">
        <div class="news-container">
            <h2 class="news-section-title"><?php echo esc_html($section_title); ?></h2>

            <?php if ($news_query->have_posts()): ?>
                <div class="news-grid-2col">
                    <?php while ($news_query->have_posts()):
                        $news_query->the_post();
                        get_template_part('template-parts/content', 'news-card');
                    endwhile; ?>
                </div>

                <!-- Phân trang -->
                <?php if ($news_query->max_num_pages > 1): ?>
                    <div class="news-pagination">
                        <?php
                        $big = 999999999;
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => $paged,
                            'total' => $news_query->max_num_pages,
                            'prev_text' => '‹ Previous',
                            'next_text' => 'Next ›',
                            'type' => 'plain',
                        ));
                        ?>
                    </div>
                <?php endif; ?>
                <?php
                if (!is_home()) {
                    wp_reset_postdata();
                }
                ?>

            <?php else: ?>
                <p class="no-posts-text">Chưa có bài viết nào được đăng.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
get_footer();
