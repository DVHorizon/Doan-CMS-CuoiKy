<?php
/**
 * The template for displaying all single posts (News Detail)
 *
 * @package JobScout
 */

get_header();

while (have_posts()):
    the_post();
    $current_id = get_the_ID();
    $categories = get_the_category();
    $tags = get_the_tags();
    $blog_page_id = get_option('page_for_posts');
    $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
    $post_date = get_the_date('M d, Y');
    ?>

    <div class="custom-news-detail-page">
        <div class="detail-container">

            <!-- 1. BREADCRUMB -->
            <nav class="news-detail-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="sep">/</span>
                <a href="<?php echo esc_url($blog_url); ?>">All News</a>
                <span class="sep">/</span>
                <span class="current">News Detail</span>
            </nav>

            <!-- 2. POST HEADER CARD -->
            <div class="news-detail-header-card">
                <div class="header-card-left">
                    <div class="detail-thumb">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                        <?php else: ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/banner-image.jpg'); ?>"
                                alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="detail-info">
                        <h1 class="detail-title"><?php the_title(); ?></h1>

                        <div class="detail-meta">
                            <span class="detail-date">Posted: <?php echo esc_html($post_date); ?></span>
                        </div>

                        <div class="detail-badges">
                            <?php if (!empty($categories)): ?>
                                <?php foreach (array_slice($categories, 0, 2) as $cat): ?>
                                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                        class="badge-item"><?php echo esc_html($cat->name); ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (!empty($tags)): ?>
                                <?php foreach (array_slice($tags, 0, 2) as $tag): ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                        class="badge-item"><?php echo esc_html($tag->name); ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="header-card-right">
                    <button type="button" class="btn-share" onclick="handleSharePost()">SHARE</button>
                </div>
            </div>

            <!-- 3. MAIN ARTICLE CONTENT -->
            <article class="news-detail-content-card">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

        </div><!-- .detail-container -->

        <!-- 4. NEWEST BLOG ENTRIES (LƯỚI BÀI VIẾT MỚI NHẤT) -->
        <section class="news-detail-related-section">
            <div class="detail-container">
                <h2 class="news-section-title">NEWEST BLOG ENTRIES</h2>

                <div class="news-grid-2col">
                    <?php
                    $related_query = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 6, // 6 bài = 3 hàng x 2 cột như trong ảnh mẫu
                        'post__not_in' => array($current_id),
                        'ignore_sticky_posts' => true,
                    ));

                    if ($related_query->have_posts()):
                        while ($related_query->have_posts()):
                            $related_query->the_post();
                            get_template_part('template-parts/content', 'news-card');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>
    </div>

    <script>
        function handleSharePost() {
            if (navigator.share) {
                navigator.share({
                    title: <?php echo json_encode(get_the_title()); ?>,
                    url: window.location.href
                }).catch(function (err) {
                    console.log(err);
                });
            } else {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(window.location.href).then(function () {
                        alert('Đã sao chép liên kết bài viết vào bộ nhớ tạm!');
                    }).catch(function () {
                        prompt('Sao chép liên kết bài viết:', window.location.href);
                    });
                } else {
                    prompt('Sao chép liên kết bài viết:', window.location.href);
                }
            }
        }
    </script>

    <?php
endwhile;

get_footer();
