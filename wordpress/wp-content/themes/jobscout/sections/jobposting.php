<?php
/**
 * Job Posting Section - TOP JOBS
 * Đọc trực tiếp từ Theme Customizer
 * 
 * @package JobScout
 */

$ed_jobposting = get_theme_mod( 'ed_jobposting_section', true );
if ( ! $ed_jobposting ) {
    return;
}

$title          = get_theme_mod( 'job_posting_section_title', __( 'TOP JOBS', 'jobscout' ) );
$number_of_jobs = get_theme_mod( 'job_posting_number_of_jobs', 6 );
$cta_btn_text   = get_theme_mod( 'job_posting_cta_btn_text', __( 'VIEW MORE JOBS', 'jobscout' ) );
$jobs_page_url  = home_url( '/jobs/' );

$today = current_time( 'Y-m-d' );

// Query jobs: Chỉ lấy công việc đã xuất bản (publish) VÀ còn hạn tuyển dụng
$query_args = array(
    'post_type'      => 'job_listing',
    'post_status'    => array( 'publish' ),
    'posts_per_page' => absint( $number_of_jobs ),
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
                    
                    // Tên công ty
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
                    
                    // Khu vực tuyển dụng
                    $job_location = get_post_meta( $job_id, '_job_location', true );
                    if ( empty( $job_location ) ) {
                        $job_location = 'Ho Chi Minh City';
                    }

                    // Loại hình công việc & Danh mục
                    $types = wp_get_post_terms( $job_id, 'job_listing_type' );
                    $category_label = 'Category Name';

                    if ( ! empty( $types ) && ! is_wp_error( $types ) ) {
                        foreach ( $types as $t ) {
                            if ( strtolower( trim( $t->name ) ) !== 'full time' && strtolower( trim( $t->name ) ) !== 'fulltime' ) {
                                $category_label = wp_specialchars_decode( $t->name, ENT_QUOTES );
                            }
                        }
                    }

                    $categories = wp_get_post_terms( $job_id, 'job_listing_category' );
                    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                        $category_label = wp_specialchars_decode( $categories[0]->name, ENT_QUOTES );
                    }

                    // Ngày tạo công việc
                    $created_date = get_the_date( 'M d, Y' );

                    // Logo công ty
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

                    // Mô tả ngắn / quyền lợi công việc
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
                                <h3 class="job-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="job-created-date">Created: <?php echo esc_html( $created_date ); ?></div>
                                <div class="job-badges-list">
                                    <span class="job-badge badge-cat"><?php echo esc_html( $category_label ); ?></span>
                                    <span class="job-badge badge-company"><?php echo esc_html( $company_name ); ?></span>
                                    <span class="job-badge badge-loc"><?php echo esc_html( $job_location ); ?></span>
                                </div>
                            </div>
                        </div>

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

        <?php if ( $jobs_query->have_posts() ) : ?>
            <div class="top-jobs-cta">
                <a href="<?php echo esc_url( $jobs_page_url ); ?>" class="btn-view-more-jobs"><?php echo esc_html( $cta_btn_text ); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>
