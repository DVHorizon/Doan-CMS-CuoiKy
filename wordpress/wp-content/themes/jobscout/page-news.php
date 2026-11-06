<?php
/**
 * Template Name: News Page Template
 *
 * @package JobScout
 */

get_header();

// Lấy thứ tự các khối từ Customizer (mặc định: banner -> news-list)
$default_order = array( 'banner', 'news-list' );
$news_order    = get_theme_mod( 'news_sections_order', $default_order );

if ( ! is_array( $news_order ) ) {
    $decoded    = json_decode( (string) $news_order, true );
    $news_order = is_array( $decoded ) ? $decoded : $default_order;
}
?>

<div class="custom-news-page">
    <?php
    foreach ( $news_order as $section_name ) {
        $section_name = sanitize_key( $section_name );
        if ( in_array( $section_name, array( 'banner', 'news-list' ), true ) ) {
            get_template_part( 'template-parts/news/section', $section_name );
        }
    }
    ?>
</div>

<?php
get_footer();
