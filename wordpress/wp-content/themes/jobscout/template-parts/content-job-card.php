<?php
/**
 * Template part: Hiển thị 1 Card công việc dạng lưới chuẩn mẫu Plan Do See / All Jobs
 * Đầy đủ 7 thông tin theo yêu cầu đề bài:
 * 1. Hình ảnh công ty
 * 2. Tiêu đề công việc
 * 3. Ngày tạo công việc
 * 4. Danh mục công việc
 * 5. Tên công ty
 * 6. Khu vực tuyển dụng
 * 7. Mô tả ngắn công việc
 *
 * @package JobScout
 */

global $post;

// 1. Logo & Tên công ty
$company_name = get_post_meta( get_the_ID(), '_company_name', true );
if ( empty( $company_name ) ) {
    $company_terms = wp_get_post_terms( get_the_ID(), 'companies' );
    if ( ! empty( $company_terms ) && ! is_wp_error( $company_terms ) ) {
        $company_name = $company_terms[0]->name;
    }
}
if ( empty( $company_name ) ) {
    $company_name = 'Plan Do See';
}
$company_name = wp_specialchars_decode( $company_name, ENT_QUOTES );

$company_logo_url = '';
if ( function_exists( 'get_the_company_logo' ) ) {
    $company_logo_url = get_the_company_logo( get_the_ID(), 'thumbnail' );
}
if ( empty( $company_logo_url ) && has_post_thumbnail() ) {
    $company_logo_url = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
}
if ( empty( $company_logo_url ) ) {
    $raw_meta_logo = get_post_meta( get_the_ID(), '_company_logo', true );
    if ( ! empty( $raw_meta_logo ) ) {
        $company_logo_url = is_numeric( $raw_meta_logo ) ? wp_get_attachment_image_url( $raw_meta_logo, 'thumbnail' ) : $raw_meta_logo;
    }
}

// 2. Loại công việc (Fulltime, Part-time...)
$job_types = wpjm_get_the_job_types();
$job_type_label = ! empty( $job_types ) ? $job_types[0]->name : 'Fulltime';

// 3. Danh mục công việc
$categories = get_the_terms( get_the_ID(), 'job_listing_category' );
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
    $job_category_label = $categories[0]->name;
} else {
    // Fallback nếu chưa gán category
    $job_category_label = 'Category Name';
}

// 4. Khu vực tuyển dụng
$job_location = get_post_meta( get_the_ID(), '_job_location', true );
if ( empty( $job_location ) ) {
    $job_location = 'Ho Chi Minh City';
}

// 5. Mô tả ngắn (3 gạch đầu dòng)
$raw_desc = ! empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
$bullet_points = array();

if ( ! empty( $raw_desc ) ) {
    // Tách theo dòng nếu người dùng nhập xuống dòng
    $clean_text = strip_shortcodes( $raw_desc );
    $clean_text = wp_strip_all_tags( $clean_text );
    $lines = preg_split( '/\r\n|\r|\n/', trim( $clean_text ) );
    foreach ( $lines as $line ) {
        $clean_line = trim( ltrim( trim( $line ), "-*• \t\n\r\0\x0B" ) );
        if ( ! empty( $clean_line ) ) {
            $bullet_points[] = $clean_line;
        }
        if ( count( $bullet_points ) >= 3 ) break;
    }
}

// Fallback 3 bullet points chuẩn theo ảnh mẫu
if ( count( $bullet_points ) < 3 ) {
    $defaults = array(
        'Be responsible for the effective operational management of the hotel',
        'Excellent salary bonuses & recognition activities',
        'Foreign language allowance (up to 500USD/month)'
    );
    while ( count( $bullet_points ) < 3 ) {
        $bullet_points[] = $defaults[ count( $bullet_points ) ];
    }
}
?>

<article class="all-jobs-card" data-job-type="<?php echo esc_attr( sanitize_title( $job_type_label ) ); ?>">
    <!-- KHỐI TRÊN: LOGO + TIÊU ĐỀ + NGÀY + BADGES -->
    <div class="job-card-top">
        <div class="job-card-logo">
            <?php if ( ! empty( $company_logo_url ) ) : ?>
                <img src="<?php echo esc_url( $company_logo_url ); ?>" alt="<?php echo esc_attr( $company_name ); ?>" />
            <?php else : ?>
                <!-- Icon fallback logo công ty thanh lịch -->
                <div class="job-card-logo-fallback">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
            <?php endif; ?>
        </div>

        <div class="job-card-header-info">
            <h3 class="job-card-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="job-card-meta-date">
                Created: <?php echo get_the_date( 'M d, Y' ); ?>
            </div>

            <!-- 4. Danh mục / 5. Tên công ty / 6. Khu vực tuyển dụng -->
            <div class="job-card-badges-row">
                <span class="job-badge job-badge-cat"><?php echo esc_html( $job_category_label ); ?></span>
                <span class="job-badge job-badge-company"><?php echo esc_html( $company_name ); ?></span>
                <span class="job-badge job-badge-loc"><?php echo esc_html( $job_location ); ?></span>
            </div>
        </div>
    </div>

    <!-- KHỐI DƯỚI: 3 GẠCH ĐẦU DÒNG MÔ TẢ NGẮN -->
    <div class="job-card-bottom">
        <ul class="job-card-highlights">
            <?php foreach ( $bullet_points as $point ) : ?>
                <li><?php echo esc_html( $point ); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</article>
