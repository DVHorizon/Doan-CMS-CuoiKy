<?php
/**
 * Template part for displaying single job listing matching design specification.
 * Fully integrated with WordPress Admin Customizer -> Job Detail Settings.
 *
 * @package JobScout
 */

global $post;

// 1. DỮ LIỆU ĐỘNG CỦA CÔNG VIỆC HIỆN TẠI
$job_id = get_the_ID();

// Tên & Logo công ty
$company_name = get_post_meta( $job_id, '_company_name', true );
if ( empty( $company_name ) ) {
    $company_name = 'PLAN DO SEE';
}

$company_logo_url = '';
if ( function_exists( 'get_the_company_logo' ) ) {
    $company_logo_url = get_the_company_logo( $job_id, 'thumbnail' );
}
if ( empty( $company_logo_url ) && has_post_thumbnail() ) {
    $company_logo_url = get_the_post_thumbnail_url( $job_id, 'thumbnail' );
}
if ( empty( $company_logo_url ) ) {
    $raw_meta_logo = get_post_meta( $job_id, '_company_logo', true );
    if ( ! empty( $raw_meta_logo ) ) {
        $company_logo_url = is_numeric( $raw_meta_logo ) ? wp_get_attachment_image_url( $raw_meta_logo, 'thumbnail' ) : $raw_meta_logo;
    }
}

// Loại công việc (Fulltime, Part-time...)
$job_types = wpjm_get_the_job_types();
$job_type_label = ! empty( $job_types ) ? $job_types[0]->name : 'Fulltime';

// Danh mục công việc
$categories = get_the_terms( $job_id, 'job_listing_category' );
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
    $job_category_label = $categories[0]->name;
} else {
    $job_category_label = 'Category Name';
}

// Địa điểm làm việc
$job_location = get_post_meta( $job_id, '_job_location', true );
if ( empty( $job_location ) ) {
    $job_location = 'Ho Chi Minh City';
}

// Ngày đăng
$job_created_date = get_the_date( 'M d, Y' );

// 2. DỮ LIỆU TÙY CHỈNH TỪ ADMIN CUSTOMIZER
$bc_home        = get_theme_mod( 'job_single_breadcrumb_home', 'Home' );
$bc_all_jobs    = get_theme_mod( 'job_single_breadcrumb_all_jobs', 'All Jobs' );
$bc_jobs_url    = get_theme_mod( 'job_single_breadcrumb_all_jobs_url', home_url( '/jobs/' ) );
$bc_detail      = get_theme_mod( 'job_single_breadcrumb_detail', 'Job Detail' );

$share_text     = get_theme_mod( 'job_single_share_text', 'SHARE' );
$apply_text     = get_theme_mod( 'job_single_apply_text', 'APPLY JOB' );
$apply_url      = get_theme_mod( 'job_single_apply_url', '#apply-modal' );
$modal_title    = get_theme_mod( 'job_single_modal_title', __( 'Ứng tuyển công việc', 'jobscout' ) );
$modal_subtitle = get_theme_mod( 'job_single_modal_subtitle', __( 'Vui lòng điền thông tin và đính kèm CV (PDF, DOC, DOCX tối đa 10MB)', 'jobscout' ) );
$modal_submit   = get_theme_mod( 'job_single_modal_submit_text', __( 'GỬI HỒ SƠ ỨNG TUYỂN', 'jobscout' ) );
$cf7_form_id    = get_theme_mod( 'job_single_cf7_form_id', '1167' );

// Success Modal
$success_title  = get_theme_mod( 'job_single_success_modal_title', __( 'Nộp Hồ Sơ Thành Công!', 'jobscout' ) );
$success_desc   = get_theme_mod( 'job_single_success_modal_desc', __( 'Cảm ơn bạn! Hồ sơ ứng tuyển của bạn đã được chuyển tới nhà tuyển dụng. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất qua email.', 'jobscout' ) );
$success_btn    = get_theme_mod( 'job_single_success_modal_btn', __( 'Đã Hiểu / Đóng', 'jobscout' ) );


