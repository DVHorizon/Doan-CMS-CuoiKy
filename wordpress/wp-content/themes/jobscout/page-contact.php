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

$form_title           = get_theme_mod( 'contact_form_title', 'GỬI TIN NHẮN CHO CHÚNG TÔI' );
$form_subtitle        = get_theme_mod( 'contact_form_subtitle', 'Chúng tôi sẽ phản hồi yêu cầu và thắc mắc của bạn trong vòng 24 giờ làm việc.' );
$cf7_shortcode        = get_theme_mod( 'contact_cf7_shortcode', '[contact-form-7 id="1120" title="Contact Page Form"]' );

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

    <!-- KHỐI 4: FORM LIÊN HỆ CONTACT FORM 7 -->
    <section class="contact-form-section">
        <div class="contact-container">
            <div class="contact-form-header">
                <?php if ( ! empty( $form_title ) ) : ?>
                    <h2 class="contact-form-title"><?php echo esc_html( $form_title ); ?></h2>
                <?php endif; ?>
                <?php if ( ! empty( $form_subtitle ) ) : ?>
                    <p class="contact-form-subtitle"><?php echo nl2br( esc_html( $form_subtitle ) ); ?></p>
                <?php endif; ?>
            </div>
            <div class="contact-cf7-box">
                <?php 
                if ( ! empty( $cf7_shortcode ) ) {
                    echo do_shortcode( $cf7_shortcode ); 
                }
                ?>
            </div>
        </div>
    </section>

</div>

<!-- MODAL POPUP THÔNG BÁO CF7 -->
<div id="cf7-status-modal" class="cf7-modal-overlay" style="display: none;" aria-hidden="true" role="dialog">
    <div class="cf7-modal-card">
        <button type="button" class="cf7-modal-close-btn" aria-label="Đóng popup">&times;</button>
        <div class="cf7-modal-icon-wrap" id="cf7-modal-icon"></div>
        <h3 class="cf7-modal-title" id="cf7-modal-title">Gửi Tin Nhắn Thành Công!</h3>
        <p class="cf7-modal-message" id="cf7-modal-message">Cảm ơn bạn đã liên hệ với chúng tôi! Chúng tôi sẽ phản hồi yêu cầu của bạn trong vòng 24 giờ làm việc.</p>
        <div class="cf7-modal-action">
            <button type="button" class="cf7-modal-ok-btn" id="cf7-modal-ok-btn">OK, ĐÃ HIỂU</button>
        </div>
    </div>
</div>

<style>
/* ===================================================
   KHỐI FORM LIÊN HỆ - CONTACT FORM 7 STYLING
   =================================================== */
.contact-form-section {
    padding: 70px 0 90px;
    background-color: #f8fafc;
    border-top: 1px solid #e2e8f0;
}
.contact-form-section .contact-container {
    max-width: 860px;
    margin: 0 auto;
    padding: 0 20px;
}
.contact-form-header {
    text-align: center;
    margin-bottom: 35px;
}
.contact-form-title {
    font-size: 28px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px;
    letter-spacing: -0.5px;
    text-transform: uppercase;
}
.contact-form-subtitle {
    color: #64748b;
    font-size: 15.5px;
    line-height: 1.6;
    margin: 0;
    max-width: 620px;
    margin-left: auto;
    margin-right: auto;
}

/* Box Form chính */
.contact-cf7-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 45px 50px;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 20px 25px -5px rgba(0, 0, 0, 0.02);
}

/* Grid & Trường nhập liệu */
.contact-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}
.cf-field-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    position: relative;
}
.cf-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
    letter-spacing: 0.1px;
}
.cf-required {
    color: #ef4444;
    font-weight: 700;
    margin-left: 2px;
}

