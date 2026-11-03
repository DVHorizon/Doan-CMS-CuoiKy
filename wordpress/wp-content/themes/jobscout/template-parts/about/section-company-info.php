<?php
/**
 * About Page - Khối 4: Thông Tin Công Ty (Company Info)
 * 
 * @package JobScout
 */
$company_img       = get_theme_mod( 'about_company_image', get_template_directory_uri() . '/images/about-tokyo-tower.jpg' );
$company_est       = get_theme_mod( 'about_company_est', 'April 1993' );
$company_office    = get_theme_mod( 'about_company_headoffice', 'Marunouchi 2-1-1, Chiyoda, Tokyo' );
$company_capital   = get_theme_mod( 'about_company_capital', '100,000,000 JPY' );
$company_ceo       = get_theme_mod( 'about_company_ceo', 'Yutaka Noda' );
$company_employees = get_theme_mod( 'about_company_employees', 'Full time: 830 / Total: 1,600' );
?>
<section class="about-section about-company-section">
    <div class="about-container">
        <div class="about-grid-2col reverse-on-mobile">
            <div class="col-content company-info-col">
                <div class="company-info-item">
                    <span class="info-label">Established since</span>
                    <span class="info-value"><?php echo esc_html( $company_est ); ?></span>
                </div>

                <div class="company-info-item">
                    <span class="info-label">Head Office</span>
                    <span class="info-value"><?php echo esc_html( $company_office ); ?></span>
                </div>

                <div class="company-info-item">
                    <span class="info-label">Capital</span>
                    <span class="info-value"><?php echo esc_html( $company_capital ); ?></span>
                </div>

                <div class="company-info-item">
                    <span class="info-label">CEO</span>
                    <span class="info-value"><?php echo esc_html( $company_ceo ); ?></span>
                </div>

                <div class="company-info-item">
                    <span class="info-label">Number of Employees</span>
                    <span class="info-value"><?php echo esc_html( $company_employees ); ?></span>
                </div>
            </div>

            <div class="col-image">
                <img src="<?php echo esc_url( $company_img ); ?>" alt="Tokyo Tower" class="rounded-img" />
            </div>
        </div>
    </div>
</section>