// 4 Section chính (Left Column)
$default_overview = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui. Ut placerat aenean accumsan a, aenean lacus eu. Aliquet urna, habitasse elit lorem id enim quam. Ea varius nulla nullam dignissim massa tempor, massa tortor. Eget auctor nulla maecenas ac tortor.\n\nOrnare faucibus sed vitae dolor eu ea faucibus leo enim. Tincidunt quisque sed netus nibh pharetra. Gravida venenatis, lobortis id mi. Metus, ultrices duis pellentesque aliquet amet cras blandit. Aliquet purus quam laoreet ipsum pretium. Odio quis eu nunc, diam habitant nunc massa sed. Placerat arcu quis est, magna facilisis amet. Dignissim vel adipiscing elit facilisi praesent platea. Nulla posuere feugiat turpis magna etiam. Non nec felis eu praesent cras.";
$default_skills   = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui. Ut placerat aenean accumsan a, aenean lacus eu. Aliquet urna, habitasse elit lorem id enim quam. Ea varius nulla nullam dignissim massa tempor, massa tortor. Eget auctor nulla maecenas ac tortor.";
$default_love     = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui. Ut placerat aenean accumsan a, aenean lacus eu. Aliquet urna, habitasse elit lorem id enim quam. Ea varius nulla nullam dignissim massa tempor, massa tortor. Eget auctor nulla maecenas ac tortor.\n\nOrnare faucibus sed vitae dolor eu ea faucibus leo enim. Tincidunt quisque sed netus nibh pharetra. Gravida venenatis, lobortis id mi. Metus, ultrices duis pellentesque aliquet amet cras blandit. Aliquet purus quam laoreet ipsum pretium. Odio quis eu nunc, diam habitant nunc massa sed. Placerat arcu quis est, magna facilisis amet. Dignissim vel adipiscing elit facilisi praesent platea. Nulla posuere feugiat turpis magna etiam. Non nec felis eu praesent cras.";
$default_location = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum, mi. Sit scelerisque at amet leo. In volutpat turpis dolor, at. Vivamus volutpat in nunc, porttitor dui.";

$overview_title = get_theme_mod( 'job_single_overview_title', 'Overview about Company' );
$overview_desc  = get_theme_mod( 'job_single_overview_content', $default_overview );

$skills_title   = get_theme_mod( 'job_single_skills_title', 'Our Key Skills' );
$skills_desc    = get_theme_mod( 'job_single_skills_content', $default_skills );

$love_title     = get_theme_mod( 'job_single_love_title', "Why You'll Love Working Here" );
$love_desc      = get_theme_mod( 'job_single_love_content', $default_love );

$location_title = get_theme_mod( 'job_single_location_title', 'Location' );
$location_desc  = get_theme_mod( 'job_single_location_content', $default_location );

// Sidebar: Staff Rating
$show_rating    = get_theme_mod( 'job_single_show_rating', true );
$rating_title   = get_theme_mod( 'job_single_rating_title', 'Staff Rating' );
$rating_score   = get_theme_mod( 'job_single_rating_score', '4.0' );
$rating_stars   = intval( get_theme_mod( 'job_single_rating_stars', 4 ) );

// Sidebar: Company Photos
$show_photos    = get_theme_mod( 'job_single_show_photos', true );
$photos_title   = get_theme_mod( 'job_single_photos_title', 'Company Photos' );
$photo_image    = get_theme_mod( 'job_single_photo_image', home_url( '/wp-content/uploads/2026/10/tokyo.jpg' ) );
$photos_count   = get_theme_mod( 'job_single_photos_count', '+5' );

// Other Jobs
$show_other     = get_theme_mod( 'job_single_show_other', true );
$other_title    = get_theme_mod( 'job_single_other_title', 'OTHER JOBS' );
$other_count    = absint( get_theme_mod( 'job_single_other_count', 6 ) );
if ( $other_count <= 0 ) {
    $other_count = 6;
}
// 4 Section chính (Left Column) - Lấy từ Post Meta hoặc Customizer
$meta_overview = get_post_meta( $job_id, '_job_overview', true );
$final_overview = ! empty( $meta_overview ) ? $meta_overview : $overview_desc;

$meta_skills = get_post_meta( $job_id, '_job_skills', true );
$final_skills = ! empty( $meta_skills ) ? $meta_skills : $skills_desc;

