<?php
/**
 * SEO & Social Share (Open Graph) Meta Box and Head Tags
 *
 * Cho phép nhập meta_img, meta_description trong WP Admin cho Jobs, Posts và Pages,
 * đồng thời tự động xuất các thẻ meta Open Graph (Facebook), Twitter Cards và meta description ra <head>.
 *
 * @package JobScout
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Đăng ký Meta Box "Cấu hình Chia sẻ Facebook & SEO" trong WP Admin
 */
function jobscout_add_seo_meta_box() {
    $screens = array( 'job_listing', 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'jobscout_seo_social_meta_box',
            __( 'Cấu hình Chia sẻ Mạng Xã Hội (Facebook, Zalo) & SEO', 'jobscout' ),
            'jobscout_render_seo_meta_box',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'jobscout_add_seo_meta_box' );

/**
 * 2. Enqueue Media Scripts để chọn ảnh qua WordPress Media Uploader
 */
function jobscout_seo_meta_enqueue_admin_scripts( $hook ) {
    if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'jobscout_seo_meta_enqueue_admin_scripts' );

/**
 * 3. Giao diện Meta Box trong WP Admin
 */
function jobscout_render_seo_meta_box( $post ) {
    wp_nonce_field( 'jobscout_seo_save_meta', 'jobscout_seo_meta_nonce' );

    // Lấy giá trị hiện tại (hỗ trợ cả prefix _ và không có _)
    $meta_desc = get_post_meta( $post->ID, '_meta_description', true );
    if ( empty( $meta_desc ) ) {
        $meta_desc = get_post_meta( $post->ID, 'meta_description', true );
    }

    $meta_img = get_post_meta( $post->ID, '_meta_img', true );
    if ( empty( $meta_img ) ) {
        $meta_img = get_post_meta( $post->ID, 'meta_img', true );
    }

    // Gợi ý ảnh mặc định nếu chưa nhập
    $fallback_img = '';
    if ( 'job_listing' === $post->post_type ) {
        $fallback_img = get_post_meta( $post->ID, '_company_logo', true );
    }
    if ( empty( $fallback_img ) && has_post_thumbnail( $post->ID ) ) {
        $fallback_img = get_the_post_thumbnail_url( $post->ID, 'full' );
    }
    ?>
    <style>
        .jobscout-seo-field-group {
            margin-bottom: 20px;
        }
        .jobscout-seo-field-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #1e293b;
            font-size: 14px;
        }
        .jobscout-seo-field-group .description {
            color: #64748b;
            font-size: 12.5px;
            margin-top: 5px;
            display: block;
            line-height: 1.45;
        }
        .jobscout-seo-field-group textarea {
            width: 100%;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            font-size: 13.5px;
        }
        .jobscout-seo-img-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-top: 8px;
        }
        .jobscout-seo-img-preview {
            width: 160px;
            height: 90px;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }
        .jobscout-seo-img-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            display: block;
        }
        .jobscout-seo-img-controls {
            flex: 1;
        }
        .jobscout-seo-img-controls input[type="text"] {
            width: 100%;
            margin-bottom: 8px;
        }
        .char-counter {
            font-size: 12px;
            color: #ea580c;
            font-weight: 600;
        }
    </style>

    <div class="jobscout-seo-metabox-container">
        <!-- 1. META DESCRIPTION -->
        <div class="jobscout-seo-field-group">
            <label for="jobscout_meta_description">
                <?php esc_html_e( 'Mô tả bài chia sẻ (meta_description / og:description):', 'jobscout' ); ?>
            </label>
            <textarea id="jobscout_meta_description" name="jobscout_meta_description" rows="3" placeholder="<?php esc_attr_e( 'Nhập đoạn mô tả ngắn hấp dẫn khi chia sẻ link lên Facebook, Zalo hoặc tìm kiếm Google (120 - 160 ký tự)...', 'jobscout' ); ?>"><?php echo esc_textarea( $meta_desc ); ?></textarea>
            <span class="description">
                <span id="jobscout-char-count" class="char-counter"><?php echo strlen( (string) $meta_desc ); ?></span> <?php esc_html_e( 'ký tự (khuyên dùng 120 - 160 ký tự). Nếu để trống, hệ thống sẽ tự động trích xuất từ nội dung công việc/bài viết.', 'jobscout' ); ?>
            </span>
        </div>

        <!-- 2. META IMAGE -->
        <div class="jobscout-seo-field-group">
            <label for="jobscout_meta_img">
                <?php esc_html_e( 'Hình ảnh hiển thị khi chia sẻ (meta_img / og:image):', 'jobscout' ); ?>
            </label>
            <div class="jobscout-seo-img-wrapper">
                <div class="jobscout-seo-img-preview" id="jobscout-seo-preview-box">
                    <?php 
                    $display_img = ! empty( $meta_img ) ? $meta_img : $fallback_img;
                    if ( ! empty( $display_img ) ) : ?>
                        <img src="<?php echo esc_url( $display_img ); ?>" id="jobscout-seo-preview-img" alt="Preview" />
                    <?php else : ?>
                        <span style="color:#94a3b8;font-size:12px;" id="jobscout-seo-no-img"><?php esc_html_e( 'Chưa có ảnh', 'jobscout' ); ?></span>
                    <?php endif; ?>
                </div>

                <div class="jobscout-seo-img-controls">
                    <input type="text" id="jobscout_meta_img" name="jobscout_meta_img" value="<?php echo esc_url( $meta_img ); ?>" placeholder="https://..." />
                    <button type="button" class="button button-secondary" id="jobscout-btn-upload-img">
                        <?php esc_html_e( 'Chọn / Tải ảnh lên Media', 'jobscout' ); ?>
                    </button>
                    <button type="button" class="button button-link-delete" id="jobscout-btn-remove-img" style="<?php echo empty( $meta_img ) ? 'display:none;' : ''; ?>">
                        <?php esc_html_e( 'Xóa ảnh', 'jobscout' ); ?>
                    </button>
                    <span class="description">
                        <?php esc_html_e( 'Kích thước chuẩn khuyến nghị cho Facebook: 1200 x 630 pixel (tỉ lệ 1.91:1). Nếu để trống, hệ thống sẽ tự lấy Logo công ty hoặc Ảnh đại diện của bài viết.', 'jobscout' ); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Character counter
        $('#jobscout_meta_description').on('input', function() {
            $('#jobscout-char-count').text($(this).val().length);
        });

        // Media Uploader
        let mediaUploader;
        $('#jobscout-btn-upload-img').on('click', function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media({
                title: '<?php echo esc_js( __( "Chọn hoặc tải lên ảnh hiển thị Facebook", "jobscout" ) ); ?>',
                button: { text: '<?php echo esc_js( __( "Sử dụng ảnh này", "jobscout" ) ); ?>' },
                multiple: false
            });

            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#jobscout_meta_img').val(attachment.url);
                
                let previewImg = $('#jobscout-seo-preview-img');
                if (previewImg.length) {
                    previewImg.attr('src', attachment.url);
                } else {
                    $('#jobscout-seo-preview-box').html('<img src="' + attachment.url + '" id="jobscout-seo-preview-img" alt="Preview" />');
                }
                $('#jobscout-btn-remove-img').show();
            });

            mediaUploader.open();
        });

        $('#jobscout-btn-remove-img').on('click', function(e) {
            e.preventDefault();
            $('#jobscout_meta_img').val('');
            $(this).hide();
            <?php if ( ! empty( $fallback_img ) ) : ?>
                $('#jobscout-seo-preview-box').html('<img src="<?php echo esc_url( $fallback_img ); ?>" id="jobscout-seo-preview-img" alt="Preview" />');
            <?php else : ?>
                $('#jobscout-seo-preview-box').html('<span style="color:#94a3b8;font-size:12px;" id="jobscout-seo-no-img"><?php echo esc_js( __( "Chưa có ảnh", "jobscout" ) ); ?></span>');
            <?php endif; ?>
        });
    });
    </script>
    <?php
}

