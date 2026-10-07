<?php

/**
 * file for holding dashboard welcome page for theme
 */
if (!function_exists('car_exhibition_is_plugin_installed')) {
    function car_exhibition_is_plugin_installed($plugin_slug)
    {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin_slug;
        return file_exists($plugin_path);
    }
}
if (!function_exists('car_exhibition_is_plugin_activated')) {
    function car_exhibition_is_plugin_activated($plugin_slug)
    {
        return is_plugin_active($plugin_slug);
    }
}

// Hook into a custom action when the button is clicked
add_action('wp_ajax_car_exhibition_install_and_activate_plugins', 'car_exhibition_install_and_activate_plugins');
add_action('wp_ajax_nopriv_car_exhibition_install_and_activate_plugins', 'car_exhibition_install_and_activate_plugins');
add_action('wp_ajax_car_exhibition_rplugin_activation', 'car_exhibition_rplugin_activation');
add_action('wp_ajax_nopriv_car_exhibition_rplugin_activation', 'car_exhibition_rplugin_activation');

// Function to install and activate the plugins



function check_plugin_installed_status($pugin_slug, $plugin_file)
{
    return file_exists(ABSPATH . 'wp-content/plugins/' . $pugin_slug . '/' . $plugin_file) ? true : false;
}

/* Check if plugin is activated */


function check_plugin_active_status($pugin_slug, $plugin_file)
{
    return is_plugin_active($pugin_slug . '/' . $plugin_file) ? true : false;
}

require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/misc.php');
require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
// Helper function to check if all recommended plugins are installed and activated
function car_exhibition_all_plugins_active() {
    $recommended_plugins = array(
        array(
            'name' => __( 'Contact Form 7', 'car-exhibition' ),
            'slug' => 'contact-form-7',
            'file' => 'wp-contact-form-7.php'
        ),
        array(
            'name' => __( 'Classic Blog Grid', 'car-exhibition' ),
            'slug' => 'classic-blog-grid',
            'file' => 'classic-blog-grid.php'
        ),
        array(
            'name' => __( 'Essential Blocks', 'car-exhibition' ),
            'slug' => 'essential-blocks',
            'file' => 'essential-blocks.php'
        )
    );

    foreach ($recommended_plugins as $plugin) {
        $plugin_slug = $plugin['slug'];
        $plugin_file = $plugin['file'];

        // Check if the plugin is active
        if (!is_plugin_active($plugin_slug . '/' . $plugin_file)) {
            return false; // If any plugin is not active, return false
        }
    }

    return true; // All plugins are active
}

class Silent_Skin extends WP_Upgrader_Skin {
    public function header() {}
    public function footer() {}
    public function feedback($string, ...$args) {}
    public function error($errors) {}
    public function before() {}
    public function after() {}
}

// Function to install and activate plugins
function car_exhibition_install_and_activate_plugins() {
    if (!current_user_can('manage_options')) {
        return;
    }
    check_ajax_referer('car_exhibition_welcome_nonce', 'nonce');

    // Define the recommended plugins
    $recommended_plugins = array(
        array(
            'name' => __( 'Contact Form 7', 'car-exhibition' ),
            'slug' => 'contact-form-7',
            'file' => 'wp-contact-form-7.php'
        ),
        array(
            'name' => __( 'Classic Blog Grid', 'car-exhibition' ),
            'slug' => 'classic-blog-grid',
            'file' => 'classic-blog-grid.php'
        ),
        array(
            'name' => __( 'Essential Blocks', 'car-exhibition' ),
            'slug' => 'essential-blocks',
            'file' => 'essential-blocks.php'
        )
    );

    set_transient('install_and_activate_progress', array(), MINUTE_IN_SECONDS * 10);

    require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/misc.php');
    require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

    foreach ($recommended_plugins as $plugin) {
        $plugin_slug = $plugin['slug'];
        $plugin_file = $plugin['file'];
        $plugin_name = $plugin['name'];

        // Check if the plugin is active
        if (is_plugin_active($plugin_slug . '/' . $plugin_file)) {
            update_install_and_activate_progress($plugin_name, 'Already Active');
            continue;
        }

        // Check if the plugin is installed but not active
        if (is_car_exhibition_plugin_installed($plugin_slug)) {
            $activate = activate_plugin($plugin_slug . '/' . $plugin_file);
            if (is_wp_error($activate)) {
                update_install_and_activate_progress($plugin_name, 'Error');
                continue;
            }
            update_install_and_activate_progress($plugin_name, 'Activated');
            continue;
        }

        // Plugin is not installed or activated, proceed with installation
        update_install_and_activate_progress($plugin_name, 'Installing');

        $api = plugins_api('plugin_information', array('slug' => $plugin_slug, 'fields' => array('sections' => false)));
        if (is_wp_error($api)) {
            update_install_and_activate_progress($plugin_name, 'Error');
            continue;
        }

        $upgrader = new Plugin_Upgrader(new Silent_Skin());
        $install = $upgrader->install($api->download_link);

        if ($install) {
            $activate = activate_plugin($plugin_slug . '/' . $plugin_file);
            if (is_wp_error($activate)) {
                update_install_and_activate_progress($plugin_name, 'Error');
                continue;
            }
            update_install_and_activate_progress($plugin_name, 'Activated');
            continue;
        } else {
            update_install_and_activate_progress($plugin_name, 'Error');
        }
    }
    delete_transient('install_and_activate_progress');
    if (ob_get_length()) ob_clean();

    header('Content-Type: application/json; charset=utf-8');
    $redirect_url = admin_url('themes.php?page=car-exhibition');
    echo json_encode([
        'success' => true,
        'data' => [
            'redirect_url' => $redirect_url,
        ],
    ]);

    wp_die();
}

