<?php
/**
 * Plugin Name: Disable Update Notifications
 * Description: Vô hiệu hóa thông báo và gợi ý cập nhật cho Core, Plugins và Themes.
 */

// Chặn kiểm tra và thông báo cập nhật plugin
add_filter( 'pre_site_transient_update_plugins', '__return_null' );

// Chặn kiểm tra và thông báo cập nhật theme
add_filter( 'pre_site_transient_update_themes', '__return_null' );

// Chặn kiểm tra và thông báo cập nhật WordPress core
add_filter( 'pre_site_transient_update_core', '__return_null' );

// Ẩn badge thông báo cập nhật trên Admin Bar (thanh trên cùng)
add_action( 'wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    if ( is_object( $wp_admin_bar ) ) {
        $wp_admin_bar->remove_menu( 'updates' );
    }
}, 999 );

// Ẩn menu con Updates trong mục Dashboard ở thanh bên trái
add_action( 'admin_menu', function () {
    remove_submenu_page( 'index.php', 'update-core.php' );
}, 999 );
