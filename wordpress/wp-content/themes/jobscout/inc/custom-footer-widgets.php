<?php
/**
 * Custom Footer Widgets for JobScout:
 * 1. Newsletter Subscription Widget
 * 2. Centered Brand & Social Footer Widget
 * 
 * @package JobScout
 */

/**
 * Register Custom Sidebars for Footer
 */
function jobscout_custom_footer_sidebars_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Newsletter Area', 'jobscout' ),
        'id'            => 'footer-newsletter',
        'description'   => __( 'Khu vực hiển thị dải Newsletter full-width màu cam ngay phía trên Footer.', 'jobscout' ),
        'before_widget' => '<div id="%1$s" class="widget custom-footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="newsletter-widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Main Centered', 'jobscout' ),
        'id'            => 'footer-centered',
        'description'   => __( 'Khu vực chân trang căn giữa theo phong cách Plan Do See (Logo, Navigation Menu, Social Icons tròn).', 'jobscout' ),
        'before_widget' => '<div id="%1$s" class="widget footer-centered-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-centered-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'jobscout_custom_footer_sidebars_init', 15 );

/**
 * 1. Widget Newsletter Box
 */
class JobScout_Newsletter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'jobscout_newsletter_widget',
            __( '[JobScout] Newsletter Box', 'jobscout' ),
            array( 'description' => __( 'Khối đăng ký nhận tin (Subscribe to Our Newsletter) màu cam chuẩn theo mẫu.', 'jobscout' ) )
        );
    }

    public function widget( $args, $instance ) {
        $title         = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Subscribe To Our Newsletter', 'jobscout' );
        $placeholder   = ! empty( $instance['placeholder'] ) ? $instance['placeholder'] : __( 'Input your email address', 'jobscout' );
        $btn_text      = ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : __( 'SUBSCRIBE', 'jobscout' );
        $action_url    = ! empty( $instance['action_url'] ) ? esc_url( $instance['action_url'] ) : '#';
        $cf7_shortcode = ! empty( $instance['cf7_shortcode'] ) ? trim( $instance['cf7_shortcode'] ) : '[contact-form-7 id="26f0931" title="Newsletter Footer"]';

        echo $args['before_widget'];
        ?>
        <style>
            .jos-footer-newsletter-section {
                padding: 0 !important;
                margin: 0 !important;
                background-color: #ea6b1d !important;
                width: 100% !important;
            }
            .jos-footer-newsletter-section .widget,
            .jos-footer-newsletter-section .custom-footer-widget {
                margin: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }
            .jos-newsletter-bar {
                background-color: #ea6b1d !important;
                padding: 16px 20px !important;
                width: 100% !important;
                margin: 0 !important;
                box-sizing: border-box !important;
                border-radius: 0 !important;
            }
            .jos-newsletter-inner {
                max-width: 1140px !important;
                margin: 0 auto !important;
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 36px !important;
                box-sizing: border-box !important;
            }
            .jos-newsletter-left {
                flex: 0 0 auto !important;
            }
            .jos-newsletter-heading {
                display: flex !important;
                flex-direction: column !important;
                font-size: 21px !important;
                font-weight: 700 !important;
                color: #ffffff !important;
                line-height: 1.25 !important;
                letter-spacing: -0.2px !important;
                margin: 0 !important;
            }
            .jos-newsletter-heading span {
                color: #ffffff !important;
            }
            .jos-newsletter-right {
                flex: 1 !important;
                max-width: 650px !important;
            }
            .jos-newsletter-form {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 15px !important;
                width: 100% !important;
                margin: 0 !important;
            }
            .jos-newsletter-input-box {
                flex: 1 !important;
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                background-color: #ffffff !important;
                border-radius: 2px !important;
                padding: 0 14px !important;
                height: 44px !important;
                box-sizing: border-box !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
                position: relative !important;
            }
            .jos-newsletter-icon {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                margin-right: 10px !important;
                flex-shrink: 0 !important;
                line-height: 1 !important;
            }
            .jos-newsletter-input {
                width: 100% !important;
                height: 100% !important;
                border: none !important;
                outline: none !important;
                background: transparent !important;
                color: #333333 !important;
                font-size: 13.5px !important;
                padding: 0 !important;
                box-shadow: none !important;
                margin: 0 !important;
            }
            .jos-newsletter-input::placeholder {
                color: #999999 !important;
                font-size: 13.5px !important;
            }
            .jos-newsletter-btn {
                flex: 0 0 auto !important;
                height: 44px !important;
                background-color: #ea6b1d !important;
                border: 1px solid rgba(255, 255, 255, 0.8) !important;
                color: #ffffff !important;
                font-size: 13px !important;
                font-weight: 700 !important;
                letter-spacing: 0.5px !important;
                text-transform: uppercase !important;
                padding: 0 24px !important;
                border-radius: 2px !important;
                cursor: pointer !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                transition: all 0.25s ease !important;
                white-space: nowrap !important;
                box-shadow: none !important;
            }
            .jos-newsletter-btn:hover {
                background-color: #ffffff !important;
                color: #ea6b1d !important;
                border-color: #ffffff !important;
            }

            /* Styling khi nhúng Contact Form 7 vào Footer Newsletter */
            .jos-newsletter-right .wpcf7 {
                width: 100% !important;
            }
            .jos-newsletter-right .wpcf7 form {
                margin: 0 !important;
                width: 100% !important;
            }
            .jos-newsletter-right .wpcf7 p {
                margin: 0 !important;
                padding: 0 !important;
                display: contents !important;
            }
            .jos-newsletter-right .wpcf7 br {
                display: none !important;
            }
            .jos-newsletter-right .cf7-newsletter-wrap {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 15px !important;
                width: 100% !important;
            }
            .jos-newsletter-right .cf7-input-box {
                flex: 1 !important;
                position: relative !important;
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                background: #ffffff !important;
                border-radius: 2px !important;
                height: 44px !important;
                min-height: 44px !important;
                max-height: 44px !important;
                box-sizing: border-box !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
                overflow: hidden !important;
            }
            .jos-newsletter-right .cf7-input-box .jos-newsletter-icon {
                position: absolute !important;
                left: 14px !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                z-index: 2 !important;
                pointer-events: none !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 22px !important;
                height: 18px !important;
                line-height: 1 !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .jos-newsletter-right .wpcf7-form-control-wrap {
                flex: 1 !important;
                display: flex !important;
                align-items: center !important;
                width: 100% !important;
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .jos-newsletter-right .cf7-input-box input[type="email"] {
                width: 100% !important;
                height: 44px !important;
                min-height: 44px !important;
                max-height: 44px !important;
                line-height: normal !important;
                padding: 0 14px 0 46px !important;
                border: none !important;
                outline: none !important;
                background: transparent !important;
                font-size: 13.5px !important;
                font-family: inherit !important;
                color: #333333 !important;
                box-shadow: none !important;
                margin: 0 !important;
                box-sizing: border-box !important;
                display: block !important;
            }
            .jos-newsletter-right .cf7-input-box input[type="email"]::placeholder {
                color: #888888 !important;
                font-size: 13.5px !important;
                line-height: normal !important;
                opacity: 1 !important;
            }
            .jos-newsletter-right input[type="submit"] {
                flex: 0 0 auto !important;
                height: 44px !important;
                background-color: #ea6b1d !important;
                border: 1px solid rgba(255, 255, 255, 0.8) !important;
                color: #ffffff !important;
                font-size: 13px !important;
                font-weight: 700 !important;
                letter-spacing: 0.5px !important;
                text-transform: uppercase !important;
                padding: 0 24px !important;
                border-radius: 2px !important;
                cursor: pointer !important;
                transition: all 0.25s ease !important;
                white-space: nowrap !important;
                box-shadow: none !important;
            }
            .jos-newsletter-right input[type="submit"]:hover {
                background-color: #ffffff !important;
                color: #ea6b1d !important;
                border-color: #ffffff !important;
            }
            /* Trạng thái khi đang gửi thư */
            .jos-newsletter-right form.submitting input[type="submit"] {
                opacity: 0.7 !important;
                cursor: not-allowed !important;
                background-color: #d15a13 !important;
            }
            /* Ẩn hoàn toàn thông báo mặc định của CF7 trong newsletter để KHÔNG vỡ layout */
            .jos-newsletter-right .wpcf7-response-output,
            .jos-newsletter-right .wpcf7-not-valid-tip {
                display: none !important;
            }
            .jos-newsletter-right .wpcf7-spinner {
                display: none !important;
            }

            /* Modal Popup Thông báo Đăng ký */
            .jos-nl-modal-overlay {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                background: rgba(0, 0, 0, 0.55) !important;
                backdrop-filter: blur(3px) !important;
                -webkit-backdrop-filter: blur(3px) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                z-index: 999999 !important;
                opacity: 0 !important;
                visibility: hidden !important;
                transition: opacity 0.25s ease, visibility 0.25s ease !important;
                padding: 16px !important;
                box-sizing: border-box !important;
            }
            .jos-nl-modal-overlay.active {
                opacity: 1 !important;
                visibility: visible !important;
            }
            .jos-nl-modal-box {
                background: #ffffff !important;
                width: 100% !important;
                max-width: 420px !important;
                border-radius: 12px !important;
                padding: 32px 24px 26px !important;
                box-sizing: border-box !important;
                text-align: center !important;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.22) !important;
                transform: scale(0.9) translateY(10px) !important;
                transition: transform 0.28s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
                position: relative !important;
            }
            .jos-nl-modal-overlay.active .jos-nl-modal-box {
                transform: scale(1) translateY(0) !important;
            }
            .jos-nl-modal-close {
                position: absolute !important;
                top: 12px !important;
                right: 12px !important;
                background: #f1f1f1 !important;
                border: none !important;
                width: 32px !important;
                height: 32px !important;
                border-radius: 50% !important;
                font-size: 20px !important;
                line-height: 1 !important;
                color: #666666 !important;
                cursor: pointer !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                transition: background 0.2s, color 0.2s !important;
                padding: 0 !important;
            }
            .jos-nl-modal-close:hover {
                background: #e2e2e2 !important;
                color: #111111 !important;
            }
            .jos-nl-modal-icon {
                width: 64px !important;
                height: 64px !important;
                border-radius: 50% !important;
                margin: 0 auto 16px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            .jos-nl-modal-icon.success {
                background: #e8f5e9 !important;
                color: #2e7d32 !important;
            }
            .jos-nl-modal-icon.error {
                background: #ffebee !important;
                color: #d32f2f !important;
            }
            .jos-nl-modal-title {
                font-size: 20px !important;
                font-weight: 700 !important;
                margin: 0 0 10px !important;
                color: #222222 !important;
                line-height: 1.3 !important;
            }
            .jos-nl-modal-desc {
                font-size: 14.5px !important;
                color: #555555 !important;
                line-height: 1.5 !important;
                margin: 0 0 24px !important;
                padding: 0 6px !important;
            }
            .jos-nl-modal-btn {
                background: #ea6b1d !important;
                color: #ffffff !important;
                border: none !important;
                padding: 11px 32px !important;
                border-radius: 6px !important;
                font-size: 13.5px !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                cursor: pointer !important;
                transition: background 0.25s ease, transform 0.15s !important;
                min-width: 130px !important;
                box-shadow: 0 4px 12px rgba(234, 107, 29, 0.3) !important;
                outline: none !important;
            }
            .jos-nl-modal-btn:hover {
                background: #d15a13 !important;
                transform: translateY(-1px) !important;
            }

            @media (max-width: 860px) {
                .jos-newsletter-inner {
                    flex-direction: column !important;
                    align-items: flex-start !important;
                    gap: 18px !important;
                }
                .jos-newsletter-right {
                    width: 100% !important;
                    max-width: 100% !important;
                }
                .jos-newsletter-form,
                .jos-newsletter-right .cf7-newsletter-wrap {
                    flex-direction: column !important;
                    gap: 12px !important;
                }
                .jos-newsletter-input-box,
                .jos-newsletter-right .cf7-input-box {
                    width: 100% !important;
                }
                .jos-newsletter-btn,
                .jos-newsletter-right input[type="submit"] {
                    width: 100% !important;
                }
            }
        </style>
        <div class="jos-newsletter-bar">
            <div class="jos-newsletter-inner">
                <div class="jos-newsletter-left">
                    <div class="jos-newsletter-heading">
                        <?php 
                        $title_parts = explode( ' ', $title, 3 );
                        if ( count( $title_parts ) >= 3 ) {
                            echo '<span>' . esc_html( $title_parts[0] . ' ' . $title_parts[1] ) . '</span>';
                            echo '<span>' . esc_html( $title_parts[2] ) . '</span>';
                        } else {
                            echo '<span>' . esc_html( $title ) . '</span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="jos-newsletter-right">
                    <?php if ( ! empty( $cf7_shortcode ) ) : ?>
                        <?php echo do_shortcode( $cf7_shortcode ); ?>
                    <?php else : ?>
                        <form class="jos-newsletter-form" action="<?php echo esc_url( $action_url ); ?>" method="post" onsubmit="event.preventDefault(); openJosNewsletterModal('success', 'Đăng Ký Thành Công!', 'Cảm ơn bạn đã đăng ký nhận bản tin!');">
                            <div class="jos-newsletter-input-box">
                                <span class="jos-newsletter-icon">
                                    <svg width="22" height="18" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="1" y="1" width="22" height="18" rx="2" stroke="#e8631b" stroke-width="2"/>
                                        <path d="M2 3L12 11L22 3" stroke="#e8631b" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <input type="email" name="EMAIL" required placeholder="<?php echo esc_attr( $placeholder ); ?>" class="jos-newsletter-input" />
                            </div>
                            <button type="submit" class="jos-newsletter-btn"><?php echo esc_html( $btn_text ); ?></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Modal Popup Thông Báo Bản Tin -->
        <div id="josNewsletterModal" class="jos-nl-modal-overlay" role="dialog" aria-modal="true">
            <div class="jos-nl-modal-box">
                <button type="button" class="jos-nl-modal-close" onclick="closeJosNewsletterModal()" aria-label="Đóng">&times;</button>
                <div id="josNlModalIcon" class="jos-nl-modal-icon success">
                    <!-- SVG icon -->
                </div>
                <h3 id="josNlModalTitle" class="jos-nl-modal-title">Đăng Ký Thành Công!</h3>
                <p id="josNlModalDesc" class="jos-nl-modal-desc">Cảm ơn bạn đã đăng ký nhận bản tin việc làm.</p>
                <button type="button" class="jos-nl-modal-btn" onclick="closeJosNewsletterModal()">Đóng</button>
            </div>
        </div>

        <script>
        function openJosNewsletterModal(type, title, desc) {
            var modal = document.getElementById('josNewsletterModal');
            if (!modal) return;
            var iconBox = document.getElementById('josNlModalIcon');
            var titleEl = document.getElementById('josNlModalTitle');
            var descEl  = document.getElementById('josNlModalDesc');

            if (titleEl) titleEl.textContent = title;
            if (descEl) descEl.textContent = desc;

            if (iconBox) {
                if (type === 'success') {
                    iconBox.className = 'jos-nl-modal-icon success';
                    iconBox.innerHTML = '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
                } else {
                    iconBox.className = 'jos-nl-modal-icon error';
                    iconBox.innerHTML = '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
                }
            }

            modal.classList.add('active');
        }

        function closeJosNewsletterModal() {
            var modal = document.getElementById('josNewsletterModal');
            if (modal) modal.classList.remove('active');
        }

        // Đóng khi click vào nền mờ bên ngoài
        document.addEventListener('click', function(e) {
            var modal = document.getElementById('josNewsletterModal');
            if (modal && e.target === modal) {
                closeJosNewsletterModal();
            }
        });

        // Đóng khi bấm phím ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeJosNewsletterModal();
            }
        });

        // Quản lý trạng thái nút bấm khi submit CF7
        document.addEventListener('wpcf7beforesubmit', function(e) {
            var btn = e.target.querySelector('input[type="submit"]');
            if (btn) {
                btn.dataset.originalText = btn.value;
                btn.value = 'ĐANG GỬI...';
                btn.style.opacity = '0.7';
                btn.disabled = true;
            }
        }, false);

        // Bắt sự kiện hoàn thành gửi form của Contact Form 7
        document.addEventListener('wpcf7submit', function(e) {
            var form = e.target;
            var btn = form.querySelector('input[type="submit"]');
            if (btn && btn.dataset.originalText) {
                btn.value = btn.dataset.originalText;
                btn.style.opacity = '1';
                btn.disabled = false;
            }

            // Chỉ kích hoạt modal nếu form gửi đi thuộc khối Footer Newsletter
            if (!form.closest('.jos-newsletter-bar') && !form.closest('.jos-newsletter-right')) {
                return;
            }

            var status = e.detail ? e.detail.status : '';
            var apiMessage = (e.detail && e.detail.apiResponse && e.detail.apiResponse.message) 
                ? e.detail.apiResponse.message 
                : '';

            if (status === 'mail_sent') {
                openJosNewsletterModal(
                    'success',
                    'Đăng Ký Thành Công!',
                    apiMessage || 'Cảm ơn bạn đã đăng ký nhận bản tin việc làm từ Group B Recruiting.'
                );
                // Reset form sau khi gửi thành công
                if (typeof form.reset === 'function') {
                    form.reset();
                }
            } else {
                openJosNewsletterModal(
                    'error',
                    'Chưa Thể Đăng Ký',
                    apiMessage || 'Vui lòng kiểm tra lại địa chỉ email hoặc thử lại sau.'
                );
            }
        }, false);
        </script>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title         = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Subscribe To Our Newsletter', 'jobscout' );
        $placeholder   = ! empty( $instance['placeholder'] ) ? $instance['placeholder'] : __( 'Input your email address', 'jobscout' );
        $btn_text      = ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : __( 'SUBSCRIBE', 'jobscout' );
        $action_url    = ! empty( $instance['action_url'] ) ? $instance['action_url'] : '';
        $cf7_shortcode = ! empty( $instance['cf7_shortcode'] ) ? $instance['cf7_shortcode'] : '[contact-form-7 id="26f0931" title="Newsletter Footer"]';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Tiêu đề:', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cf7_shortcode' ) ); ?>"><strong><?php esc_html_e( 'Contact Form 7 Shortcode (Ưu tiên):', 'jobscout' ); ?></strong></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cf7_shortcode' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cf7_shortcode' ) ); ?>" type="text" placeholder='[contact-form-7 id="..."]' value="<?php echo esc_attr( $cf7_shortcode ); ?>">
            <small style="color: #666;"><?php esc_html_e( 'Nếu điền shortcode CF7 vào đây, widget sẽ chạy form của CF7 và gửi email tự động.', 'jobscout' ); ?></small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"><?php esc_html_e( 'Placeholder ô nhập email (Form mặc định):', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'placeholder' ) ); ?>" type="text" value="<?php echo esc_attr( $placeholder ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>"><?php esc_html_e( 'Chữ nút bấm (Form mặc định):', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'action_url' ) ); ?>"><?php esc_html_e( 'Action URL (Tùy chọn, vd Mailchimp):', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'action_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'action_url' ) ); ?>" type="text" value="<?php echo esc_attr( $action_url ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['placeholder']   = ( ! empty( $new_instance['placeholder'] ) ) ? sanitize_text_field( $new_instance['placeholder'] ) : '';
        $instance['btn_text']      = ( ! empty( $new_instance['btn_text'] ) ) ? sanitize_text_field( $new_instance['btn_text'] ) : '';
        $instance['action_url']    = ( ! empty( $new_instance['action_url'] ) ) ? esc_url_raw( $new_instance['action_url'] ) : '';
        $instance['cf7_shortcode'] = ( ! empty( $new_instance['cf7_shortcode'] ) ) ? wp_kses_post( $new_instance['cf7_shortcode'] ) : '';
        return $instance;
    }
}

