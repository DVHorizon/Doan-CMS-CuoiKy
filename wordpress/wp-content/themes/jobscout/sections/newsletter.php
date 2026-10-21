<?php
/**
 * Newsletter Section - Custom Homepage
 * 
 * @package JobScout
 */
?>

<section id="custom-newsletter-section" class="custom-newsletter-section">
    <div class="newsletter-container">
        <div class="newsletter-text-col">
            <h3 class="newsletter-headline">Subscribe To<br>Our Newsletter</h3>
        </div>

        <div class="newsletter-form-col">
            <form class="newsletter-subscribe-form" method="POST" action="<?php echo esc_url( home_url('/') ); ?>" onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã đăng ký nhận bản tin!');">
                <div class="newsletter-input-group">
                    <span class="newsletter-mail-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <input type="email" name="newsletter_email" class="newsletter-email-input" placeholder="Input your email address" required>
                </div>
                <button type="submit" class="newsletter-submit-btn">SUBSCRIBE</button>
            </form>
        </div>
    </div>
</section>
