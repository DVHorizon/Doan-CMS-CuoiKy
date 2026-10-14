<?php
/**
 * Blog Section - NEWEST BLOG ENTRIES
 * 
 * @package JobScout
 */

$news_page_url = home_url( '/news/' );

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 4,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true
);

$blog_query = new WP_Query( $args );

// Fallback sample cards if needed
$sample_posts = array(
    array(
        'title'   => 'Project Development',
        'desc'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'img'     => get_template_directory_uri() . '/images/blog_1.jpg',
    ),
    array(
        'title'   => 'Restaurant & Hotel Management And Operations',
        'desc'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'img'     => get_template_directory_uri() . '/images/1c.jpg',
    ),
    array(
        'title'   => 'Hospitality Consulting',
        'desc'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'img'     => get_template_directory_uri() . '/images/2cl.jpg',
    ),
    array(
        'title'   => 'Venue And Interior Design',
        'desc'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'img'     => get_template_directory_uri() . '/images/2cr.jpg',
    ),
);
?>

<section id="newest-blog-section" class="custom-blog-section">
    <div class="blog-section-container">
        <h2 class="section-heading-title">NEWEST BLOG ENTRIES</h2>

        <div class="blog-entries-grid">
            <?php 
            if ( $blog_query->have_posts() ) {
                $idx = 0;
                while ( $blog_query->have_posts() ) {
                    $blog_query->the_post();
                    $post_id = get_the_ID();
                    $thumb_url = '';
                    
                    if ( has_post_thumbnail( $post_id ) ) {
                        $thumb_url = get_the_post_thumbnail_url( $post_id, 'medium' );
                    }
                    if ( empty( $thumb_url ) ) {
                        $thumb_url = $sample_posts[ $idx % 4 ]['img'];
                    }
                    
                    $excerpt = get_the_excerpt();
                    if ( empty( $excerpt ) ) {
                        $excerpt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
                    } else {
                        $excerpt = wp_trim_words( $excerpt, 18, '...' );
                    }
                    ?>
                    <article class="blog-card-item">
                        <div class="blog-card-thumb-wrap">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card-thumb">
                            </a>
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="blog-card-excerpt"><?php echo esc_html( $excerpt ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="blog-read-more-link">Read More</a>
                        </div>
                    </article>
                    <?php
                    $idx++;
                }
                wp_reset_postdata();
            } else {
                foreach ( $sample_posts as $sp ) {
                    ?>
                    <article class="blog-card-item">
                        <div class="blog-card-thumb-wrap">
                            <a href="<?php echo esc_url( $news_page_url ); ?>">
                                <img src="<?php echo esc_url( $sp['img'] ); ?>" alt="<?php echo esc_attr( $sp['title'] ); ?>" class="blog-card-thumb">
                            </a>
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title">
                                <a href="<?php echo esc_url( $news_page_url ); ?>"><?php echo esc_html( $sp['title'] ); ?></a>
                            </h3>
                            <p class="blog-card-excerpt"><?php echo esc_html( $sp['desc'] ); ?></p>
                            <a href="<?php echo esc_url( $news_page_url ); ?>" class="blog-read-more-link">Read More</a>
                        </div>
                    </article>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>