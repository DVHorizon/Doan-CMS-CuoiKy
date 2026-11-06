<?php
/**
 * Jobs Page - All Jobs Grid & Filter Section
 *
 * @package JobScout
 */

$page_title     = get_theme_mod( 'jobs_page_title', 'ALL JOBS' );
$posts_per_page = absint( get_theme_mod( 'jobs_posts_per_page', 12 ) );
if ( $posts_per_page <= 0 ) {
    $posts_per_page = 12;
}
$load_more_text = get_theme_mod( 'jobs_load_more_text', 'LOAD MORE JOBS' );
$no_jobs_text   = get_theme_mod( 'jobs_no_jobs_text', __( 'Hiện tại chưa có vị trí tuyển dụng nào khả dụng.', 'jobscout' ) );

// Nhận tham số tìm kiếm từ Banner trang chủ (GET)
$search_keywords = isset( $_GET['search_keywords'] ) ? sanitize_text_field( wp_unslash( $_GET['search_keywords'] ) ) : '';
$search_location = isset( $_GET['search_location'] ) ? trim( sanitize_text_field( wp_unslash( $_GET['search_location'] ) ), " .\t\n\r\0\x0B" ) : '';

// Query danh sách công việc còn hạn
$jobs_args = array(
    'post_type'      => 'job_listing',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_page,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if ( ! empty( $search_keywords ) ) {
    $jobs_args['s'] = $search_keywords;
}

if ( ! empty( $search_location ) ) {
    $jobs_args['meta_query'] = array(
        array(
            'key'     => '_job_location',
            'value'   => $search_location,
            'compare' => 'LIKE',
        ),
    );
}

$jobs_query = new WP_Query( $jobs_args );
?>

<!-- 2. MAIN CONTENT: ALL JOBS GRID -->
<section class="all-jobs-section">
    <div class="all-jobs-container">
        
        <!-- HEADER BAR: TITLE + SORT DROPDOWN -->
        <div class="all-jobs-header-bar">
            <div>
                <h2 class="all-jobs-heading"><?php echo esc_html( $page_title ); ?></h2>
                <?php if ( ! empty( $search_keywords ) || ! empty( $search_location ) ) : ?>
                    <div class="search-filter-active-bar" style="margin-top: 6px; font-size: 14px; color: #64748b; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <span>Kết quả tìm kiếm:</span>
                        <?php if ( ! empty( $search_keywords ) ) : ?>
                            <span style="background: #e2e8f0; color: #1e293b; padding: 2px 10px; border-radius: 999px; font-weight: 500;">Từ khóa: "<?php echo esc_html( $search_keywords ); ?>"</span>
                        <?php endif; ?>
                        <?php if ( ! empty( $search_location ) ) : ?>
                            <span style="background: #e2e8f0; color: #1e293b; padding: 2px 10px; border-radius: 999px; font-weight: 500;">Khu vực: "<?php echo esc_html( $search_location ); ?>"</span>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( home_url( '/jobs/' ) ); ?>" style="color: #ea6a1b; text-decoration: underline; font-size: 13px; margin-left: 4px;">✕ Xóa bộ lọc</a>
                    </div>
                <?php endif; ?>
            </div>
            
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
            <?php if ( $jobs_query->max_num_pages > 1 ) : ?>
                <div class="all-jobs-loadmore-wrap">
                    <button type="button" id="btn-load-more-jobs" class="btn-load-more-jobs" 
                            data-page="1" 
                            data-max-pages="<?php echo esc_attr( $jobs_query->max_num_pages ); ?>">
                        <?php echo esc_html( $load_more_text ); ?>
                    </button>
                </div>
            <?php else : ?>
                <div class="all-jobs-loadmore-wrap">
                    <button type="button" id="btn-load-more-jobs" class="btn-load-more-jobs" style="opacity:0.6; cursor:default;" disabled>
                        ALL JOBS LOADED
                    </button>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="no-jobs-found">
                <p><?php echo esc_html( $no_jobs_text ); ?></p>
            </div>
        <?php endif; ?>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('all-jobs-sort-select');
    const jobsGrid   = document.getElementById('all-jobs-grid');
    const loadMoreBtn = document.getElementById('btn-load-more-jobs');
    const ajaxUrl    = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

    if (!jobsGrid) return;

    // Lọc và tải lại danh sách theo tiêu chí Sort/Filter
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const val = this.value;
            if (!loadMoreBtn) return;

            loadMoreBtn.disabled = true;
            loadMoreBtn.innerHTML = '<span>Loading...</span>';

            const formData = new FormData();
            formData.append('action', 'load_more_jobs');
            formData.append('page', 1);
            formData.append('sort', val);
            formData.append('search_keywords', <?php echo json_encode( $search_keywords ); ?>);
            formData.append('search_location', <?php echo json_encode( $search_location ); ?>);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    jobsGrid.innerHTML = data.data.html;
                    loadMoreBtn.setAttribute('data-page', '1');
                    loadMoreBtn.setAttribute('data-max-pages', data.data.max_pages);

                    if (data.data.has_more) {
                        loadMoreBtn.disabled = false;
                        loadMoreBtn.style.opacity = '1';
                        loadMoreBtn.innerHTML = '<?php echo esc_js( $load_more_text ); ?>';
                    } else {
                        loadMoreBtn.disabled = true;
                        loadMoreBtn.style.opacity = '0.6';
                        loadMoreBtn.style.cursor = 'default';
                        loadMoreBtn.innerHTML = 'ALL JOBS LOADED';
                    }
                }
            })
            .catch(err => {
                console.error('Lỗi khi lọc việc làm:', err);
                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = '<?php echo esc_js( $load_more_text ); ?>';
            });
        });
    }

    // Tải thêm (Load More) công việc
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            let currentPage = parseInt(this.getAttribute('data-page')) || 1;
            const maxPages  = parseInt(this.getAttribute('data-max-pages')) || 1;
            const nextPage  = currentPage + 1;
            const currentSort = sortSelect ? sortSelect.value : 'latest';

            if (nextPage > maxPages) return;

            const btn = this;
            btn.disabled = true;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span>Loading...</span>';

            const formData = new FormData();
            formData.append('action', 'load_more_jobs');
            formData.append('page', nextPage);
            formData.append('sort', currentSort);
            formData.append('search_keywords', <?php echo json_encode( $search_keywords ); ?>);
            formData.append('search_location', <?php echo json_encode( $search_location ); ?>);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    jobsGrid.insertAdjacentHTML('beforeend', data.data.html);
                    btn.setAttribute('data-page', nextPage);

                    if (data.data.has_more) {
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    } else {
                        btn.disabled = true;
                        btn.style.opacity = '0.6';
                        btn.style.cursor = 'default';
                        btn.innerHTML = 'ALL JOBS LOADED';
                    }
                } else {
                    btn.disabled = true;
                    btn.innerHTML = 'ALL JOBS LOADED';
                }
            })
            .catch(err => {
                console.error('Lỗi khi tải thêm việc làm:', err);
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        });
    }
});
</script>