$meta_love = get_post_meta( $job_id, '_job_love_working_here', true );
$final_love = ! empty( $meta_love ) ? $meta_love : $love_desc;

$meta_location = get_post_meta( $job_id, '_job_location_desc', true );
$final_location = ! empty( $meta_location ) ? $meta_location : $location_desc;
?>

<article id="post-<?php the_ID(); ?>" class="single-job-detail-container">

    <!-- 1. BREADCRUMBS: Home / All Jobs / Job Detail -->
    <nav class="single-job-breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $bc_home ); ?></a>
        <span class="bc-sep">/</span>
        <a href="<?php echo esc_url( $bc_jobs_url ); ?>"><?php echo esc_html( $bc_all_jobs ); ?></a>
        <span class="bc-sep">/</span>
        <span class="bc-current"><?php echo esc_html( $bc_detail ); ?></span>
    </nav>

    <!-- 2. TOP HEADER CARD: LOGO + TITLE + BADGES + BUTTONS -->
    <div class="single-job-header-card">
        <div class="single-job-header-left">
            <div class="single-job-logo-box">
                <?php if ( ! empty( $company_logo_url ) ) : ?>
                    <img src="<?php echo esc_url( $company_logo_url ); ?>" alt="<?php echo esc_attr( $company_name ); ?>" />
                <?php else : ?>
                    <div class="single-job-logo-placeholder">
                        <svg viewBox="0 0 24 24" width="34" height="34" fill="none" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                <?php endif; ?>
            </div>

            <div class="single-job-meta-box">
                <h1 class="single-job-title"><?php the_title(); ?></h1>
                <div class="single-job-created-date">
                    <?php echo esc_html( sprintf( __( 'Created: %s', 'jobscout' ), $job_created_date ) ); ?>
                </div>
                <div class="single-job-badges-row">
                    <span class="job-badge badge-type"><?php echo esc_html( $job_type_label ); ?></span>
                    <span class="job-badge badge-category"><?php echo esc_html( $job_category_label ); ?></span>
                    <span class="job-badge badge-location"><?php echo esc_html( $job_location ); ?></span>
                </div>
            </div>
        </div>

        <div class="single-job-header-right">
            <button type="button" class="btn-job-action btn-job-share" id="btn-single-job-share" title="<?php esc_attr_e( 'Chia sẻ liên kết việc làm', 'jobscout' ); ?>">
                <?php echo esc_html( $share_text ); ?>
            </button>
            <a href="<?php echo esc_url( $apply_url ); ?>" class="btn-job-action btn-job-apply" id="btn-single-job-apply">
                <?php echo esc_html( $apply_text ); ?>
            </a>
        </div>
    </div>

    <!-- 3. TWO-COLUMN MAIN BODY -->
    <div class="single-job-body-grid">
        
        <!-- LEFT COLUMN: 4 SUBSECTIONS -->
        <div class="single-job-main-column">
            <div class="single-job-content-card">
                
                <!-- SECTION 1: OVERVIEW ABOUT COMPANY -->
                <section class="job-sub-section">
                    <h2 class="job-sub-title"><?php echo esc_html( $overview_title ); ?></h2>
                    <div class="job-sub-desc">
                        <?php echo wp_kses_post( wpautop( $final_overview ) ); ?>
                    </div>
                </section>

                <!-- SECTION 2: OUR KEY SKILLS -->
                <section class="job-sub-section">
                    <h2 class="job-sub-title"><?php echo esc_html( $skills_title ); ?></h2>
                    <div class="job-sub-desc">
                        <?php echo wp_kses_post( wpautop( $final_skills ) ); ?>
                    </div>
                </section>

                <!-- SECTION 3: WHY YOU'LL LOVE WORKING HERE -->
                <section class="job-sub-section">
                    <h2 class="job-sub-title"><?php echo esc_html( $love_title ); ?></h2>
                    <div class="job-sub-desc">
                        <?php echo wp_kses_post( wpautop( $final_love ) ); ?>
                    </div>
                </section>

                <!-- SECTION 4: LOCATION -->
                <section class="job-sub-section">
                    <h2 class="job-sub-title"><?php echo esc_html( $location_title ); ?></h2>
                    <div class="job-sub-desc">
                        <?php echo wp_kses_post( wpautop( $final_location ) ); ?>
                    </div>
                </section>

                <!-- JOB APPLICATION HOOK / FORM -->
                <div id="job-apply-section" class="job-application-wrapper">
                    <?php
                    // Hỗ trợ chức năng Apply chuẩn của WP Job Manager nếu có
                    if ( candidates_can_apply() ) {
                        get_job_manager_template( 'job-application.php' );
                    }
                    ?>
                </div>

            </div>
        </div>

        <!-- RIGHT COLUMN: SIDEBAR WIDGETS -->
        <aside class="single-job-sidebar-column">
            
            <!-- WIDGET 1: STAFF RATING -->
            <?php if ( $show_rating ) : ?>
                <div class="job-sidebar-card staff-rating-card">
                    <h3 class="sidebar-card-title"><?php echo esc_html( $rating_title ); ?></h3>
                    <div class="staff-rating-body">
                        <div class="rating-stars" aria-label="<?php echo esc_attr( $rating_score ); ?> stars">
                            <?php 
                            for ( $i = 1; $i <= 5; $i++ ) {
                                if ( $i <= $rating_stars ) {
                                    echo '<span class="star filled">★</span>';
                                } else {
                                    echo '<span class="star empty">☆</span>';
                                }
                            }
                            ?>
                        </div>
                        <span class="rating-number"><?php echo esc_html( $rating_score ); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- WIDGET 2: COMPANY PHOTOS -->
            <?php if ( $show_photos ) : ?>
                <div class="job-sidebar-card company-photos-card">
                    <h3 class="sidebar-card-title"><?php echo esc_html( $photos_title ); ?></h3>
                    <div class="company-photos-wrapper">
                        <div class="company-photo-item">
                            <img src="<?php echo esc_url( $photo_image ); ?>" alt="<?php echo esc_attr( $photos_title ); ?>" />
                            <?php if ( ! empty( $photos_count ) ) : ?>
                                <div class="photo-overlay-badge">
                                    <span><?php echo esc_html( $photos_count ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </aside>

    </div>

    <!-- 4. OTHER JOBS SECTION -->
    <?php if ( $show_other ) : ?>
        <section class="single-job-other-section">
            <h2 class="other-jobs-heading"><?php echo esc_html( $other_title ); ?></h2>
            
            <?php
            $other_args = array(
                'post_type'      => 'job_listing',
                'post_status'    => 'publish',
                'posts_per_page' => $other_count,
                'post__not_in'   => array( $job_id ),
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $other_query = new WP_Query( $other_args );

            if ( $other_query->have_posts() ) :
            ?>
                <div class="all-jobs-grid">
                    <?php
                    while ( $other_query->have_posts() ) :
                        $other_query->the_post();
                        get_template_part( 'template-parts/content', 'job-card' );
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

</article>

<!-- TOAST THÔNG BÁO COPY SHARE -->
<div id="job-share-toast" class="job-share-toast">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
    </svg>
    <span><?php esc_html_e( 'Đã sao chép liên kết vào bộ nhớ tạm!', 'jobscout' ); ?></span>
</div>

<!-- POPUP MODAL NỘP HỒ SƠ ỨNG TUYỂN KÈM CV -->
<div id="job-apply-modal" class="job-apply-modal-backdrop" aria-hidden="true">
    <div class="job-apply-modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-apply-title">
        <button type="button" class="job-apply-modal-close" id="btn-close-apply-modal" aria-label="<?php esc_attr_e( 'Đóng', 'jobscout' ); ?>">&times;</button>
        
        <div class="job-apply-modal-header">
            <h3 class="modal-apply-title" id="modal-apply-title"><?php echo esc_html( $modal_title ); ?></h3>
            <p class="modal-apply-jobname"><?php the_title(); ?> - <span><?php echo esc_html( $company_name ); ?></span></p>
            <p class="modal-apply-subtitle"><?php echo esc_html( $modal_subtitle ); ?></p>
        </div>

        <?php 
        // Nếu đã chọn Form Contact Form 7 và CF7 đang hoạt động
        $use_cf7 = ( ! empty( $cf7_form_id ) && 'none' !== $cf7_form_id && function_exists( 'wpcf7' ) );
        if ( $use_cf7 ) : 
        ?>
            <div class="cf7-modal-container">
                <?php echo do_shortcode( '[contact-form-7 id="' . absint( $cf7_form_id ) . '"]' ); ?>
            </div>
        <?php else : ?>
            <form id="form-job-application" class="job-apply-form" enctype="multipart/form-data">
                <input type="hidden" name="action" value="submit_job_application" />
                <input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
                <input type="hidden" name="apply_nonce" value="<?php echo esc_attr( wp_create_nonce( 'jobscout_apply_nonce' ) ); ?>" />

                <div class="apply-form-row">
                    <div class="apply-form-group">
                        <label for="applicant_name"><?php esc_html_e( 'Họ và tên *', 'jobscout' ); ?></label>
                        <input type="text" id="applicant_name" name="applicant_name" class="apply-input" placeholder="<?php esc_attr_e( 'Nguyễn Văn A', 'jobscout' ); ?>" required />
                    </div>
                    <div class="apply-form-group">
                        <label for="applicant_email"><?php esc_html_e( 'Email liên hệ *', 'jobscout' ); ?></label>
                        <input type="email" id="applicant_email" name="applicant_email" class="apply-input" placeholder="email@domain.com" required />
                    </div>
                </div>

                <div class="apply-form-row">
                    <div class="apply-form-group">
                        <label for="applicant_phone"><?php esc_html_e( 'Số điện thoại', 'jobscout' ); ?></label>
                        <input type="tel" id="applicant_phone" name="applicant_phone" class="apply-input" placeholder="<?php esc_attr_e( '0987 654 321', 'jobscout' ); ?>" />
                    </div>
                    <div class="apply-form-group">
                        <label for="applicant_cv"><?php esc_html_e( 'Tải lên CV (PDF, DOC, DOCX) *', 'jobscout' ); ?></label>
                        <div class="file-upload-wrapper">
                            <input type="file" id="applicant_cv" name="applicant_cv" class="apply-file-input" accept=".pdf,.doc,.docx" required />
                        </div>
                    </div>
                </div>

                <div class="apply-form-group">
                    <label for="applicant_message"><?php esc_html_e( 'Thư giới thiệu / Lời nhắn cho nhà tuyển dụng', 'jobscout' ); ?></label>
                    <textarea id="applicant_message" name="applicant_message" class="apply-textarea" rows="3" placeholder="<?php esc_attr_e( 'Nêu ngắn gọn lý do bạn phù hợp với vị trí này...', 'jobscout' ); ?>"></textarea>
                </div>

                <div id="apply-form-response" class="apply-form-response" style="display:none;"></div>

                <div class="apply-form-footer">
                    <button type="submit" id="btn-submit-job-app" class="btn-submit-apply">
                        <?php echo esc_html( $modal_submit ); ?>
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- POPUP MODAL THÔNG BÁO GỬI HỒ SƠ THÀNH CÔNG -->
<div id="job-success-modal" class="job-apply-modal-backdrop job-success-modal-backdrop" aria-hidden="true">
    <div class="job-apply-modal-card job-success-modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-success-title">
        <button type="button" class="job-apply-modal-close" id="btn-close-success-modal" aria-label="<?php esc_attr_e( 'Đóng', 'jobscout' ); ?>">&times;</button>
        
        <div class="job-success-body">
            <div class="success-icon-wrap">
                <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="#ea580c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h3 class="modal-success-title" id="modal-success-title"><?php echo esc_html( $success_title ); ?></h3>
            <p class="modal-success-jobname"><?php the_title(); ?> - <span><?php echo esc_html( $company_name ); ?></span></p>
            <div class="modal-success-desc">
                <?php echo wp_kses_post( wpautop( $success_desc ) ); ?>
            </div>
            <button type="button" class="btn-success-modal-close" id="btn-done-success-modal">
                <?php echo esc_html( $success_btn ); ?>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Share button copy URL
    const btnShare = document.getElementById('btn-single-job-share');
    const toast    = document.getElementById('job-share-toast');
    
    if (btnShare && toast) {
        btnShare.addEventListener('click', function(e) {
            e.preventDefault();
            const shareUrl = window.location.href;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(shareUrl).then(showToast);
            } else {
                const tempInput = document.createElement('input');
                tempInput.value = shareUrl;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                showToast();
            }
        });

        function showToast() {
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000);
        }
    }

    // 2. Nút APPLY JOB & Các Modal
    const btnApply       = document.getElementById('btn-single-job-apply');
    const applyModal     = document.getElementById('job-apply-modal');
    const btnCloseApply  = document.getElementById('btn-close-apply-modal');
    const successModal   = document.getElementById('job-success-modal');
    const btnCloseSuccess = document.getElementById('btn-close-success-modal');
    const btnDoneSuccess  = document.getElementById('btn-done-success-modal');
    const applyForm      = document.getElementById('form-job-application');
    const responseBox    = document.getElementById('apply-form-response');
    const btnSubmit      = document.getElementById('btn-submit-job-app');
    const ajaxUrl        = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

    // Mở popup nộp đơn
    if (btnApply) {
        btnApply.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (!href || href.startsWith('#') || href === '#apply-modal' || href === '#job-apply-section') {
                e.preventDefault();
                if (applyModal) {
                    applyModal.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            }
        });
    }

    // Đóng popup nộp đơn
    if (btnCloseApply && applyModal) {
        btnCloseApply.addEventListener('click', function() {
            applyModal.classList.remove('open');
            document.body.style.overflow = '';
        });

        applyModal.addEventListener('click', function(e) {
            if (e.target === applyModal) {
                applyModal.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    }

    // Đóng popup thành công
    function closeSuccessModal() {
        if (successModal) {
            successModal.classList.remove('open');
            document.body.style.overflow = '';
        }
    }
    if (btnCloseSuccess) btnCloseSuccess.addEventListener('click', closeSuccessModal);
    if (btnDoneSuccess) btnDoneSuccess.addEventListener('click', closeSuccessModal);
    if (successModal) {
        successModal.addEventListener('click', function(e) {
            if (e.target === successModal) {
                closeSuccessModal();
            }
        });
    }

    // Hàm hiển thị Popup Thành Công
    function showSuccessModal() {
        if (applyModal) {
            applyModal.classList.remove('open');
        }
        if (successModal) {
            successModal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    // Xử lý gửi Form Native qua AJAX (nếu không dùng CF7)
    if (applyForm) {
        applyForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!btnSubmit || !responseBox) return;

            const originalBtnText = btnSubmit.innerHTML;
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<?php esc_html_e( "Đang gửi hồ sơ...", "jobscout" ); ?>';
            responseBox.style.display = 'none';
            responseBox.className = 'apply-form-response';

            const formData = new FormData(applyForm);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    applyForm.reset();
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = originalBtnText;
                    showSuccessModal();
                } else {
                    responseBox.style.display = 'block';
                    responseBox.classList.add('error');
                    responseBox.innerHTML = data.data.message || '<?php esc_html_e( "Có lỗi xảy ra, vui lòng thử lại.", "jobscout" ); ?>';
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = originalBtnText;
                }
            })
            .catch(err => {
                responseBox.style.display = 'block';
                responseBox.classList.add('error');
                responseBox.innerHTML = '<?php esc_html_e( "Lỗi kết nối máy chủ, vui lòng thử lại.", "jobscout" ); ?>';
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = originalBtnText;
            });
        });
    }

    // Tự động điền tiêu đề công việc vào ô [your-job] của Contact Form 7
    const jobTitleInput = document.querySelector('.cf7-modal-container input[name="your-job"]');
    if (jobTitleInput) {
        jobTitleInput.value = <?php echo json_encode( get_the_title() . ' (' . $company_name . ')' ); ?>;
    }

    // Lắng nghe sự kiện gửi thành công của Contact Form 7 (wpcf7mailsent)
    document.addEventListener('wpcf7mailsent', function(event) {
        // Tắt modal nhập form và mở Modal Thành Công
        showSuccessModal();
    }, false);
});
</script>