/* Reset thẻ p và br tạo tự động của CF7 */
.contact-cf7-box br {
    display: none;
}
.contact-cf7-box form > p,
.contact-cf7-box .contact-form-grid > p,
.contact-cf7-box .cf-field-group > p,
.contact-cf7-box .cf-submit-wrap > p,
.contact-cf7-box p {
    margin: 0;
    padding: 0;
    width: 100%;
}
.contact-cf7-box .wpcf7-form-control-wrap {
    display: block;
    width: 100%;
}

/* Inputs & Textarea */
.contact-cf7-box .cf-input,
.contact-cf7-box .cf-textarea,
.contact-cf7-box input[type="text"],
.contact-cf7-box input[type="email"],
.contact-cf7-box textarea {
    width: 100%;
    padding: 13px 18px;
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14.5px;
    font-family: inherit;
    color: #0f172a;
    background-color: #f8fafc;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-sizing: border-box;
    display: block;
}
.contact-cf7-box .cf-input::placeholder,
.contact-cf7-box .cf-textarea::placeholder,
.contact-cf7-box input::placeholder,
.contact-cf7-box textarea::placeholder {
    color: #94a3b8;
    font-size: 14px;
}
.contact-cf7-box .cf-input:focus,
.contact-cf7-box .cf-textarea:focus,
.contact-cf7-box input[type="text"]:focus,
.contact-cf7-box input[type="email"]:focus,
.contact-cf7-box textarea:focus {
    background-color: #ffffff;
    border-color: #ea6a1b;
    outline: none;
    box-shadow: 0 0 0 4px rgba(234, 106, 27, 0.14);
}
.contact-cf7-box .cf-textarea,
.contact-cf7-box textarea {
    min-height: 140px;
    resize: vertical;
    line-height: 1.6;
}

