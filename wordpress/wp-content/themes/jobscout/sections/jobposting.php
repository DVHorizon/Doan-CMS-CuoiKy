<?php
/**
 * Job Posting Section - TOP JOBS
 * 
 * @package JobScout
 */

$jobs_page_url = home_url( '/jobs/' );

// Query 6 jobs for the Top Jobs grid
$args = array(
    'post_type'           => 'job_listing',
    'post_status'         => array( 'publish' ),
    'posts_per_page'      => 6,
    'orderby'             => 'date',
    'order'               => 'DESC',
);

$top_jobs_query = new WP_Query( $args );

// Fallback sample jobs if database has fewer than 6
$sample_logos = array(
    'THE SODOH' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><circle cx="50" cy="40" r="16" fill="none" stroke="#222" stroke-width="3"/><path d="M50 30 v20 M42 40 h16" stroke="#222" stroke-width="2"/><text x="50" y="78" font-size="12" font-family="serif" font-weight="bold" text-anchor="middle" fill="#111">SODOH</text></svg>',
    'PREMIER HOTEL' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><path d="M20 50 L50 25 L80 50 L75 55 L50 35 L25 55 Z" fill="#222"/><text x="50" y="75" font-size="10" font-family="sans-serif" font-weight="bold" text-anchor="middle" fill="#222">PREMIER</text></svg>',
    'BANQUET' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><rect x="30" y="30" width="40" height="40" fill="#111"/><rect x="42" y="42" width="16" height="16" fill="#fafafa"/></svg>',
    'BELLMAN' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><path d="M35 60 C35 45 42 35 50 35 C58 35 65 45 65 60 Z" fill="#222"/><rect x="30" y="62" width="40" height="6" rx="2" fill="#222"/><text x="50" y="82" font-size="9" font-family="sans-serif" text-anchor="middle" fill="#444">Toripaitan</text></svg>',
    'PHOTHIN' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><circle cx="50" cy="50" r="32" fill="none" stroke="#111" stroke-width="3"/><text x="50" y="48" font-size="14" font-family="sans-serif" font-weight="bold" text-anchor="middle" fill="#111">PHỞ</text><text x="50" y="64" font-size="12" font-family="sans-serif" text-anchor="middle" fill="#111">THÌN</text></svg>',
    'RESORT' => '<svg width="50" height="50" viewBox="0 0 100 100"><rect width="100" height="100" fill="#fafafa"/><polygon points="50,22 76,70 24,70" fill="none" stroke="#222" stroke-width="3"/><text x="50" y="86" font-size="8" font-family="sans-serif" text-anchor="middle" fill="#333">GROWTH</text></svg>',
);
$logo_keys = array_keys( $sample_logos );
?>

<section id="top-jobs-section" class="custom-top-jobs-section">
    <div class="top-jobs-container">
        <h2 class="section-heading-title">TOP JOBS</h2>

        <div class="top-jobs-grid">
            <?php 
            if ( $top_jobs_query->have_posts() ) {
                $job_index = 0;
                while ( $top_jobs_query->have_posts() ) {
                    $top_jobs_query->the_post();
                    $job_id = get_the_ID();
                    
                    // Meta data
                    $company_name = get_post_meta( $job_id, '_company_name', true );
                    if ( empty( $company_name ) ) {
                        $company_name = 'Plan Do See Global';
                    }
                    
                    $job_location = get_post_meta( $job_id, '_job_location', true );
                    if ( empty( $job_location ) ) {
                        $job_location = 'Ho Chi Minh City';
                    }

                    // Job Type
                    $types = wp_get_post_terms( $job_id, 'job_listing_type' );
                    $job_type_label = ( ! empty( $types ) && ! is_wp_error( $types ) ) ? $types[0]->name : 'Full time';

                    // Category
                    $categories = wp_get_post_terms( $job_id, 'job_listing_category' );
                    $category_label = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0]->name : 'Category Name';

                    // Created date
                    $created_date = get_the_date( 'M d, Y' );

                    // Logo
                    $logo_url = get_the_company_logo( $job_id );
                    $fallback_svg = $sample_logos[ $logo_keys[ $job_index % count( $logo_keys ) ] ];
                    $job_index++;
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
                                    <span class="job-badge badge-type"><?php echo esc_html( $job_type_label ); ?></span>
                                    <span class="job-badge badge-cat"><?php echo esc_html( $category_label ); ?></span>
                                    <span class="job-badge badge-loc"><?php echo esc_html( $job_location ); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="job-card-body">
                            <ul class="job-benefits-list">
                                <li>Be responsible for the effective operational management of the hotel</li>
                                <li>Excellent salary, bonuses & recognition activities</li>
                                <li>Foreign language allowance (up to 500USD/month)</li>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                // If no jobs found in database, render sample cards according to design
                for ( $i = 0; $i < 6; $i++ ) {
                    $titles = array(
                        'HOTEL MANAGER',
                        'GENERAL MANAGER - LEADING HOTEL CHAIN',
                        'BANQUET MANAGER',
                        'BELLMAN',
                        'CHIEF OPERATING OFFICER HOTEL / RESORT CHAIN',
                        'LOSS PREVENTION OFFICER'
                    );
                    $title = $titles[$i];
                    $fallback_svg = $sample_logos[ $logo_keys[ $i % count( $logo_keys ) ] ];
                    ?>
                    <div class="job-card-item">
                        <div class="job-card-header">
                            <div class="company-logo-box">
                                <div class="company-logo-placeholder">
                                    <?php echo $fallback_svg; ?>
                                </div>
                            </div>

                            <div class="job-info-meta">
                                <h3 class="job-card-title">
                                    <a href="<?php echo esc_url( $jobs_page_url ); ?>"><?php echo esc_html( $title ); ?></a>
                                </h3>
                                <div class="job-created-date">Created: Oct 20, 2022</div>
                                <div class="job-badges-list">
                                    <span class="job-badge badge-type">Full time</span>
                                    <span class="job-badge badge-cat">Category Name</span>
                                    <span class="job-badge badge-loc">Ho Chi Minh City</span>
                                </div>
                            </div>
                        </div>

                        <div class="job-card-body">
                            <ul class="job-benefits-list">
                                <li>Be responsible for the effective operational management of the hotel</li>
                                <li>Excellent salary, bonuses & recognition activities</li>
                                <li>Foreign language allowance (up to 500USD/month)</li>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="top-jobs-cta">
            <a href="<?php echo esc_url( $jobs_page_url ); ?>" class="btn-view-more-jobs">VIEW MORE JOBS</a>
        </div>
    </div>
</section>