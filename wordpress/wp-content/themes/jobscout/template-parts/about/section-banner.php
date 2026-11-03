<?php
/**
 * About Page - Khối 1: Hero Banner
 * 
 * @package JobScout
 */
$banner_img   = get_theme_mod( 'about_banner_image', get_template_directory_uri() . '/images/about-banner.jpg' );
$banner_title = get_theme_mod( 'about_banner_title', "SHARE “OMOTENASHI”\nWITH THE WORLD" );
?>
<section class="about-hero-banner" style="background-image: url('<?php echo esc_url( $banner_img ); ?>');">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1 class="banner-title">
            <?php echo nl2br( wp_kses_post( $banner_title ) ); ?>
        </h1>
    </div>
</section>