/**
 * 2. Widget Brand, Menu & Social Links Centered
 */
class JobScout_Brand_Social_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'jobscout_brand_social_widget',
            __( '[JobScout] Brand & Social Footer', 'jobscout' ),
            array( 'description' => __( 'Hiển thị Logo/Brand, Menu liên kết ngang và các icon mạng xã hội tròn theo phong cách Plan Do See.', 'jobscout' ) )
        );
    }

    public function widget( $args, $instance ) {
        $brand_text  = ! empty( $instance['brand_text'] ) ? $instance['brand_text'] : get_bloginfo( 'name' );
        $logo_url    = ! empty( $instance['logo_url'] ) ? esc_url( $instance['logo_url'] ) : '';
        $menu_id     = ! empty( $instance['nav_menu'] ) ? (int) $instance['nav_menu'] : 0;
        $facebook    = ! empty( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '';
        $google      = ! empty( $instance['google'] ) ? esc_url( $instance['google'] ) : '';
        $line        = ! empty( $instance['line'] ) ? esc_url( $instance['line'] ) : '';
        $twitter     = ! empty( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '';

        echo $args['before_widget'];
        ?>
        <style>
            .jos-footer-centered-section {
                background-color: #f7f7f7 !important;
                padding: 24px 20px 20px !important;
                margin: 0 !important;
                text-align: center !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .jos-footer-centered-section .container {
                padding: 0 !important;
            }
            .jos-footer-centered-section .widget,
            .jos-footer-centered-section .footer-centered-widget {
                margin: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }
            .jos-brand-footer-wrap {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                max-width: 900px !important;
                margin: 0 auto !important;
                box-sizing: border-box !important;
            }
            .jos-brand-title-wrap {
                margin-bottom: 14px !important;
            }
            .jos-brand-link {
                text-decoration: none !important;
                display: inline-block !important;
            }
            .jos-brand-name {
                font-size: 22px !important;
                font-weight: 800 !important;
                color: #111111 !important;
                letter-spacing: -0.4px !important;
                display: inline-block !important;
                line-height: 1.2 !important;
            }
            .jos-footer-logo {
                max-height: 40px !important;
                width: auto !important;
                display: block !important;
                margin: 0 auto !important;
            }
            .jos-footer-nav-wrap {
                margin-bottom: 16px !important;
                width: 100% !important;
            }
            .jos-footer-menu {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 28px !important;
            }
            .jos-footer-menu li {
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                list-style: none !important;
            }
            .jos-footer-menu li a {
                font-size: 13.5px !important;
                font-weight: 700 !important;
                color: #222222 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.6px !important;
                text-decoration: none !important;
                transition: color 0.2s ease !important;
            }
            .jos-footer-menu li a:hover {
                color: #ea6b1d !important;
            }
            .jos-social-icons-wrap {
                margin-top: 4px !important;
            }
            .jos-social-list {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 16px !important;
            }
            .jos-social-list li {
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                list-style: none !important;
            }
            .jos-social-btn {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 44px !important;
                height: 44px !important;
                border-radius: 50% !important;
                color: #ffffff !important;
                text-decoration: none !important;
                transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease !important;
                box-shadow: 0 2px 6px rgba(0,0,0,0.12) !important;
            }
            .jos-social-btn:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 10px rgba(0,0,0,0.2) !important;
                opacity: 0.95 !important;
            }
            .jos-social-facebook {
                background-color: #4a6ea9 !important;
            }
            .jos-social-google {
                background-color: #ffffff !important;
                border: 1px solid #ebebeb !important;
            }
            .jos-social-line {
                background-color: #00c300 !important;
            }
            .jos-social-twitter {
                background-color: #4da7de !important;
            }
        </style>
        <div class="jos-brand-footer-wrap">
            <!-- Brand / Logo -->
            <div class="jos-brand-title-wrap">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="jos-brand-link">
                    <?php if ( $logo_url ) : ?>
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $brand_text ); ?>" class="jos-footer-logo" />
                    <?php else : ?>
                        <span class="jos-brand-name"><?php echo esc_html( $brand_text ); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Footer Menu Links -->
            <div class="jos-footer-nav-wrap">
                <?php
                if ( $menu_id && wp_get_nav_menu_object( $menu_id ) ) {
                    wp_nav_menu( array(
                        'menu'            => $menu_id,
                        'container'       => 'nav',
                        'container_class' => 'jos-footer-navigation',
                        'menu_class'      => 'jos-footer-menu',
                        'depth'           => 1,
                    ) );
                } else {
                    ?>
                    <nav class="jos-footer-navigation">
                        <ul class="jos-footer-menu">
                            <li><a href="<?php echo esc_url( home_url( '/jobs/' ) ); ?>">JOBS</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">COMPANIES</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">BLOG</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">ABOUT</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">CONTACT</a></li>
                        </ul>
                    </nav>
                    <?php
                }
                ?>
            </div>

            <!-- Social Media Icons (Rounded) -->
            <div class="jos-social-icons-wrap">
                <ul class="jos-social-list">
                    <?php if ( $facebook ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" class="jos-social-btn jos-social-facebook" title="Facebook">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( $google ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $google ); ?>" target="_blank" rel="noopener noreferrer" class="jos-social-btn jos-social-google" title="Google">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.24 10.285v3.608h6.887c-.287 1.866-2.176 5.467-6.887 5.467-4.144 0-7.525-3.435-7.525-7.66s3.381-7.66 7.525-7.66c2.358 0 3.935.998 4.836 1.863l2.852-2.756c-1.83-1.716-4.2-2.744-7.688-2.744-6.354 0-11.5 5.146-11.5 11.5s5.146 11.5 11.5 11.5c6.642 0 11.042-4.667 11.042-11.238 0-.756-.08-1.325-.18-1.888h-10.863z"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( $line ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $line ); ?>" target="_blank" rel="noopener noreferrer" class="jos-social-btn jos-social-line" title="LINE">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.066.51.25l2.457 3.328V8.108c0-.345.279-.63.63-.63.348 0 .62.285.62.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.347 0-.63-.285-.63-.629V8.108c0-.345.283-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( $twitter ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" class="jos-social-btn jos-social-twitter" title="Twitter / X">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.18 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $brand_text  = ! empty( $instance['brand_text'] ) ? $instance['brand_text'] : 'Plan Do See Global Inc.';
        $logo_url    = ! empty( $instance['logo_url'] ) ? $instance['logo_url'] : '';
        $nav_menu    = ! empty( $instance['nav_menu'] ) ? (int) $instance['nav_menu'] : 0;
        $facebook    = ! empty( $instance['facebook'] ) ? $instance['facebook'] : 'https://facebook.com';
        $google      = ! empty( $instance['google'] ) ? $instance['google'] : 'https://google.com';
        $line        = ! empty( $instance['line'] ) ? $instance['line'] : 'https://line.me';
        $twitter     = ! empty( $instance['twitter'] ) ? $instance['twitter'] : 'https://twitter.com';

        // Lấy danh sách menus
        $menus = wp_get_nav_menus();
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'brand_text' ) ); ?>"><?php esc_html_e( 'Tên thương hiệu (Text):', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'brand_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'brand_text' ) ); ?>" type="text" value="<?php echo esc_attr( $brand_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>"><?php esc_html_e( 'Hoặc link ảnh Logo (URL):', 'jobscout' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_url' ) ); ?>" type="text" value="<?php echo esc_attr( $logo_url ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'Chọn Menu chân trang:', 'jobscout' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
                <option value="0"><?php esc_html_e( '-- Mặc định (Jobs, Companies, Blog...) --', 'jobscout' ); ?></option>
                <?php foreach ( $menus as $menu ) : ?>
                    <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
                        <?php echo esc_html( $menu->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p><strong><?php esc_html_e( 'Liên kết Mạng xã hội:', 'jobscout' ); ?></strong></p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">Facebook URL:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>">Google URL:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google' ) ); ?>" type="text" value="<?php echo esc_attr( $google ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'line' ) ); ?>">LINE URL:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'line' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'line' ) ); ?>" type="text" value="<?php echo esc_attr( $line ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">Twitter / X URL:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['brand_text'] = ( ! empty( $new_instance['brand_text'] ) ) ? sanitize_text_field( $new_instance['brand_text'] ) : '';
        $instance['logo_url']   = ( ! empty( $new_instance['logo_url'] ) ) ? esc_url_raw( $new_instance['logo_url'] ) : '';
        $instance['nav_menu']   = ( ! empty( $new_instance['nav_menu'] ) ) ? (int) $new_instance['nav_menu'] : 0;
        $instance['facebook']   = ( ! empty( $new_instance['facebook'] ) ) ? esc_url_raw( $new_instance['facebook'] ) : '';
        $instance['google']     = ( ! empty( $new_instance['google'] ) ) ? esc_url_raw( $new_instance['google'] ) : '';
        $instance['line']       = ( ! empty( $new_instance['line'] ) ) ? esc_url_raw( $new_instance['line'] ) : '';
        $instance['twitter']    = ( ! empty( $new_instance['twitter'] ) ) ? esc_url_raw( $new_instance['twitter'] ) : '';
        return $instance;
    }
}

/**
 * Register widgets
 */
function jobscout_register_custom_footer_widgets() {
    register_widget( 'JobScout_Newsletter_Widget' );
    register_widget( 'JobScout_Brand_Social_Widget' );
}
add_action( 'widgets_init', 'jobscout_register_custom_footer_widgets' );

