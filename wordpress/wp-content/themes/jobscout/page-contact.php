<?php
/**
 * Template Name: Contact Page Template
 *
 * @package JobScout
 */

get_header();

// Fetch dynamic settings from Customizer
$banner_bg            = get_theme_mod( 'contact_banner_image', get_template_directory_uri() . '/images/contact-banner-kimono.jpg' );
$banner_title         = get_theme_mod( 'contact_banner_title', 'CONTACT US' );

$hq_title             = get_theme_mod( 'contact_hq_title', 'Our Headquarters Address' );
$hq_address           = get_theme_mod( 'contact_hq_address', '60 Nguyen Van Thu, Ward Da Kao, District 1, Ho Chi Minh City, Viet Nam' );

$emp_heading          = get_theme_mod( 'contact_employers_heading', 'For Employers' );
$emp_subtext          = get_theme_mod( 'contact_employers_subtext', 'Call our Sales Hotline' );
$hcm_label            = get_theme_mod( 'contact_hcm_label', 'Ho Chi Minh' );
$hcm_phone            = get_theme_mod( 'contact_hcm_phone', '+84 28 3911 2000' );
$hn_label             = get_theme_mod( 'contact_hn_label', 'Ha Noi' );
$hn_phone             = get_theme_mod( 'contact_hn_phone', '+84 24 3936 8888' );
$emp_note             = get_theme_mod( 'contact_employers_note', "Request a call from one of our\nCustomer Love Account Managers\nWe're ready to help you grow!" );

$seek_heading         = get_theme_mod( 'contact_jobseekers_heading', 'For Jobseekers' );
$fb_text              = get_theme_mod( 'contact_fb_text', 'Ask a question on our' );
$fb_url               = get_theme_mod( 'contact_fb_url', 'https://facebook.com' );
$blog_text            = get_theme_mod( 'contact_blog_text', 'Read our blog posts on interview and CV tips' );
$seek_phone_label     = get_theme_mod( 'contact_seeker_phone_label', 'Call us at' );
$seek_phone           = get_theme_mod( 'contact_seeker_phone', '+84 28 3822 1234' );
$posts_page_id        = get_option( 'page_for_posts' );
$blog_url             = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );

// Clean phone numbers for tel: link
$hcm_phone_clean  = preg_replace( '/[^0-9\+]/', '', $hcm_phone );
$hn_phone_clean   = preg_replace( '/[^0-9\+]/', '', $hn_phone );
$seek_phone_clean = preg_replace( '/[^0-9\+]/', '', $seek_phone );
?>

<div class="custom-contact-page">

    <!-- KHỐI 1: HERO BANNER -->
    <section class="contact-hero-banner" style="background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)), url('<?php echo esc_url( $banner_bg ); ?>');">
        <div class="contact-banner-container">
            <h1 class="contact-banner-title"><?php echo esc_html( $banner_title ); ?></h1>
        </div>
    </section>

    <!-- KHỐI 2: ĐỊA CHỈ TRỤ SỞ (NỀN TRẮNG) -->
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

    <!-- KHỐI 3: HAI CỘT LIÊN HỆ (NỀN XÁM NHẠT) -->
    <section class="contact-two-columns-section">
        <div class="contact-container">
            <div class="contact-columns-grid">

                <!-- Cột 1: For Employers -->
                <div class="contact-col-item contact-col-employers">
                    <?php if ( ! empty( $emp_heading ) ) : ?>
                        <h3 class="contact-col-heading"><?php echo esc_html( $emp_heading ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $emp_subtext ) ) : ?>
                        <p class="contact-col-subtext"><?php echo esc_html( $emp_subtext ); ?></p>
                    <?php endif; ?>

                    <!-- Ho Chi Minh -->
                    <?php if ( ! empty( $hcm_phone ) ) : ?>
                    <div class="contact-phone-group">
                        <h4 class="contact-city-label"><?php echo esc_html( $hcm_label ); ?></h4>
                        <div class="contact-phone-pill">
                            <a href="tel:<?php echo esc_attr( $hcm_phone_clean ); ?>"><?php echo esc_html( $hcm_phone ); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Ha Noi -->
                    <?php if ( ! empty( $hn_phone ) ) : ?>
                    <div class="contact-phone-group">
                        <h4 class="contact-city-label"><?php echo esc_html( $hn_label ); ?></h4>
                        <div class="contact-phone-pill">
                            <a href="tel:<?php echo esc_attr( $hn_phone_clean ); ?>"><?php echo esc_html( $hn_phone ); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $emp_note ) ) : ?>
                    <div class="contact-note-box">
                        <?php echo nl2br( esc_html( $emp_note ) ); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Cột 2: For Jobseekers -->
                <div class="contact-col-item contact-col-jobseekers">
                    <?php if ( ! empty( $seek_heading ) ) : ?>
                        <h3 class="contact-col-heading"><?php echo esc_html( $seek_heading ); ?></h3>
                    <?php endif; ?>

                    <div class="contact-links-group">
                        <?php if ( ! empty( $fb_text ) ) : ?>
                        <p class="contact-sub-item">
                            <?php echo esc_html( $fb_text ); ?> <a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener" class="contact-highlight-link">Facebook</a>
                        </p>
                        <?php endif; ?>

                        <?php if ( ! empty( $blog_text ) ) : ?>
                        <p class="contact-sub-item">
                            <a href="<?php echo esc_url( $blog_url ); ?>" class="contact-highlight-link"><?php echo esc_html( $blog_text ); ?></a>
                        </p>
                        <?php endif; ?>
                    </div>

                    <!-- Seeker Phone -->
                    <?php if ( ! empty( $seek_phone ) ) : ?>
                    <div class="contact-phone-group call-us-group">
                        <h4 class="contact-city-label"><?php echo esc_html( $seek_phone_label ); ?></h4>
                        <div class="contact-phone-pill">
                            <a href="tel:<?php echo esc_attr( $seek_phone_clean ); ?>"><?php echo esc_html( $seek_phone ); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

</div>


<?php
get_footer();
