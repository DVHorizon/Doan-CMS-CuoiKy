<?php
/**
 * Plugin Name: Disable Update Notifications & Checks
 * Description: Vô hiệu hóa triệt để kiểm tra và thông báo cập nhật, ngăn ngừa lỗi kết nối WordPress.org và lỗi headers already sent.
 */

// 1. Gỡ bỏ các hook tự động kiểm tra cập nhật
remove_action( 'admin_init', '_maybe_update_core' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'admin_init', '_maybe_update_themes' );

remove_action( 'load-plugins.php', 'wp_update_plugins' );
remove_action( 'load-update.php', 'wp_update_plugins' );
remove_action( 'load-update-core.php', 'wp_update_plugins' );
remove_action( 'load-themes.php', 'wp_update_themes' );
remove_action( 'load-update.php', 'wp_update_themes' );
remove_action( 'load-update-core.php', 'wp_update_themes' );

remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
remove_action( 'wp_update_themes', 'wp_update_themes' );
remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
remove_action( 'init', 'wp_schedule_update_checks' );

// 2. Trả về transient giả lập "đã kiểm tra xong" (last_checked = time())
// Tránh việc trả về null khiến WordPress tưởng chưa kiểm tra và gọi wp_update_plugins/themes/core liên tục
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

// 3. Chỉ chặn các HTTP request kiểm tra cập nhật ngầm (update-check, version-check)
// Vẫn cho phép tính năng tìm kiếm và cài đặt Plugin mới (api.wordpress.org/plugins/info) hoạt động bình thường
add_filter( 'pre_http_request', function ( $preempt, $parsed_args, $url ) {
    if ( is_string( $url ) && ( strpos( $url, 'update-check' ) !== false || strpos( $url, 'version-check' ) !== false ) ) {
        return array(
            'headers'  => array(),
            'body'     => wp_json_encode( array(
                'offers'       => array(),
                'translations' => array(),
                'plugins'      => array(),
                'themes'       => array(),
                'no_update'    => array(),
                'response'     => array(),
            ) ),
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

// 4. Ép cURL sử dụng IPv4 trong Docker tránh timeout IPv6
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
