<?php
/**
 * Contact Page - Khối 1: Hero Banner
 * 
 * @package JobScout
 */
$banner_bg    = get_theme_mod( 'contact_banner_image', get_template_directory_uri() . '/images/contact-banner-kimono.jpg' );
$banner_title = get_theme_mod( 'contact_banner_title', 'CONTACT US' );
?>
<section class="contact-hero-banner" style="background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)), url('<?php echo esc_url( $banner_bg ); ?>');">
    <div class="contact-banner-container">
        <h1 class="contact-banner-title"><?php echo esc_html( $banner_title ); ?></h1>
    </div>
</section>

