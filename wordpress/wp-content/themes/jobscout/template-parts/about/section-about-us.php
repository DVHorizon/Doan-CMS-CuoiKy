<?php
/**
 * About Page - Khối 2: About Us (Vision, Mission, Core Value)
 * 
 * @package JobScout
 */
$torii_img         = get_theme_mod( 'about_torii_image', get_template_directory_uri() . '/images/about-torii.jpg' );
$vision_desc       = get_theme_mod( 'about_vision_desc', 'Create hotels and restaurants around the world that offer memorable experiences while building a lasting, positive relationship together with our guests, partners, team members and communities.' );
$mission_desc      = get_theme_mod( 'about_mission_desc', 'Share “Omotenashi” with the world' );
$core_value_quote  = get_theme_mod( 'about_core_value_quote', '“If I were the guest…”' );
$core_value_desc   = get_theme_mod( 'about_core_value_desc', 'To provide guests with the hospitality you would want to receive as a guest.' );
?>
<section class="about-section about-us-section">
    <div class="about-container">
        <h2 class="section-main-title">ABOUT US</h2>
        <div class="about-grid-2col">
            <div class="col-image">
                <img src="<?php echo esc_url( $torii_img ); ?>" alt="Torii Gate" class="rounded-img" />
            </div>
            <div class="col-content">
                <div class="content-block">
                    <h3 class="block-title">Our Vision</h3>
                    <p><?php echo wp_kses_post( $vision_desc ); ?></p>
                </div>

                <div class="content-block">
                    <h3 class="block-title">Our Mission</h3>
                    <p><?php echo wp_kses_post( $mission_desc ); ?></p>
                </div>

                <div class="content-block">
                    <h3 class="block-title">Our Core Value</h3>
                    <?php if ( ! empty( $core_value_quote ) ) : ?>
                        <p class="quote"><?php echo esc_html( $core_value_quote ); ?></p>
                    <?php endif; ?>
                    <p><?php echo wp_kses_post( $core_value_desc ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

