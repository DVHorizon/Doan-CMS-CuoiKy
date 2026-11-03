<?php
/**
 * About Page - Khối 3: Lĩnh Vực Hoạt Động (Services)
 * 
 * @package JobScout
 */
$services_title    = get_theme_mod( 'about_services_title', 'Hotels, restaurants, banquets/weddings management' );
$services_desc_1   = get_theme_mod( 'about_services_desc_1', 'Plan Do See developed and operates 17 properties worldwide including 3 award-winning resorts in Japan; 17 restaurants of diverse cuisines in cities including New York, Miami and Los Angeles; and other countries including Japan, Indonesia, Malaysia and Bali.' );
$services_desc_2   = get_theme_mod( 'about_services_desc_2', 'Each venue carries its own concept and design. Many of them are originally historical landmarks that were loved by the local people.' );
?>
<section class="about-section about-services-section">
    <div class="about-container-narrow">
        <h3 class="services-highlight-title"><?php echo esc_html( $services_title ); ?></h3>
        <p class="services-desc">
            <?php echo wp_kses_post( $services_desc_1 ); ?>
        </p>
        <p class="services-desc">
            <?php echo wp_kses_post( $services_desc_2 ); ?>
        </p>
    </div>
</section>