/**
 * 4. Lưu dữ liệu Meta Box khi lưu/cập nhật bài viết
 */
function jobscout_save_seo_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['jobscout_seo_meta_nonce'] ) || ! wp_verify_nonce( $_POST['jobscout_seo_meta_nonce'], 'jobscout_seo_save_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Lưu meta_description (lưu cả 2 key: _meta_description và meta_description)
    if ( isset( $_POST['jobscout_meta_description'] ) ) {
        $desc = sanitize_textarea_field( wp_unslash( $_POST['jobscout_meta_description'] ) );
        update_post_meta( $post_id, '_meta_description', $desc );
        update_post_meta( $post_id, 'meta_description', $desc );
    }

    // Lưu meta_img (lưu cả 2 key: _meta_img và meta_img)
    if ( isset( $_POST['jobscout_meta_img'] ) ) {
        $img = esc_url_raw( trim( wp_unslash( $_POST['jobscout_meta_img'] ) ) );
        update_post_meta( $post_id, '_meta_img', $img );
        update_post_meta( $post_id, 'meta_img', $img );
    }
}
add_action( 'save_post', 'jobscout_save_seo_meta_box_data' );

/**
 * 5. Xuất các thẻ Open Graph, Twitter Card và Meta Description vào <head>
 */
function jobscout_output_social_open_graph_meta() {
    $site_name = get_bloginfo( 'name' );
    $og_title = '';
    $og_desc  = '';
    $og_img   = '';
    $og_url   = '';
    $og_type  = 'website';

    if ( is_front_page() || is_home() ) {
        $og_type  = 'website';
        $og_title = get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
        $og_desc  = get_bloginfo( 'description' );
        $og_url   = home_url( '/' );
        
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        if ( $custom_logo_id ) {
            $og_img = wp_get_attachment_image_url( $custom_logo_id, 'full' );
        }
    } elseif ( is_singular() ) {
        global $post;
        $post_id  = $post->ID;
        $og_title = get_the_title( $post_id );
        $og_url   = get_permalink( $post_id );
        $og_type  = 'article';

        // 1. LẤY MÔ TẢ (Ưu tiên meta_description người dùng nhập)
        $meta_desc = get_post_meta( $post_id, '_meta_description', true );
        if ( empty( $meta_desc ) ) {
            $meta_desc = get_post_meta( $post_id, 'meta_description', true );
        }

        if ( ! empty( $meta_desc ) ) {
            $og_desc = $meta_desc;
        } elseif ( 'job_listing' === $post->post_type ) {
            // Tự động tạo mô tả chuẩn tuyển dụng nếu không nhập
            $comp_name = get_post_meta( $post_id, '_company_name', true );
            $comp_loc  = get_post_meta( $post_id, '_job_location', true );
            $overview  = get_post_meta( $post_id, '_job_overview', true );
            
            $prefix = sprintf( 'Tuyển dụng %s', get_the_title( $post_id ) );
            if ( ! empty( $comp_name ) ) $prefix .= sprintf( ' tại %s', $comp_name );
            if ( ! empty( $comp_loc ) )  $prefix .= sprintf( ' (%s)', $comp_loc );
            $prefix .= '. ';

            if ( ! empty( $overview ) ) {
                $og_desc = $prefix . wp_strip_all_tags( $overview );
            } elseif ( ! empty( $post->post_content ) ) {
                $og_desc = $prefix . wp_strip_all_tags( $post->post_content );
            } else {
                $og_desc = $prefix . 'Ứng tuyển trực tuyến ngay trên CareerHub.';
            }
        } elseif ( ! empty( $post->post_excerpt ) ) {
            $og_desc = wp_strip_all_tags( $post->post_excerpt );
        } elseif ( ! empty( $post->post_content ) ) {
            $og_desc = wp_strip_all_tags( $post->post_content );
        }

        // Cắt gọn mô tả tối đa 160 ký tự
        $og_desc = wp_trim_words( $og_desc, 30, '...' );

        // 2. LẤY HÌNH ẢNH (Ưu tiên meta_img người dùng nhập)
        $meta_img = get_post_meta( $post_id, '_meta_img', true );
        if ( empty( $meta_img ) ) {
            $meta_img = get_post_meta( $post_id, 'meta_img', true );
        }

        if ( ! empty( $meta_img ) ) {
            $og_img = $meta_img;
        } elseif ( 'job_listing' === $post->post_type ) {
            // Tự động lấy Logo công ty hoặc ảnh đại diện
            $comp_logo = get_post_meta( $post_id, '_company_logo', true );
            if ( ! empty( $comp_logo ) ) {
                $og_img = $comp_logo;
            } elseif ( has_post_thumbnail( $post_id ) ) {
                $og_img = get_the_post_thumbnail_url( $post_id, 'full' );
            }
        } elseif ( has_post_thumbnail( $post_id ) ) {
            $og_img = get_the_post_thumbnail_url( $post_id, 'full' );
        }

    } else {
        // Trang chủ hoặc danh sách
        $og_title = wp_get_document_title();
        $og_desc  = get_bloginfo( 'description' );
        $og_url   = home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );
    }

    // Fallback ảnh Logo trang web nếu vẫn chưa có ảnh
    if ( empty( $og_img ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        if ( $custom_logo_id ) {
            $og_img = wp_get_attachment_image_url( $custom_logo_id, 'full' );
        }
    }

    if ( empty( $og_desc ) ) {
        $og_desc = get_bloginfo( 'description' );
    }

    // Làm sạch đầu ra
    $og_title = esc_attr( strip_tags( (string) $og_title ) );
    $og_desc  = esc_attr( strip_tags( (string) $og_desc ) );
    $og_url   = esc_url( (string) $og_url );
    $og_img   = esc_url( (string) $og_img );
    ?>

    <!-- ============================================== -->
    <!-- SEO & SOCIAL SHARING META TAGS                 -->
    <!-- ============================================== -->
    <!-- Thẻ meta tiêu chuẩn (SEO & Search Engine) -->
    <meta name="description" content="<?php echo $og_desc; ?>" />
    <meta name="meta_description" content="<?php echo $og_desc; ?>" />
    <?php if ( ! empty( $og_img ) ) : ?>
    <meta name="image" content="<?php echo $og_img; ?>" />
    <meta name="meta_image" content="<?php echo $og_img; ?>" />
    <meta name="meta_img" content="<?php echo $og_img; ?>" />
    <link rel="image_src" href="<?php echo $og_img; ?>" />
    <?php endif; ?>

    <!-- Thẻ Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>" />
    <meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>" />
    <meta property="og:title" content="<?php echo $og_title; ?>" />
    <meta property="og:description" content="<?php echo $og_desc; ?>" />
    <meta property="og:url" content="<?php echo $og_url; ?>" />
    <?php if ( ! empty( $og_img ) ) : ?>
    <meta property="og:image" content="<?php echo $og_img; ?>" />
    <meta property="og:image:secure_url" content="<?php echo $og_img; ?>" />
    <meta property="og:image:alt" content="<?php echo $og_title; ?>" />
    <?php endif; ?>

    <!-- Thẻ Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $og_title; ?>" />
    <meta name="twitter:description" content="<?php echo $og_desc; ?>" />
    <?php if ( ! empty( $og_img ) ) : ?>
    <meta name="twitter:image" content="<?php echo $og_img; ?>" />
    <?php endif; ?>
    <!-- ============================================== -->

    <?php
}
add_action( 'wp_head', 'jobscout_output_social_open_graph_meta', 1 );

