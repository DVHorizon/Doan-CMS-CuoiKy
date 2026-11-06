<?php
/**
 * Jobs Page - Hero Banner Section
 *
 * @package JobScout
 */

$default_banner = get_template_directory_uri() . '/images/contact-banner-kimono.jpg';
$banner_img     = get_theme_mod( 'jobs_banner_image', 'http://wordpress.local/wp-content/uploads/2026/10/images.jpg' );
if ( empty( $banner_img ) ) {
    $banner_img = $default_banner;
}
$banner_title = get_theme_mod( 'jobs_banner_title', 'CAREER WITH US' );
?>

<!-- 1. HERO BANNER: CAREER WITH US -->
<section class="jobs-hero-banner" style="background-image: url('<?php echo esc_url( $banner_img ); ?>');">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1 class="banner-title"><?php echo esc_html( $banner_title ); ?></h1>
    </div>
</section>

