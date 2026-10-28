<?php
/**
 * Widget TOP JOBS cho JobScout
 * Có thể đặt vào bất kỳ sidebar/widget area nào hoặc dùng qua shortcode [jobscout_top_jobs]
 *
 * @package JobScout
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class JobScout_Top_Jobs_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'jobscout_top_jobs_widget',
            __( '[JobScout] Top Jobs Widget', 'jobscout' ),
            array(
                'description' => __( 'Hiển thị danh sách việc làm dạng lưới 2 cột (Top Jobs / Other Jobs) đầy đủ 7 thông tin theo mẫu báo cáo.', 'jobscout' ),
            )
        );
    }

    public function widget( $args, $instance ) {
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : 'TOP JOBS';
        $number_of_jobs = ! empty( $instance['number_of_jobs'] ) ? absint( $instance['number_of_jobs'] ) : 6;
        $show_cta_btn   = isset( $instance['show_cta_btn'] ) ? (bool) $instance['show_cta_btn'] : true;
        $cta_btn_text   = ! empty( $instance['cta_btn_text'] ) ? $instance['cta_btn_text'] : 'VIEW MORE JOBS';
        $jobs_page_url  = home_url( '/jobs/' );

        $today = current_time( 'Y-m-d' );

        // Query jobs: Chỉ lấy công việc đã xuất bản (publish) VÀ còn hạn tuyển dụng
        $query_args = array(
            'post_type'      => 'job_listing',
            'post_status'    => array( 'publish' ),
            'posts_per_page' => $number_of_jobs,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'meta_query'     => array(
                'relation' => 'AND',
                // 1. Phải còn hạn tuyển dụng (chưa hết hạn)
                array(
                    'relation' => 'OR',
                    array(
                        'key'     => '_job_expires',
                        'value'   => $today,
                        'compare' => '>=',
                        'type'    => 'DATE',
                    ),
                    array(
                        'key'     => '_job_expires',
                        'compare' => 'NOT EXISTS',
                    ),
                    array(
                        'key'     => '_job_expires',
                        'value'   => '',
                        'compare' => '=',
                    ),
                ),
                // 2. Chưa bị đánh dấu đã tuyển đủ (_filled != 1)
                array(
                    'relation' => 'OR',
                    array(
                        'key'     => '_filled',
                        'value'   => '1',
                        'compare' => '!=',
                    ),
                    array(
                        'key'     => '_filled',
                        'compare' => 'NOT EXISTS',
                    ),
                ),
            ),
        );

        // Loại trừ bài hiện tại nếu đang xem chi tiết việc làm (dùng cho Other Jobs)
        if ( is_singular( 'job_listing' ) ) {
            $query_args['post__not_in'] = array( get_the_ID() );
        }

        $jobs_query = new WP_Query( $query_args );

        $sample_logos = array(
            'THE SODOH'     => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><circle cx="50" cy="40" r="16" fill="none" stroke="#222" stroke-width="3"/><path d="M50 30 v20 M42 40 h16" stroke="#222" stroke-width="2"/><text x="50" y="78" font-size="12" font-family="serif" font-weight="bold" text-anchor="middle" fill="#111">SODOH</text></svg>',
            'PREMIER HOTEL' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><path d="M20 50 L50 25 L80 50 L75 55 L50 35 L25 55 Z" fill="#222"/><text x="50" y="75" font-size="10" font-family="sans-serif" font-weight="bold" text-anchor="middle" fill="#222">PREMIER</text></svg>',
            'BANQUET'       => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><rect x="30" y="30" width="40" height="40" fill="#111"/><rect x="42" y="42" width="16" height="16" fill="#fafafa"/></svg>',
            'BELLMAN'       => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><path d="M35 60 C35 45 42 35 50 35 C58 35 65 45 65 60 Z" fill="#222"/><rect x="30" y="62" width="40" height="6" rx="2" fill="#222"/><text x="50" y="82" font-size="9" font-family="sans-serif" text-anchor="middle" fill="#444">Toripaitan</text></svg>',
            'PHOTHIN'       => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><circle cx="50" cy="50" r="32" fill="none" stroke="#111" stroke-width="3"/><text x="50" y="48" font-size="14" font-family="sans-serif" font-weight="bold" text-anchor="middle" fill="#111">PHỞ</text><text x="50" y="64" font-size="12" font-family="sans-serif" text-anchor="middle" fill="#111">THÌN</text></svg>',
            'RESORT'        => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><polygon points="50,22 76,70 24,70" fill="none" stroke="#222" stroke-width="3"/><text x="50" y="86" font-size="8" font-family="sans-serif" text-anchor="middle" fill="#333">GROWTH</text></svg>',
        );
        $logo_keys = array_keys( $sample_logos );

        echo $args['before_widget'];
        ?>
        <section class="custom-top-jobs-section">
            <div class="top-jobs-container">
                <?php if ( ! empty( $title ) ) : ?>
                    <h2 class="section-heading-title"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <div class="top-jobs-grid">
                    <?php 
                    if ( $jobs_query->have_posts() ) {
                        $job_index = 0;
                        while ( $jobs_query->have_posts() ) {
                            $jobs_query->the_post();
                            $job_id = get_the_ID();
                            
                            // 5/ Tên công ty
                            $company_name = get_post_meta( $job_id, '_company_name', true );
                            if ( empty( $company_name ) ) {
                                $company_terms = wp_get_post_terms( $job_id, 'companies' );
                                if ( ! empty( $company_terms ) && ! is_wp_error( $company_terms ) ) {
                                    $company_name = $company_terms[0]->name;
                                }
                            }
                            if ( empty( $company_name ) ) {
                                $company_name = 'The Sodoh';
                            }
                            $company_name = wp_specialchars_decode( $company_name, ENT_QUOTES );
                            
                            // 6/ Khu vực tuyển dụng
                            $job_location = get_post_meta( $job_id, '_job_location', true );
                            if ( empty( $job_location ) ) {
                                $job_location = 'Ho Chi Minh City';
                            }

                            // 4/ Loại hình công việc (Full time / Type)
                            $types = wp_get_post_terms( $job_id, 'job_listing_type' );
                            $job_type_label = 'Fulltime';
                            $category_label = 'Category Name';

                            if ( ! empty( $types ) && ! is_wp_error( $types ) ) {
                                foreach ( $types as $t ) {
                                    if ( strtolower( trim( $t->name ) ) === 'full time' || strtolower( trim( $t->name ) ) === 'fulltime' ) {
                                        $job_type_label = 'Fulltime';
                                    } else {
                                        $category_label = wp_specialchars_decode( $t->name, ENT_QUOTES );
                                    }
                                }
                            }

                            // Kiểm tra thêm danh mục taxonomy job_listing_category nếu có
                            $categories = wp_get_post_terms( $job_id, 'job_listing_category' );
                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                $category_label = wp_specialchars_decode( $categories[0]->name, ENT_QUOTES );
                            }

                            // 3/ Ngày tạo công việc
                            $created_date = get_the_date( 'M d, Y' );

                            // 1/ Hình ảnh công ty
                            $logo_url = '';
                            if ( has_post_thumbnail( $job_id ) ) {
                                $thumb_id = get_post_thumbnail_id( $job_id );
                                $logo_src = wp_get_attachment_image_src( $thumb_id, 'thumbnail' );
                                if ( ! empty( $logo_src[0] ) ) {
                                    $logo_url = $logo_src[0];
                                }
                            }
                            if ( empty( $logo_url ) && function_exists( 'get_the_company_logo' ) ) {
                                $logo_url = get_the_company_logo( $job_id );
                            }
                            $fallback_svg = $sample_logos[ $logo_keys[ $job_index % count( $logo_keys ) ] ];
                            $job_index++;

                            // 7/ Mô tả ngắn / quyền lợi công việc (lấy từ post_excerpt hoặc post_content trong database)
                            $raw_excerpt = get_the_excerpt( $job_id );
                            $benefits_lines = array();
                            if ( ! empty( $raw_excerpt ) ) {
                                $lines = preg_split( '/\r\n|\r|\n/', trim( wp_strip_all_tags( $raw_excerpt ) ) );
                                foreach ( $lines as $line ) {
                                    $line = trim( $line, " \t\n\r\0\x0B-•" );
                                    if ( ! empty( $line ) ) {
                                        $benefits_lines[] = $line;
                                    }
                                }
                            }
                            if ( empty( $benefits_lines ) ) {
                                $benefits_lines = array(
                                    'Be responsible for the effective operational management of the hotel',
                                    'Excellent salary, bonuses & recognition activities',
                                    'Foreign language allowance (up to 500USD/month)'
                                );
                            }
                            ?>
                            <div class="job-card-item">
                                <div class="job-card-header">
                                    <div class="company-logo-box">
                                        <?php if ( $logo_url ) : ?>
                                            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $company_name ); ?>" class="company-logo-img">
                                        <?php else : ?>
                                            <div class="company-logo-placeholder">
                                                <?php echo $fallback_svg; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="job-info-meta">
                                        <!-- 2/ Tiêu đề công việc -->
                                        <h3 class="job-card-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <!-- 3/ Ngày tạo -->
                                        <div class="job-created-date">Created: <?php echo esc_html( $created_date ); ?></div>
                                        <!-- 4. Danh mục / 5. Tên công ty / 6. Khu vực -->
                                        <div class="job-badges-list">
                                            <span class="job-badge badge-cat"><?php echo esc_html( $category_label ); ?></span>
                                            <span class="job-badge badge-company"><?php echo esc_html( $company_name ); ?></span>
                                            <span class="job-badge badge-loc"><?php echo esc_html( $job_location ); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 7/ Mô tả ngắn / quyền lợi công việc -->
                                <div class="job-card-body">
                                    <ul class="job-benefits-list">
                                        <?php foreach ( $benefits_lines as $b_line ) : ?>
                                            <li><?php echo esc_html( $b_line ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    } else {
                        ?>
                        <div class="no-jobs-notification" style="grid-column: 1 / -1; text-align: center; padding: 45px 20px; background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 8px; margin: 15px 0 25px 0;">
                            <p style="font-size: 16px; color: #475569; margin: 0 0 8px 0; font-weight: 600;">
                                Hiện tại các công việc đã hết hạn nên sẽ không được hiển thị.
                            </p>
                            <p style="font-size: 14px; color: #94a3b8; margin: 0;">
                                Phải thêm công việc mới và còn hạn tuyển dụng thì mới hiển thị ra được.
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php if ( $show_cta_btn && $jobs_query->have_posts() ) : ?>
                    <div class="top-jobs-cta">
                        <a href="<?php echo esc_url( $jobs_page_url ); ?>" class="btn-view-more-jobs"><?php echo esc_html( $cta_btn_text ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : 'TOP JOBS';
        $number_of_jobs = ! empty( $instance['number_of_jobs'] ) ? absint( $instance['number_of_jobs'] ) : 6;
        $show_cta_btn   = isset( $instance['show_cta_btn'] ) ? (bool) $instance['show_cta_btn'] : true;
        $cta_btn_text   = ! empty( $instance['cta_btn_text'] ) ? $instance['cta_btn_text'] : 'VIEW MORE JOBS';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Tiêu đề khối:', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number_of_jobs' ) ); ?>"><?php esc_html_e( 'Số lượng công việc hiển thị:', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_jobs' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_jobs' ) ); ?>" type="number" min="1" max="24" value="<?php echo esc_attr( $number_of_jobs ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_cta_btn ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cta_btn' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cta_btn' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_cta_btn' ) ); ?>"><?php esc_html_e( 'Hiển thị nút xem thêm (VIEW MORE JOBS)', 'jobscout' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cta_btn_text' ) ); ?>"><?php esc_html_e( 'Chữ nút xem thêm:', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_btn_text' ) ); ?>" type="text" value="<?php echo esc_attr( $cta_btn_text ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number_of_jobs'] = ( ! empty( $new_instance['number_of_jobs'] ) ) ? absint( $new_instance['number_of_jobs'] ) : 6;
        $instance['show_cta_btn']   = isset( $new_instance['show_cta_btn'] ) ? (bool) $new_instance['show_cta_btn'] : false;
        $instance['cta_btn_text']   = ( ! empty( $new_instance['cta_btn_text'] ) ) ? sanitize_text_field( $new_instance['cta_btn_text'] ) : '';
        return $instance;
    }
}

/**
 * Đăng ký riêng widget Top Jobs
 */
function jobscout_register_top_jobs_widget() {
    register_widget( 'JobScout_Top_Jobs_Widget' );
}
add_action( 'widgets_init', 'jobscout_register_top_jobs_widget' );

/**
 * Shortcode [jobscout_top_jobs title="TOP JOBS" number="6" button="1" button_text="VIEW MORE JOBS"]
 */
function jobscout_top_jobs_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title'       => 'TOP JOBS',
        'number'      => 6,
        'button'      => '1',
        'button_text' => 'VIEW MORE JOBS',
    ), $atts, 'jobscout_top_jobs' );

    ob_start();
    the_widget( 'JobScout_Top_Jobs_Widget', array(
        'title'          => $atts['title'],
        'number_of_jobs' => absint( $atts['number'] ),
        'show_cta_btn'   => ( '1' === (string)$atts['button'] || 'true' === (string)$atts['button'] ),
        'cta_btn_text'   => $atts['button_text'],
    ) );
    return ob_get_clean();
}
add_shortcode( 'jobscout_top_jobs', 'jobscout_top_jobs_shortcode' );