// Function to check if a plugin is installed
function is_car_exhibition_plugin_installed($plugin_slug) {
    $installed_plugins = get_plugins();
    foreach ($installed_plugins as $path => $details) {
        if (strpos($path, $plugin_slug) === 0) {
            return true;
        }
    }
    return false;
}

// Function to update the installation progress
function update_install_and_activate_progress($plugin_name, $status) {
    $progress = get_transient('install_and_activate_progress');
    $progress[] = array('plugin' => $plugin_name, 'status' => $status);
    set_transient('install_and_activate_progress', $progress, MINUTE_IN_SECONDS * 10);
}

// Dismiss function for AJAX request
add_action('wp_ajax_car_exhibition_dismissed_notice_handler', 'car_exhibition_ajax_notice_dismiss_function');

function car_exhibition_ajax_notice_dismiss_function() {
    if (!wp_verify_nonce($_POST['wpnonce'], 'car_exhibition_welcome_nonce')) {
        wp_send_json_error('Invalid nonce');
        exit;
    }
    
    if (isset($_POST['type'])) {
        $type = sanitize_text_field(wp_unslash($_POST['type']));
        update_option('dismissed-' . $type, true);
        wp_send_json_success('Notice dismissed');
    } else {
        wp_send_json_error('Type not set');
    }
}

/* Activation Notice */
function car_exhibition_custom_admin_notice() {
    if (!get_option('dismissed-get_started_notice', false)) {
        $car_exhibition_current_screen = get_current_screen();
        $car_exhibition_theme = wp_get_theme();
        if ($car_exhibition_current_screen && $car_exhibition_current_screen->id !== 'appearance_page_car-exhibition') {
            ?>
                <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class car-exhibition-admin-notice notice notice-info is-dismissible content-install-plugin theme-info-notice" id="car-exhibition-dismiss-notice" data-notice="get_started_notice">
                    <div class="admin-image">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
                    </div>
                    <div class="admin-content" >
                        <h1><?php 
                        /* translators: 1: Theme name, 2: Theme version. */
                        printf( esc_html__( 'Welcome to %1$s %2$s', 'car-exhibition' ), esc_html($car_exhibition_theme->get( 'Name' )), esc_html($car_exhibition_theme->get( 'Version' ))); ?>
                        </h1>
                        <p><?php _e('Get Started With Theme By Clicking On Getting Started.', 'car-exhibition'); ?></p>
                        <div style="display: grid;">
                            <a class="admin-notice-btn button button-hero upgrade-pro" target="_blank" href="<?php echo esc_url( CAR_EXHIBITION_PREMIUM_PAGE ); ?>"><?php esc_html_e('Upgrade Pro', 'car-exhibition') ?><i class="dashicons dashicons-cart"></i></a>

                            <a class="admin-notice-btn button button-hero theme-install" id="install-activate-button" href="#"><?php esc_html_e( 'Get started', 'car-exhibition' ) ?><i class="dashicons dashicons-backup"></i></a>

                            <a class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( CAR_EXHIBITION_THEME_DOCUMENTATION ); ?>"><?php esc_html_e('Free Doc', 'car-exhibition') ?><i class="dashicons dashicons-visibility"></i></a>

                            <a  class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( CAR_EXHIBITION_PRO_DEMO ); ?>"><?php esc_html_e('View Demo', 'car-exhibition') ?><i class="dashicons dashicons-awards"></i></a>
                        </div>
                    </div>
                    <div class="admin-bundle-image">
                        <a href="<?php echo esc_url( CAR_EXHIBITION_BUNDLE_PAGE ); ?>" target="_blank"><img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/assets/images/image_1.webp'; ?>" /></a>
                    </div>
                </div>
            <?php
        }
    }
}
add_action('admin_notices', 'car_exhibition_custom_admin_notice');

// After switching theme, reset dismissed notice option
add_action('after_switch_theme', 'car_exhibition_after_switch_theme');
function car_exhibition_after_switch_theme() {
    update_option('dismissed-get_started_notice', FALSE);
} ?>