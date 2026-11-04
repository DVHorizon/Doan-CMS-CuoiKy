<?php
/**
 * Blog Section - NEWEST BLOG ENTRIES
 * Đọc trực tiếp từ Theme Customizer
 * 
 * @package JobScout
 */

$ed_blog = get_theme_mod( 'ed_blog_section', true );
if ( ! $ed_blog ) {
    return;
}

$blog_title   = get_theme_mod( 'blog_section_title', __( 'NEWEST BLOG ENTRIES', 'jobscout' ) );
$number_posts = get_theme_mod( 'blog_section_number_posts', 4 );

$posts_query = new WP_Query( array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => absint( $number_posts ),
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

$sample_thumbs = array(
    get_template_directory_uri() . '/images/blog_1.jpg',
    get_template_directory_uri() . '/images/home-career-sakura.jpg',
    get_template_directory_uri() . '/images/home-banner-pagoda.jpg',
);
?>

<section class="custom-blog-section">
    <div class="blog-section-container">
        <?php if ( ! empty( $blog_title ) ) : ?>
            <h2 class="section-heading-title"><?php echo esc_html( $blog_title ); ?></h2>
        <?php endif; ?>

        <div class="blog-entries-grid">
            <?php 
            if ( $posts_query->have_posts() ) {
                $idx = 0;
                while ( $posts_query->have_posts() ) {
                    $posts_query->the_post();
                    $post_id   = get_the_ID();
                    $thumb_url = get_the_post_thumbnail_url( $post_id, 'medium' );
                    if ( empty( $thumb_url ) ) {
                        $thumb_url = $sample_thumbs[ $idx % count( $sample_thumbs ) ];
                    }
                    $idx++;
                    ?>
                    <div class="blog-card-item">
                        <div class="blog-card-thumb-wrap">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card-thumb">
                            </a>
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="blog-card-excerpt">
                                <?php echo wp_trim_words( get_the_excerpt(), 14, '...' ); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="blog-read-more-link">Read More</a>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                // Dữ liệu mẫu minh họa nếu chưa có bài viết
                for ( $i = 0; $i < $number_posts; $i++ ) {
                    $sample_titles = array(
                        'Mercedes C300 AMG 2024',
                        'Restaurant & Hotel Management And Operations',
                        'Hospitality Consulting',
                        'Venue And Interior Design',
                    );
                    $title_text = $sample_titles[ $i % count( $sample_titles ) ];
                    $thumb_url  = $sample_thumbs[ $i % count( $sample_thumbs ) ];
                    ?>
                    <div class="blog-card-item">
                        <div class="blog-card-thumb-wrap">
                            <a href="#">
                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title_text ); ?>" class="blog-card-thumb">
                            </a>
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title">
                                <a href="#"><?php echo esc_html( $title_text ); ?></a>
                            </h3>
                            <p class="blog-card-excerpt">
                                <?php echo esc_html( 'Khám phá những chiến lược và kinh nghiệm hữu ích trong ngành quản trị khách sạn và phát triển sự nghiệp...' ); ?>
                            </p>
                            <a href="#" class="blog-read-more-link">Read More</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
