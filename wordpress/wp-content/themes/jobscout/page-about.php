<?php
/**
 * Template Name: About Page Template
 *
 * @package JobScout
 */

get_header();

// 1. Banner Section Settings
$banner_img   = get_theme_mod( 'about_banner_image', get_template_directory_uri() . '/images/about-banner.jpg' );
$banner_title = get_theme_mod( 'about_banner_title', "SHARE “OMOTENASHI”\nWITH THE WORLD" );

// 2. About Us Settings
$torii_img         = get_theme_mod( 'about_torii_image', get_template_directory_uri() . '/images/about-torii.jpg' );
$vision_desc       = get_theme_mod( 'about_vision_desc', 'Create hotels and restaurants around the world that offer memorable experiences while building a lasting, positive relationship together with our guests, partners, team members and communities.' );
$mission_desc      = get_theme_mod( 'about_mission_desc', 'Share “Omotenashi” with the world' );
$core_value_quote  = get_theme_mod( 'about_core_value_quote', '“If I were the guest…”' );
$core_value_desc   = get_theme_mod( 'about_core_value_desc', 'To provide guests with the hospitality you would want to receive as a guest.' );

// 3. Services Settings
$services_title    = get_theme_mod( 'about_services_title', 'Hotels, restaurants, banquets/weddings management' );
$services_desc_1   = get_theme_mod( 'about_services_desc_1', 'Plan Do See developed and operates 17 properties worldwide including 3 award-winning resorts in Japan; 17 restaurants of diverse cuisines in cities including New York, Miami and Los Angeles; and other countries including Japan, Indonesia, Malaysia and Bali.' );
$services_desc_2   = get_theme_mod( 'about_services_desc_2', 'Each venue carries its own concept and design. Many of them are originally historical landmarks that were loved by the local people.' );

// 4. Company Info Settings
$company_img       = get_theme_mod( 'about_company_image', get_template_directory_uri() . '/images/about-tokyo-tower.jpg' );
$company_est       = get_theme_mod( 'about_company_est', 'April 1993' );
$company_office    = get_theme_mod( 'about_company_headoffice', 'Marunouchi 2-1-1, Chiyoda, Tokyo' );
$company_capital   = get_theme_mod( 'about_company_capital', '100,000,000 JPY' );
$company_ceo       = get_theme_mod( 'about_company_ceo', 'Yutaka Noda' );
$company_employees = get_theme_mod( 'about_company_employees', 'Full time: 830 / Total: 1,600' );
?>

<div class="custom-about-page">

    <!-- KHỐI 1: HERO BANNER -->
    <section class="about-hero-banner" style="background-image: url('<?php echo esc_url( $banner_img ); ?>');">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1 class="banner-title">
                <?php echo nl2br( wp_kses_post( $banner_title ) ); ?>
            </h1>
        </div>
    </section>

    <!-- KHỐI 2: ABOUT US (VISION / MISSION / CORE VALUE) -->
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

    <!-- KHỐI 3: LĨNH VỰC HOẠT ĐỘNG -->
    <section class="about-section about-services-section">
        <div class="about-container-narrow">
            <h3 class="services-highlight-title"><?php echo esc_html( $services_title ); ?></h3>
            <p class="services-desc">
                <?php echo wp_kses_post( $services_desc_1 ); ?>
            </p>
            <p class="services-desc">
                <?php echo wp_kses_post( $services_desc_2 ); ?>
            </p>
        </div>
    </section>

    <!-- KHỐI 4: THÔNG TIN CÔNG TY -->
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

</div>

<?php
get_footer();
