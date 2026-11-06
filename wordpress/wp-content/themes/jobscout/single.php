<?php
/**
 * The template for displaying all single posts (News Detail)
 *
 * @package JobScout
 */

get_header();

while (have_posts()):
    the_post();
    $current_id = get_the_ID();
    $categories = get_the_category();
    $tags = get_the_tags();
    $blog_page_id = get_option('page_for_posts');
    $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
    $post_date = get_the_date('M d, Y');

    // Dữ liệu chia sẻ: link + tiêu đề + ảnh đại diện (mã hóa để ghép vào URL)
    $share_url = rawurlencode(get_permalink());
    $share_title = rawurlencode(get_the_title());
    $thumb_large = get_the_post_thumbnail_url($current_id, 'large');
    $share_image = rawurlencode((string) ($thumb_large ? $thumb_large : jobscout_get_news_fallback_image_url()));

    // Danh sách nền tảng chia sẻ: muốn thêm/bớt nền tảng chỉ cần sửa mảng này
    $share_links = array(
        'facebook' => array(
            'label' => 'Facebook',
            'icon' => 'fab fa-facebook-f',
            'url' => 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url,
        ),
        'twitter' => array(
            'label' => 'X (Twitter)',
            'icon' => 'fab fa-twitter',
            'url' => 'https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $share_title,
        ),
        'linkedin' => array(
            'label' => 'LinkedIn',
            'icon' => 'fab fa-linkedin-in',
            'url' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url,
        ),
        'telegram' => array(
            'label' => 'Telegram',
            'icon' => 'fab fa-telegram-plane',
            'url' => 'https://t.me/share/url?url=' . $share_url . '&text=' . $share_title,
        ),
        'whatsapp' => array(
            'label' => 'WhatsApp',
            'icon' => 'fab fa-whatsapp',
            'url' => 'https://api.whatsapp.com/send?text=' . $share_title . '%20' . $share_url,
        ),
        'pinterest' => array(
            'label' => 'Pinterest',
            'icon' => 'fab fa-pinterest-p',
            'url' => 'https://pinterest.com/pin/create/button/?url=' . $share_url . '&media=' . $share_image . '&description=' . $share_title,
        ),
        'email' => array(
            'label' => 'Email',
            'icon' => 'fas fa-envelope',
            'url' => 'mailto:?subject=' . $share_title . '&body=' . $share_url,
        ),
    );

    $header_max_w  = absint( get_theme_mod( 'news_detail_header_max_width', 1140 ) );
    $content_max_w = absint( get_theme_mod( 'news_detail_content_max_width', 1140 ) );
    $related_max_w = absint( get_theme_mod( 'news_detail_related_max_width', 1140 ) );
    if ( $header_max_w <= 0 ) $header_max_w = 1140;
    if ( $content_max_w <= 0 ) $content_max_w = 1140;
    if ( $related_max_w <= 0 ) $related_max_w = 1140;

    // Căn lề Trái / Giữa / Phải cho từng khối (mặc định: center -> margin-left: auto; margin-right: auto;)
    $header_align  = get_theme_mod( 'news_detail_header_align', 'center' );
    $content_align = get_theme_mod( 'news_detail_content_align', 'center' );
    $related_align = get_theme_mod( 'news_detail_related_align', 'center' );

    $header_ml  = ( 'left' === $header_align ) ? '0' : 'auto';
    $header_mr  = ( 'right' === $header_align ) ? '0' : 'auto';
    $content_ml = ( 'left' === $content_align ) ? '0' : 'auto';
    $content_mr = ( 'right' === $content_align ) ? '0' : 'auto';
    $related_ml = ( 'left' === $related_align ) ? '0' : 'auto';
    $related_mr = ( 'right' === $related_align ) ? '0' : 'auto';

    $meta_desc  = get_post_meta( get_the_ID(), '_news_detail_short_desc', true );
    $cust_desc  = get_theme_mod( 'news_detail_short_desc', '' );
    $raw_desc   = ! empty( $meta_desc ) ? $meta_desc : ( ! empty( $cust_desc ) ? $cust_desc : wp_strip_all_tags( get_the_excerpt() ) );
    $short_desc = mb_strimwidth( $raw_desc, 0, 50, '...' );
    ?>

    <div class="custom-news-detail-page">
    <?php
    $detail_sections = function_exists( 'jobscout_get_news_detail_sections_order' )
        ? jobscout_get_news_detail_sections_order()
        : array( 'breadcrumb', 'header', 'description', 'content', 'related' );

    $desc_idx               = array_search( 'description', $detail_sections, true );
    $content_idx            = array_search( 'content', $detail_sections, true );
    $adjacent_desc_first    = ( false !== $desc_idx && false !== $content_idx && $desc_idx + 1 === $content_idx );
    $adjacent_content_first = ( false !== $desc_idx && false !== $content_idx && $content_idx + 1 === $desc_idx );

    $in_container = false;

    foreach ( $detail_sections as $section_id ) :
        if ( 'related' === $section_id ) {
            if ( $in_container ) {
                echo '</div><!-- .detail-container -->';
                $in_container = false;
            }
        } else {
            if ( ! $in_container ) {
                echo '<div class="detail-container">';
                $in_container = true;
            }
        }

        switch ( $section_id ) :
            case 'breadcrumb':
                ?>
                <!-- 1. BREADCRUMB -->
                <nav class="news-detail-breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                    <span class="sep">/</span>
                    <a href="<?php echo esc_url( $blog_url ); ?>">All News</a>
                    <span class="sep">/</span>
                    <span class="current">News Detail</span>
                </nav>
                <?php
                break;

            case 'header':
                ?>
                <!-- 2. POST HEADER CARD -->
                <div class="news-detail-header-card" style="max-width: <?php echo esc_attr( $header_max_w ); ?>px; margin-left: <?php echo esc_attr( $header_ml ); ?>; margin-right: <?php echo esc_attr( $header_mr ); ?>;">
                    <div class="header-card-left">
                        <div class="detail-thumb">
                            <?php
                            // Fallback handling: onerror="this.onerror=null;this.removeAttribute('srcset');this.removeAttribute('sizes');"
                            if ( function_exists( 'jobscout_news_thumbnail' ) ) {
                                jobscout_news_thumbnail( 'medium' );
                            } else {
                                $detail_fallback = function_exists( 'jobscout_get_news_fallback_image_url' ) ? jobscout_get_news_fallback_image_url() : get_template_directory_uri() . '/images/default-thumbnail.svg';
                                ?>
                                <img src="<?php echo esc_url( $detail_fallback ); ?>" alt="<?php the_title_attribute(); ?>" onerror="this.onerror=null;this.removeAttribute('srcset');this.removeAttribute('sizes');this.src='<?php echo esc_url( $detail_fallback ); ?>';" class="attachment-medium size-medium wp-post-image jobscout-fallback-thumb" />
                                <?php
                            }
                            ?>
                        </div>

                        <div class="detail-info">
                            <h1 class="detail-title"><?php the_title(); ?></h1>

                            <div class="detail-meta">
                                <span class="detail-date">Posted: <?php echo esc_html( $post_date ); ?></span>
                            </div>

                            <div class="detail-badges">
                                <?php if ( ! empty( $categories ) ) : ?>
                                    <?php foreach ( array_slice( $categories, 0, 2 ) as $cat ) : ?>
                                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                                            class="badge-item"><?php echo esc_html( $cat->name ); ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if ( ! empty( $tags ) ) : ?>
                                    <?php foreach ( array_slice( $tags, 0, 2 ) as $tag ) : ?>
                                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                                            class="badge-item"><?php echo esc_html( $tag->name ); ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="header-card-right">
                        <!-- NÚT SHARE + MENU CHỌN NỀN TẢNG -->
                        <div class="share-wrapper">
                            <button type="button" class="btn-share" id="btnSharePost" aria-haspopup="true"
                                aria-expanded="false" aria-controls="shareMenu">SHARE</button>

                            <div class="share-menu" id="shareMenu" role="menu">
                                <?php foreach ( $share_links as $key => $item ) : ?>
                                    <a href="<?php echo esc_url( $item['url'] ); ?>"
                                        class="share-item share-<?php echo esc_attr( $key ); ?>" target="_blank"
                                        rel="noopener noreferrer" role="menuitem" <?php echo ( 'email' === $key ) ? '' : 'data-popup="1"'; ?>>
                                        <span class="share-icon"><i class="<?php echo esc_attr( $item['icon'] ); ?>"></i></span>
                                        <?php echo esc_html( $item['label'] ); ?>
                                    </a>
                                <?php endforeach; ?>

                                <button type="button" class="share-item share-copy" id="shareCopyLink" role="menuitem">
                                    <span class="share-icon"><i class="fas fa-link"></i></span>
                                    <span class="share-copy-text">Sao chép liên kết</span>
                                </button>

                                <!-- Chỉ hiện trên thiết bị hỗ trợ Web Share API (điện thoại: Zalo, Messenger...) -->
                                <button type="button" class="share-item share-native" id="shareNative" role="menuitem" hidden>
                                    <span class="share-icon"><i class="fas fa-share-alt"></i></span>
                                    Ứng dụng khác...
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;

            case 'description':
                if ( $adjacent_desc_first ) :
                    ?>
                    <!-- 3. MAIN ARTICLE CONTENT -->
                    <!-- <article class="news-detail-content-card"> -->
                    <article class="news-detail-content-card" style="max-width: <?php echo esc_attr( $content_max_w ); ?>px; margin-left: <?php echo esc_attr( $content_ml ); ?>; margin-right: <?php echo esc_attr( $content_mr ); ?>;">
                        <?php if ( ! empty( $short_desc ) ) : ?>
                            <p class="news-detail-description"><em><?php echo esc_html( $short_desc ); ?></em></p>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <?php
                elseif ( ! $adjacent_content_first ) :
                    if ( ! empty( $short_desc ) ) :
                        ?>
                        <!-- 3a. SHORT DESCRIPTION ONLY -->
                        <!-- <article class="news-detail-content-card"> -->
                        <article class="news-detail-content-card" style="max-width: <?php echo esc_attr( $content_max_w ); ?>px; margin-left: <?php echo esc_attr( $content_ml ); ?>; margin-right: <?php echo esc_attr( $content_mr ); ?>;">
                            <p class="news-detail-description"><em><?php echo esc_html( $short_desc ); ?></em></p>
                        </article>
                        <?php
                    endif;
                endif;
                break;

            case 'content':
                if ( $adjacent_content_first ) :
                    ?>
                    <!-- 3. MAIN ARTICLE CONTENT -->
                    <!-- <article class="news-detail-content-card"> -->
                    <article class="news-detail-content-card" style="max-width: <?php echo esc_attr( $content_max_w ); ?>px; margin-left: <?php echo esc_attr( $content_ml ); ?>; margin-right: <?php echo esc_attr( $content_mr ); ?>;">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <?php if ( ! empty( $short_desc ) ) : ?>
                            <p class="news-detail-description"><em><?php echo esc_html( $short_desc ); ?></em></p>
                        <?php endif; ?>
                    </article>
                    <?php
                elseif ( ! $adjacent_desc_first ) :
                    ?>
                    <!-- 3b. ENTRY-CONTENT ONLY -->
                    <article class="news-detail-content-card" style="max-width: <?php echo esc_attr( $content_max_w ); ?>px; margin-left: <?php echo esc_attr( $content_ml ); ?>; margin-right: <?php echo esc_attr( $content_mr ); ?>;">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <?php
                endif;
                break;

            case 'related':
                ?>
                <!-- 4. NEWEST BLOG ENTRIES (LƯỚI BÀI VIẾT MỚI NHẤT) -->
                <section class="news-detail-related-section">
                    <div class="detail-container" style="max-width: <?php echo esc_attr( $related_max_w ); ?>px; margin-left: <?php echo esc_attr( $related_ml ); ?>; margin-right: <?php echo esc_attr( $related_mr ); ?>;">
                        <h2 class="news-section-title">NEWEST BLOG ENTRIES</h2>

                        <div class="news-grid-2col">
                            <?php
                            $related_query = new WP_Query( array(
                                'post_type'           => 'post',
                                'post_status'         => 'publish',
                                'posts_per_page'      => 6, // 6 bài = 3 hàng x 2 cột như trong ảnh mẫu
                                'post__not_in'        => array( $current_id ),
                                'ignore_sticky_posts' => true,
                            ) );

                            if ( $related_query->have_posts() ) :
                                while ( $related_query->have_posts() ) :
                                    $related_query->the_post();
                                    get_template_part( 'template-parts/content', 'news-card' );
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </section>
                <?php
                break;
        endswitch;
    endforeach;

    if ( $in_container ) {
        echo '</div><!-- .detail-container -->';
        $in_container = false;
    }
    ?>
    </div>

    <script>
        (function () {
            var postTitle = <?php echo wp_json_encode(get_the_title($current_id)); ?>;
            var postUrl = <?php echo wp_json_encode(get_permalink($current_id)); ?>;

            var btn = document.getElementById('btnSharePost');
            var menu = document.getElementById('shareMenu');
            var copyBtn = document.getElementById('shareCopyLink');
            var nativeBtn = document.getElementById('shareNative');
            if (!btn || !menu) return;

            // 1. Mở / đóng menu chia sẻ
            function setOpen(open) {
                menu.classList.toggle('is-open', open);
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            }
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                setOpen(!menu.classList.contains('is-open'));
            });
            // Click ra ngoài menu hoặc nhấn Esc thì đóng
            document.addEventListener('click', function (e) {
                if (!menu.contains(e.target)) setOpen(false);
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') setOpen(false);
            });

            // 2. Mạng xã hội: mở cửa sổ popup nhỏ giữa màn hình
            menu.querySelectorAll('a[data-popup]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var w = 600, h = 520;
                    var left = window.screenX + (window.outerWidth - w) / 2;
                    var top = window.screenY + (window.outerHeight - h) / 2;
                    var popup = window.open(this.href, 'share-popup',
                        'width=' + w + ',height=' + h + ',left=' + left + ',top=' + top);
                    if (popup) {
                        popup.opener = null; // bảo mật: trang kia không điều khiển được trang mình
                        e.preventDefault();
                    } // nếu trình duyệt chặn popup -> link tự mở tab mới (target="_blank")
                    setOpen(false);
                });
            });

            // 3. Sao chép liên kết
            function showCopied() {
                var txt = copyBtn.querySelector('.share-copy-text');
                copyBtn.classList.add('is-copied');
                txt.textContent = 'Đã sao chép!';
                setTimeout(function () {
                    copyBtn.classList.remove('is-copied');
                    txt.textContent = 'Sao chép liên kết';
                }, 2000);
            }
            copyBtn.addEventListener('click', function () {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(postUrl).then(showCopied).catch(function () {
                        prompt('Sao chép liên kết bài viết:', postUrl);
                    });
                } else {
                    prompt('Sao chép liên kết bài viết:', postUrl);
                }
            });

            // 4. Chia sẻ qua ứng dụng có sẵn của thiết bị (chỉ hiện khi trình duyệt hỗ trợ)
            if (navigator.share) {
                nativeBtn.hidden = false;
                nativeBtn.addEventListener('click', function () {
                    navigator.share({ title: postTitle, url: postUrl }).catch(function () { });
                    setOpen(false);
                });
            }
        })();
    </script>

    <?php
endwhile;

get_footer();
