<?php
/**
 * CTA Section - CAREER WITH US
 * 
 * @package JobScout
 */

$ed_career = get_theme_mod( 'ed_career_section', true );
if ( ! $ed_career ) {
    return;
}

$career_bg          = get_theme_mod( 'career_bg_image', get_template_directory_uri() . '/images/home-career-sakura.jpg' );
$career_title       = get_theme_mod( 'career_title', 'CAREER WITH US' );
$default_desc       = "Plan Do See Global is a hospitality group founded in Japan and rooted in \"Omotenashi\", the Japanese principle of selfless hospitality. We strive to deliver unforgettable and bespoke experiences, to understand local cultures like natives, to provide service that is warm but not intrusive, and to foresee our guests' every need at all times. That is our sole mission and our pride.\n\nWe are experts in all stages of project development: concept, design, implementation and management. We love to find unique ways to create experiences that surprise and delight guests and customers.";
$career_content     = get_theme_mod( 'career_content', $default_desc );
$career_btn_text    = get_theme_mod( 'career_btn_text', 'MORE ABOUT US' );
$about_url          = get_theme_mod( 'career_btn_url', home_url( '/about/' ) );
?>

<section id="custom-career-section" class="custom-career-section" style="background-image: linear-gradient(rgba(20, 15, 12, 0.72), rgba(15, 10, 8, 0.88)), url('<?php echo esc_url( $career_bg ); ?>');">
    <div class="career-container">
        <?php if ( ! empty( $career_title ) ) : ?>
            <h2 class="career-section-title"><?php echo esc_html( $career_title ); ?></h2>
        <?php endif; ?>
        
        <?php if ( ! empty( $career_content ) ) : ?>
            <div class="career-text-block">
                <?php 
                $paragraphs = explode( "\n\n", str_replace( "\r\n", "\n", $career_content ) );
                foreach ( $paragraphs as $p ) {
                    $p = trim( $p );
                    if ( ! empty( $p ) ) {
                        echo '<p>' . nl2br( esc_html( $p ) ) . '</p>';
                    }
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $career_btn_text ) ) : ?>
            <div class="career-btn-wrap">
                <a href="<?php echo esc_url( $about_url ); ?>" class="btn-more-about-us"><?php echo esc_html( $career_btn_text ); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>