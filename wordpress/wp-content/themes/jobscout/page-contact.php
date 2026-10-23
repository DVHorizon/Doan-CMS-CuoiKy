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

    <!-- KHỐI 4: FORM LIÊN HỆ CONTACT FORM 7 -->
    <section class="contact-form-section">
        <div class="contact-container">
            <div class="contact-form-header">
                <h2 class="contact-form-title">GỬI TIN NHẮN CHO CHÚNG TÔI</h2>
                <p class="contact-form-subtitle">Chúng tôi sẽ phản hồi yêu cầu và thắc mắc của bạn trong vòng 24 giờ làm việc.</p>
            </div>
            <div class="contact-cf7-box">
                <?php 
                $cf7_shortcode = get_theme_mod( 'contact_cf7_shortcode', '[contact-form-7 id="1120" title="Contact Page Form"]' );
                echo do_shortcode( $cf7_shortcode ); 
                ?>
            </div>
        </div>
    </section>

</div>

<style>
/* CSS Tùy biến Khối Form Liên Hệ */
.contact-form-section {
    padding: 60px 0 80px;
    background-color: #ffffff;
    border-top: 1px solid #eef2f6;
}
.contact-form-section .contact-container {
    max-width: 820px;
    margin: 0 auto;
    padding: 0 20px;
}
.contact-form-header {
    text-align: center;
    margin-bottom: 35px;
}
.contact-form-title {
    font-size: 26px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
    letter-spacing: 0.5px;
}
.contact-form-subtitle {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    margin: 0;
}
.contact-cf7-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}
.contact-cf7-box .contact-form-wrapper p {
    margin-bottom: 20px;
}
.contact-cf7-box label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 6px;
}
.contact-cf7-box .cf7-input,
.contact-cf7-box .wpcf7-text,
.contact-cf7-box .wpcf7-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #cbd5e1;
    border-radius: 6px;
    font-size: 15px;
    color: #1e293b;
    background: #ffffff;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    box-sizing: border-box;
}
.contact-cf7-box .cf7-input:focus,
.contact-cf7-box .wpcf7-text:focus,
.contact-cf7-box .wpcf7-textarea:focus {
    border-color: #ea6a1b;
    outline: none;
    box-shadow: 0 0 0 3px rgba(234, 106, 27, 0.15);
}
.contact-cf7-box .cf7-textarea,
.contact-cf7-box .wpcf7-textarea {
    min-height: 140px;
    resize: vertical;
}
.contact-cf7-box .cf7-submit-btn,
.contact-cf7-box input[type="submit"] {
    background: #ea6a1b;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 14px 40px;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: background-color 0.25s ease, transform 0.15s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 14px rgba(234, 106, 27, 0.3);
    display: inline-block;
    width: 100%;
}
.contact-cf7-box .cf7-submit-btn:hover,
.contact-cf7-box input[type="submit"]:hover {
    background: #d45a11;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(234, 106, 27, 0.35);
}
.contact-cf7-box .wpcf7-response-output {
    margin: 20px 0 0 !important;
    padding: 14px 18px !important;
    border-radius: 6px !important;
    font-size: 14.5px !important;
}
@media (max-width: 640px) {
    .contact-cf7-box {
        padding: 24px 18px;
    }
}
</style>

<?php
get_footer();
