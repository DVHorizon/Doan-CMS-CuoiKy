<?php
/**
 * Front Page
 * 
 * Hỗ trợ sắp xếp thứ tự các section kéo thả linh hoạt từ Customizer.
 * 
 * @package JobScout
 */

get_header();

// Lấy thứ tự các khối từ Customizer (mặc định: banner -> jobposting -> cta -> blog)
$default_order = array( 'banner', 'jobposting', 'cta', 'blog' );
$home_order    = get_theme_mod( 'home_sections_order', $default_order );

if ( ! is_array( $home_order ) ) {
    $decoded    = json_decode( (string) $home_order, true );
    $home_order = is_array( $decoded ) ? $decoded : $default_order;
}

// Render từng section theo đúng thứ tự mà người dùng cấu hình
foreach ( $home_order as $section_name ) {
    $section_name = sanitize_key( $section_name );
    if ( in_array( $section_name, array( 'banner', 'jobposting', 'cta', 'blog', 'testimonial', 'client' ), true ) ) {
        get_template_part( 'sections/' . $section_name );
    }
}

get_footer();
