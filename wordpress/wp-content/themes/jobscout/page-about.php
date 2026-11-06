<?php
/**
 * Template Name: About Page Template
 *
 * @package JobScout
 */

get_header();

// Lấy thứ tự các khối từ Customizer (mặc định: banner -> about-us -> services -> company-info)
$default_order = array( 'banner', 'about-us', 'services', 'company-info' );
$about_order   = get_theme_mod( 'about_sections_order', $default_order );

if ( ! is_array( $about_order ) ) {
    $decoded     = json_decode( (string) $about_order, true );
    $about_order = is_array( $decoded ) ? $decoded : $default_order;
}
?>

<div class="custom-about-page">
    <?php
    foreach ( $about_order as $section_name ) {
        $section_name = sanitize_key( $section_name );
        if ( in_array( $section_name, array( 'banner', 'about-us', 'services', 'company-info' ), true ) ) {
            get_template_part( 'template-parts/about/section', $section_name );
        }
    }
    ?>
</div>

<?php
get_footer();
