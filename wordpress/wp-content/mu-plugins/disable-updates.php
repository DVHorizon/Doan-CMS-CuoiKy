<?php
/**
 * Plugin Name: Disable Update Notifications & Checks
 * Description: Vô hiệu hóa kiểm tra và thông báo cập nhật cho Core, Plugins và Themes, ngăn ngừa lỗi kết nối WordPress.org và lỗi headers already sent.
 */

// 1. Gỡ bỏ các hook tự động kiểm tra cập nhật trên admin
remove_action( 'admin_init', '_maybe_update_core' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'admin_init', '_maybe_update_themes' );

remove_action( 'load-plugins.php', 'wp_update_plugins' );
remove_action( 'load-update.php', 'wp_update_plugins' );
remove_action( 'load-update-core.php', 'wp_update_plugins' );
remove_action( 'load-themes.php', 'wp_update_themes' );
remove_action( 'load-update.php', 'wp_update_themes' );
remove_action( 'load-update-core.php', 'wp_update_themes' );

// Gỡ bỏ các cron kiểm tra cập nhật định kỳ
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
remove_action( 'wp_update_themes', 'wp_update_themes' );
remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
remove_action( 'init', 'wp_schedule_update_checks' );

// 2. Trả về cấu trúc transient hợp lệ (giả lập đã kiểm tra và đang ở bản mới nhất)
// Tránh việc trả về null khiến WordPress coi như chưa kiểm tra và gọi wp_version_check() liên tục mỗi khi tải trang.
add_filter( 'pre_site_transient_update_core', function () {
    global $wp_version;
    return (object) array(
        'last_checked'    => time(),
        'version_checked' => isset( $wp_version ) ? $wp_version : '6.7',
        'updates'         => array(),
        'translations'    => array(),
    );
} );

add_filter( 'pre_site_transient_update_plugins', function () {
    return (object) array(
        'last_checked' => time(),
        'response'     => array(),
        'no_update'    => array(),
    );
} );

add_filter( 'pre_site_transient_update_themes', function () {
    return (object) array(
        'last_checked' => time(),
        'response'     => array(),
        'no_update'    => array(),
    );
} );

// 3. Chặn các request HTTP kiểm tra cập nhật tới api.wordpress.org (tránh timeout / SSL handshake failure)
add_filter( 'pre_http_request', function ( $preempt, $parsed_args, $url ) {
    if ( is_string( $url ) && strpos( $url, 'api.wordpress.org/core/version-check' ) !== false ) {
        return array(
            'headers'  => array(),
            'body'     => wp_json_encode( array( 'offers' => array(), 'translations' => array() ) ),
            'response' => array(
                'code'    => 200,
                'message' => 'OK',
            ),
            'cookies'  => array(),
            'filename' => null,
        );
    }
    return $preempt;
}, 10, 3 );

// 4. Ép cURL sử dụng IPv4 trong môi trường Docker/Localhost tránh timeout do IPv6 unreachable
add_action( 'http_api_curl', function ( $handle ) {
    if ( defined( 'CURLOPT_IPRESOLVE' ) && defined( 'CURL_IPRESOLVE_V4' ) ) {
        curl_setopt( $handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    }
} );

// 5. Ẩn badge thông báo cập nhật trên Admin Bar (thanh trên cùng)
add_action( 'wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    if ( is_object( $wp_admin_bar ) ) {
        $wp_admin_bar->remove_menu( 'updates' );
    }
}, 999 );

// 6. Ẩn menu con Updates trong mục Dashboard ở thanh bên trái
add_action( 'admin_menu', function () {
    remove_submenu_page( 'index.php', 'update-core.php' );
}, 999 );
