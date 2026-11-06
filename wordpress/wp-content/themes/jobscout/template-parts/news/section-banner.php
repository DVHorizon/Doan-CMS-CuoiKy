<?php
/**
 * News Page - Hero Banner Section
 *
 * @package JobScout
 */

$banner_img   = get_theme_mod( 'news_banner_image', get_template_directory_uri() . '/images/banner-image.jpg' );
$banner_title = get_theme_mod( 'news_banner_title', 'PDS NEWS' );
?>

<!-- 1. HERO BANNER TRÊN CÙNG -->
<section class="news-hero-banner" style="background-image: url('<?php echo esc_url( $banner_img ); ?>');">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1 class="banner-title"><?php echo esc_html( $banner_title ); ?></h1>
    </div>
</section>

