<?php
/**
 * Widget NEWEST BLOG ENTRIES cho JobScout
 * Có thể đặt vào bất kỳ sidebar/widget area nào hoặc dùng qua shortcode [jobscout_newest_blog]
 *
 * @package JobScout
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class JobScout_Newest_Blog_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'jobscout_newest_blog_widget',
            __( '[JobScout] Newest Blog Entries Widget', 'jobscout' ),
            array(
                'description' => __( 'Hiển thị danh sách tin tức/blog dạng lưới 2 cột (Newest Blog Entries) gồm ảnh, tiêu đề, đoạn trích và liên kết Read More.', 'jobscout' ),
            )
        );
    }

    public function widget( $args, $instance ) {
        $title        = ! empty( $instance['title'] ) ? $instance['title'] : 'NEWEST BLOG ENTRIES';
        $number_posts = ! empty( $instance['number_posts'] ) ? absint( $instance['number_posts'] ) : 4;

        $posts_query = new WP_Query( array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $number_posts,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        $sample_thumbs = array(
            get_template_directory_uri() . '/images/blog_1.jpg',
            get_template_directory_uri() . '/images/home-career-sakura.jpg',
            get_template_directory_uri() . '/images/home-banner-pagoda.jpg',
        );

        echo $args['before_widget'];
        ?>
        <section class="custom-blog-section">
            <div class="blog-section-container">
                <?php if ( ! empty( $title ) ) : ?>
                    <h2 class="section-heading-title"><?php echo esc_html( $title ); ?></h2>
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
                                'Venue And Interior Design'
                            );
                            $card_title = isset( $sample_titles[$i] ) ? $sample_titles[$i] : 'Project Development';
                            $thumb_url  = $sample_thumbs[ $i % count( $sample_thumbs ) ];
                            ?>
                            <div class="blog-card-item">
                                <div class="blog-card-thumb-wrap">
                                    <a href="#">
                                        <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $card_title ); ?>" class="blog-card-thumb">
                                    </a>
                                </div>
                                <div class="blog-card-content">
                                    <h3 class="blog-card-title">
                                        <a href="#"><?php echo esc_html( $card_title ); ?></a>
                                    </h3>
                                    <p class="blog-card-excerpt">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title        = ! empty( $instance['title'] ) ? $instance['title'] : 'NEWEST BLOG ENTRIES';
        $number_posts = ! empty( $instance['number_posts'] ) ? absint( $instance['number_posts'] ) : 4;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Tiêu đề khối:', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>"><?php esc_html_e( 'Số lượng bài viết hiển thị:', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_posts' ) ); ?>" type="number" min="1" max="16" value="<?php echo esc_attr( $number_posts ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']        = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number_posts'] = ( ! empty( $new_instance['number_posts'] ) ) ? absint( $new_instance['number_posts'] ) : 4;
        return $instance;
    }
}

/**
 * Đăng ký riêng widget Newest Blog
 */
function jobscout_register_newest_blog_widget() {
    register_widget( 'JobScout_Newest_Blog_Widget' );
}
add_action( 'widgets_init', 'jobscout_register_newest_blog_widget' );

/**
 * Shortcode [jobscout_newest_blog title="NEWEST BLOG ENTRIES" number="4"]
 */
function jobscout_newest_blog_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title'  => 'NEWEST BLOG ENTRIES',
        'number' => 4,
    ), $atts, 'jobscout_newest_blog' );

    ob_start();
    the_widget( 'JobScout_Newest_Blog_Widget', array(
        'title'        => $atts['title'],
        'number_posts' => absint( $atts['number'] ),
    ) );
    return ob_get_clean();
}
add_shortcode( 'jobscout_newest_blog', 'jobscout_newest_blog_shortcode' );
