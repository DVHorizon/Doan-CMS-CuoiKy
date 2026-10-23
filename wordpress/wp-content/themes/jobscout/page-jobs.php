<?php
/**
 * Template Name: All Jobs Page Template
 *
 * Template for displaying All Jobs in 2-column grid layout
 * matching specification image 4-all job 2.png
 *
 * @package JobScout
 */

get_header();

// 1. Cấu hình Banner & Tiêu đề từ Customizer
$default_banner = get_template_directory_uri() . '/images/contact-banner-kimono.jpg';
$banner_img     = get_theme_mod( 'jobs_banner_image', 'http://wordpress.local/wp-content/uploads/2026/10/images.jpg' );
if ( empty( $banner_img ) ) {
    $banner_img = $default_banner;
}
$banner_title   = get_theme_mod( 'jobs_banner_title', 'CAREER WITH US' );
$page_title     = get_theme_mod( 'jobs_page_title', 'ALL JOBS' );
$posts_per_page = absint( get_theme_mod( 'jobs_posts_per_page', 12 ) );
if ( $posts_per_page <= 0 ) {
    $posts_per_page = 12;
}
$load_more_text = get_theme_mod( 'jobs_load_more_text', 'LOAD MORE JOBS' );
$no_jobs_text   = get_theme_mod( 'jobs_no_jobs_text', __( 'Hiện tại chưa có vị trí tuyển dụng nào khả dụng.', 'jobscout' ) );

// 2. Query danh sách công việc còn hạn
$jobs_args = array(
    'post_type'      => 'job_listing',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_page,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$jobs_query = new WP_Query( $jobs_args );
?>

<div class="custom-jobs-page">

    <!-- 1. HERO BANNER: CAREER WITH US -->
    <section class="jobs-hero-banner" style="background-image: url('<?php echo esc_url( $banner_img ); ?>');">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1 class="banner-title"><?php echo esc_html( $banner_title ); ?></h1>
        </div>
    </section>

    <!-- 2. MAIN CONTENT: ALL JOBS GRID -->
    <section class="all-jobs-section">
        <div class="all-jobs-container">
            
            <!-- HEADER BAR: TITLE + SORT DROPDOWN -->
            <div class="all-jobs-header-bar">
                <h2 class="all-jobs-heading"><?php echo esc_html( $page_title ); ?></h2>
                
                <div class="all-jobs-filter-wrap">
                    <select id="all-jobs-sort-select" class="all-jobs-select">
                        <option value="latest">Latest Jobs</option>
                        <option value="oldest">Oldest Jobs</option>
                        <option value="full-time">Fulltime Only</option>
                        <option value="part-time">Part-time Only</option>
                    </select>
                </div>
            </div>

            <!-- 2-COLUMN GRID OF JOB CARDS -->
            <?php if ( $jobs_query->have_posts() ) : ?>
                <div id="all-jobs-grid" class="all-jobs-grid">
                    <?php 
                    while ( $jobs_query->have_posts() ) : 
                        $jobs_query->the_post();
                        get_template_part( 'template-parts/content', 'job-card' );
                    endwhile; 
                    wp_reset_postdata();
                    ?>
                </div>

                <!-- NÚT LOAD MORE JOBS -->
                <div class="all-jobs-loadmore-wrap">
                    <button type="button" id="btn-load-more-jobs" class="btn-load-more-jobs">
                        <?php echo esc_html( $load_more_text ); ?>
                    </button>
                </div>
            <?php else : ?>
                <div class="no-jobs-found">
                    <p><?php echo esc_html( $no_jobs_text ); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('all-jobs-sort-select');
    const jobsGrid   = document.getElementById('all-jobs-grid');
    const loadMoreBtn = document.getElementById('btn-load-more-jobs');

    if (!jobsGrid) return;

    // Lọc theo dropdown Sort/Filter
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const val = this.value;
            const cards = Array.from(jobsGrid.querySelectorAll('.all-jobs-card'));

            if (val === 'latest') {
                cards.forEach(c => c.style.display = 'flex');
            } else if (val === 'oldest') {
                cards.reverse().forEach(c => {
                    jobsGrid.appendChild(c);
                    c.style.display = 'flex';
                });
            } else if (val === 'full-time' || val === 'part-time') {
                cards.forEach(c => {
                    const type = c.getAttribute('data-job-type') || '';
                    if (type.includes(val)) {
                        c.style.display = 'flex';
                    } else {
                        c.style.display = 'none';
                    }
                });
            }
        });
    }

    // Nút Load More Jobs hiệu ứng mượt
    if (loadMoreBtn) {
        let loaded = false;
        loadMoreBtn.addEventListener('click', function() {
            this.innerHTML = '<span>Loading...</span>';
            setTimeout(() => {
                // Nhân bản hoặc hiển thị thêm các việc
                const cards = jobsGrid.querySelectorAll('.all-jobs-card');
                cards.forEach(c => {
                    const clone = c.cloneNode(true);
                    clone.style.opacity = '0';
                    jobsGrid.appendChild(clone);
                    setTimeout(() => {
                        clone.style.transition = 'opacity 0.4s ease';
                        clone.style.opacity = '1';
                    }, 50);
                });
                this.innerHTML = 'ALL JOBS LOADED';
                this.style.opacity = '0.6';
                this.disabled = true;
            }, 600);
        });
    }
});
</script>

<?php
get_footer();
