<?php
/*
 * @package Car Exhibition
 */


 function car_exhibition_admin_enqueue_scripts() {
    wp_enqueue_style( 'car-exhibition-admin-style', esc_url( get_template_directory_uri() ).'/assets/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'car_exhibition_admin_enqueue_scripts' );

function car_exhibition_theme_info_menu_link() {

    $car_exhibition_theme = wp_get_theme();
    add_theme_page(
        /* translators: 1: Theme name. */
        sprintf( esc_html__( 'Welcome to %1$s', 'car-exhibition' ), $car_exhibition_theme->get( 'Name' )),
        esc_html__( 'Theme Info', 'car-exhibition' ),
        'edit_theme_options',
        'car-exhibition',
        'car_exhibition_theme_info_page'
    );
}
add_action( 'admin_menu', 'car_exhibition_theme_info_menu_link' );

function car_exhibition_theme_info_page() {

    $car_exhibition_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s', 'car-exhibition' ), esc_html($car_exhibition_theme->get( 'Name' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'car-exhibition' ); ?>
    </p>
    <div class="columns-wrapper clearfix theme-demo">
        <div class="column column-quarter clearfix start-box"></div>
        <div class="column column-first clearfix">
            <div class="important-link">
                <div class="main-box columns-wrapper clearfix">

                    <div class="themelink column column-half column-border clearfix">
                        <p><strong><?php esc_html_e( 'Free Theme Documentation', 'car-exhibition' ); ?></strong></p>
                        <p><?php esc_html_e( 'Need more details? Please check our complete and detailed documentation for full theme setup.', 'car-exhibition' ); ?></p>
                        <a href="<?php echo esc_url( CAR_EXHIBITION_THEME_DOCUMENTATION ); ?>" target="_blank">
                        <?php esc_html_e( 'Documentation', 'car-exhibition' ); ?>
                        </a>
                    </div>

                    <div class="themelink column column-half column-padding clearfix">
                        <p><strong><?php esc_html_e( 'Need Help?', 'car-exhibition' ); ?></strong></p>
                        <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'car-exhibition' ); ?></p>
                        <a href="<?php echo esc_url( CAR_EXHIBITION_SUPPORT ); ?>" target="_blank">
                        <?php esc_html_e( 'Contact Us', 'car-exhibition' ); ?>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="main-box columns-wrapper clearfix">

                    <div class="themelink column column-half column-border clearfix">
                        <p><strong><?php esc_html_e( 'Pro version of our theme', 'car-exhibition' ); ?></strong></p>
                        <p><?php esc_html_e( 'Are you excited for our theme? Then we will proceed for pro version of theme.', 'car-exhibition' ); ?></p>
                        <a class="get-premium" href="<?php echo esc_url( CAR_EXHIBITION_PREMIUM_PAGE ); ?>" target="_blank">
                        <?php esc_html_e( 'Get Premium', 'car-exhibition' ); ?>
                        </a>
                    </div>

                    <div class="themelink column column-half column-padding clearfix">
                        <p><strong><?php esc_html_e( 'Leave us a review', 'car-exhibition' ); ?></strong></p>
                        <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'car-exhibition' ); ?></p>
                        <a href="<?php echo esc_url( CAR_EXHIBITION_REVIEW ); ?>" target="_blank">
                        <?php esc_html_e( 'Rate This Theme', 'car-exhibition' ); ?>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="column column-quarter clearfix start-box"> 
            <div class="bundle-info">
                <img src="<?php echo esc_url( get_template_directory_uri().'/assets/images/bundle.png'); ?>" alt="<?php echo esc_attr( 'screenshot', 'car-exhibition'); ?>" class="bundle-image"/>
                <div class="bundle-content themelink">
                    <h3><?php esc_html_e( 'WordPress Theme Bundle', 'car-exhibition' ); ?></h3>
                    <small><b><?php esc_html_e( 'Get access to a collection of 112+ stunning WordPress themes for just $89 — featuring designs for every business niche!', 'car-exhibition' ); ?></small></b>
                    <a class="get-premium" href="<?php echo esc_url( CAR_EXHIBITION_BUNDLE_PAGE ); ?>" target="_blank">
                    <?php esc_html_e( 'Get Bundle at 20% OFF', 'car-exhibition' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="getting-started">
        <div class="section">
            <h3><?php 
            /* translators: %s: Theme name. */
            printf( esc_html__( 'Getting started with %s', 'car-exhibition' ),
            esc_html($car_exhibition_theme->get( 'Name' ))); ?></h3>
            <div class="columns-wrapper clearfix">
                <div class="column column-half clearfix">
                    <div class="section themelink">
                        <div class="">
                            <a class="" href="<?php echo esc_url( CAR_EXHIBITION_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Get Premium', 'car-exhibition' ); ?></a>
                            <a href="<?php echo esc_url( CAR_EXHIBITION_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'View Demo', 'car-exhibition' ); ?></a>
                            <a class="get-premium" href="<?php echo esc_url( CAR_EXHIBITION_BUNDLE_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Bundle of 112+ Themes at $89', 'car-exhibition' ); ?></a>
                        </div>
                        <div class="theme-description-1"><?php echo esc_html($car_exhibition_theme->get( 'Description' )); ?></div>
                    </div>
                </div>
                <div class="column column-half clearfix">
                    <img src="<?php echo esc_url( $car_exhibition_theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( 'screenshot', 'car-exhibition'); ?>"/>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        /* translators: 1: Theme name, 2: Author name, 3: Call to action text. */
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'car-exhibition' ),
            esc_html($car_exhibition_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'car-exhibition' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url(CAR_EXHIBITION_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'car-exhibition' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'car-exhibition' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}
?>