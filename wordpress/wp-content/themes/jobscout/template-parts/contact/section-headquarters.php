<?php
/**
 * Contact Page - Khối 2: Địa chỉ trụ sở (Headquarters)
 * 
 * @package JobScout
 */
$hq_title   = get_theme_mod( 'contact_hq_title', 'Our Headquarters Address' );
$hq_address = get_theme_mod( 'contact_hq_address', '60 Nguyen Van Thu, Ward Da Kao, District 1, Ho Chi Minh City, Viet Nam' );
?>
<section class="contact-headquarters-section">
    <div class="contact-container">
        <?php if ( ! empty( $hq_title ) ) : ?>
            <h2 class="contact-hq-title"><?php echo esc_html( $hq_title ); ?></h2>
        <?php endif; ?>
        <?php if ( ! empty( $hq_address ) ) : ?>
            <p class="contact-hq-address"><?php echo nl2br( esc_html( $hq_address ) ); ?></p>
        <?php endif; ?>
    </div>
</section>

