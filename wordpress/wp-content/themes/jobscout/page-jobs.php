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

// Lấy thứ tự các khối từ Customizer (mặc định: banner -> jobs-grid)
$default_order = array( 'banner', 'jobs-grid' );
$jobs_order    = get_theme_mod( 'jobs_sections_order', $default_order );

if ( ! is_array( $jobs_order ) ) {
    $decoded    = json_decode( (string) $jobs_order, true );
    $jobs_order = is_array( $decoded ) ? $decoded : $default_order;
}
?>

<div class="custom-jobs-page">
    <?php
    foreach ( $jobs_order as $section_name ) {
        $section_name = sanitize_key( $section_name );
        if ( in_array( $section_name, array( 'banner', 'jobs-grid' ), true ) ) {
            get_template_part( 'template-parts/jobs/section', $section_name );
        }
    }
    ?>
</div>

<?php
get_footer();
