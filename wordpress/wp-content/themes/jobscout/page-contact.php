<?php
/**
 * Template Name: Contact Page Template
 *
 * @package JobScout
 */

get_header();

// Lấy thứ tự các khối từ Customizer (mặc định: banner -> headquarters -> two-columns)
$default_order = array( 'banner', 'headquarters', 'two-columns' );
$contact_order = get_theme_mod( 'contact_sections_order', $default_order );

if ( ! is_array( $contact_order ) ) {
    $decoded       = json_decode( (string) $contact_order, true );
    $contact_order = is_array( $decoded ) ? $decoded : $default_order;
}
?>

<div class="custom-contact-page">
    <?php
    foreach ( $contact_order as $section_name ) {
        $section_name = sanitize_key( $section_name );
        if ( in_array( $section_name, array( 'banner', 'headquarters', 'two-columns' ), true ) ) {
            get_template_part( 'template-parts/contact/section', $section_name );
        }
    }
    ?>
</div>

<?php
get_footer();