/* Nút Submit */
.cf-submit-wrap {
    margin-top: 28px;
    text-align: center;
}
.contact-cf7-box .cf-submit-btn,
.contact-cf7-box input[type="submit"] {
    background: linear-gradient(135deg, #ea6a1b 0%, #ff7b29 100%);
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 15px 45px;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(234, 106, 27, 0.35);
    transition: all 0.25s ease;
    display: inline-block;
    min-width: 220px;
}
.contact-cf7-box .cf-submit-btn:hover,
.contact-cf7-box input[type="submit"]:hover {
    background: linear-gradient(135deg, #d45a11 0%, #ea6a1b 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(234, 106, 27, 0.45);
}
.contact-cf7-box .cf-submit-btn:active,
.contact-cf7-box input[type="submit"]:active {
    transform: translateY(0);
    box-shadow: 0 3px 8px rgba(234, 106, 27, 0.3);
}

/* Validation Feedback (Inline) */
.contact-cf7-box .wpcf7-not-valid-tip {
    font-size: 13px;
    color: #ef4444;
    margin-top: 6px;
    font-weight: 500;
    display: block;
}
.contact-cf7-box .wpcf7-not-valid {
    border-color: #ef4444 !important;
    background-color: #fffbfa !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
}

/* Ẩn thông báo mặc định ở đáy form vì đã dùng Modal Popup */
.contact-cf7-box .wpcf7-response-output {
    display: none !important;
}

.contact-cf7-box .wpcf7-spinner {
    margin: 0 0 0 12px !important;
    vertical-align: middle;
}

/* ===================================================
   MODAL POPUP THÔNG BÁO CF7
   =================================================== */
.cf7-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 999999;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.28s ease, visibility 0.28s ease;
    box-sizing: border-box;
}

.cf7-modal-overlay.active {
    opacity: 1;
    visibility: visible;
}

.cf7-modal-card {
    background: #ffffff;
    border-radius: 20px;
    max-width: 480px;
    width: 100%;
    padding: 40px 32px 35px;
    text-align: center;
    position: relative;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    transform: scale(0.9) translateY(20px);
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-sizing: border-box;
}

.cf7-modal-overlay.active .cf7-modal-card {
    transform: scale(1) translateY(0);
}

.cf7-modal-close-btn {
    position: absolute;
    top: 16px;
    right: 18px;
    background: #f1f5f9;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    font-size: 24px;
    line-height: 1;
    color: #64748b;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.cf7-modal-close-btn:hover {
    background: #e2e8f0;
    color: #0f172a;
}

.cf7-modal-icon-wrap {
    width: 76px;
    height: 76px;
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cf7-modal-icon-wrap.cf7-icon-success {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    border: 3px solid #10b981;
    box-shadow: 0 0 24px rgba(16, 185, 129, 0.25);
}

.cf7-modal-icon-wrap.cf7-icon-error {
    background: #fef2f2;
    border: 3px solid #ef4444;
    box-shadow: 0 0 24px rgba(239, 68, 68, 0.25);
}

.cf7-modal-title {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 12px;
    letter-spacing: -0.3px;
}

.cf7-modal-message {
    font-size: 15px;
    color: #475569;
    line-height: 1.6;
    margin: 0 0 28px;
}

.cf7-modal-ok-btn {
    background: linear-gradient(135deg, #ea6a1b 0%, #ff7b29 100%);
    color: #ffffff;
    font-weight: 700;
    font-size: 15px;
    letter-spacing: 0.5px;
    padding: 14px 36px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(234, 106, 27, 0.35);
    display: inline-block;
    width: 100%;
}

.cf7-modal-ok-btn:hover {
    background: linear-gradient(135deg, #d45a11 0%, #ea6a1b 100%);
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(234, 106, 27, 0.45);
}

/* Responsive Mobile */
@media (max-width: 768px) {
    .contact-form-grid {
        grid-template-columns: 1fr;
        gap: 0;
    }
    .contact-cf7-box {
        padding: 30px 20px;
        border-radius: 12px;
    }
    .contact-cf7-box .cf-submit-btn,
    .contact-cf7-box input[type="submit"] {
        width: 100%;
    }
    .cf7-modal-card {
        padding: 32px 20px 28px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('cf7-status-modal');
    if (!modal) return;
    
    var titleEl = document.getElementById('cf7-modal-title');
    var msgEl = document.getElementById('cf7-modal-message');
    var iconEl = document.getElementById('cf7-modal-icon');
    var closeBtn = modal.querySelector('.cf7-modal-close-btn');
    var okBtn = document.getElementById('cf7-modal-ok-btn');

    function openModal(isSuccess, title, message) {
        if (titleEl) titleEl.textContent = title;
        if (msgEl) msgEl.textContent = message;

        if (iconEl) {
            if (isSuccess) {
                iconEl.className = 'cf7-modal-icon-wrap cf7-icon-success';
                iconEl.innerHTML = '<svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
            } else {
                iconEl.className = 'cf7-modal-icon-wrap cf7-icon-error';
                iconEl.innerHTML = '<svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
            }
        }

        modal.style.display = 'flex';
        // Trigger transition
        setTimeout(function() {
            modal.classList.add('active');
        }, 10);
    }

    function closeModal() {
        modal.classList.remove('active');
        setTimeout(function() {
            modal.style.display = 'none';
        }, 300);
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (okBtn) okBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });

    // Bắt sự kiện gửi thành công từ Contact Form 7
    document.addEventListener('wpcf7mailsent', function(e) {
        var successMsg = (e.detail && e.detail.apiResponse && e.detail.apiResponse.message)
            ? e.detail.apiResponse.message
            : 'Cảm ơn bạn đã gửi tin nhắn. Yêu cầu của bạn đã được tiếp nhận thành công!';
        
        openModal(true, 'Gửi Tin Nhắn Thành Công!', successMsg);
    }, false);

    // Bắt sự kiện lỗi khi gửi thư (nếu có lỗi hệ thống mail)
    document.addEventListener('wpcf7mailfailed', function(e) {
        var errorMsg = (e.detail && e.detail.apiResponse && e.detail.apiResponse.message)
            ? e.detail.apiResponse.message
            : 'Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại sau.';
        
        openModal(false, 'Gửi Thất Bại!', errorMsg);
    }, false);
});
</script>

<?php
get_footer();
