<?php
/**
 * Template Name: Contact Page Template
 *
 * @package JobScout
 */

get_header();

$banner_bg     = get_template_directory_uri() . '/images/contact-banner-kimono.jpg';
$posts_page_id = get_option( 'page_for_posts' );
$blog_url      = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
?>

<div class="custom-contact-page">

    <!-- KHỐI 1: HERO BANNER -->
    <section class="contact-hero-banner" style="background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)), url('<?php echo esc_url( $banner_bg ); ?>');">
        <div class="contact-banner-container">
            <h1 class="contact-banner-title">CONTACT US</h1>
        </div>
    </section>

    <!-- KHỐI 2: ĐỊA CHỈ TRỤ SỞ (NỀN TRẮNG) -->
    <section class="contact-headquarters-section">
        <div class="contact-container">
            <h2 class="contact-hq-title">Our Headquarters Address</h2>
            <p class="contact-hq-address">60 Nguyen Van Thu, Ward Da Kao, District 1, Ho Chi Minh City, Viet Nam</p>
        </div>
    </section>

    <!-- KHỐI 3: HAI CỘT LIÊN HỆ (NỀN XÁM NHẠT) -->
    <section class="contact-two-columns-section">
        <div class="contact-container">
            <div class="contact-columns-grid">

                <!-- Cột 1: For Employers -->
                <div class="contact-col-item contact-col-employers">
                    <h3 class="contact-col-heading">For Employers</h3>
                    <p class="contact-col-subtext">Call our Sales Hotline</p>

                    <!-- Ho Chi Minh -->
                    <div class="contact-phone-group">
                        <h4 class="contact-city-label">Ho Chi Minh</h4>
                        <div class="contact-phone-pill">
                            <a href="tel:+842839112000">+84 28 3911 2000</a>
                        </div>
                    </div>

                    <!-- Ha Noi -->
                    <div class="contact-phone-group">
                        <h4 class="contact-city-label">Ha Noi</h4>
                        <div class="contact-phone-pill">
                            <a href="tel:+842439368888">+84 24 3936 8888</a>
                        </div>
                    </div>

                    <div class="contact-note-box">
                        <p>Request a call from one of our</p>
                        <p>Customer Love Account Managers</p>
                        <p>We're ready to help you grow!</p>
                    </div>
                </div>

                <!-- Cột 2: For Jobseekers -->
                <div class="contact-col-item contact-col-jobseekers">
                    <h3 class="contact-col-heading">For Jobseekers</h3>

                    <div class="contact-links-group">
                        <p class="contact-sub-item">
                            Ask a question on our <a href="https://facebook.com" target="_blank" rel="noopener" class="contact-highlight-link">Facebook</a> page
                        </p>
                        <p class="contact-sub-item">
                            Read our <a href="<?php echo esc_url( $blog_url ); ?>" class="contact-highlight-link">blog posts</a> on interview and CV tips
                        </p>
                    </div>

                    <!-- Call us at -->
                    <div class="contact-phone-group call-us-group">
                        <h4 class="contact-city-label">Call us at</h4>
                        <div class="contact-phone-pill">
                            <a href="tel:+842838221234">+84 28 3822 1234</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<?php
get_footer();
