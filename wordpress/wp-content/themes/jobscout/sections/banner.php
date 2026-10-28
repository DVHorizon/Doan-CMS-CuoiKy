<?php
/**
 * Banner Section - Custom Homepage
 * 
 * @package JobScout
 */

$ed_banner = get_theme_mod( 'ed_banner_section', true );
if ( ! $ed_banner ) {
    return;
}

$header_image       = get_header_image();
$banner_bg          = ! empty( $header_image ) ? $header_image : get_template_directory_uri() . '/images/home-banner-pagoda.jpg';
$jobs_page_url      = home_url( '/jobs/' );

// Dynamic Customizer Settings
$banner_title       = get_theme_mod( 'banner_title', 'FIND YOUR DREAM JOBS' );
$banner_subtitle    = get_theme_mod( 'banner_subtitle', "The secret behind our company is simple: to always put ourselves in the other person's shoes-employee, guest or customer. This allows us to see the world through their eyes, anticipate their needs and better understand their feelings." );
$search_placeholder = get_theme_mod( 'banner_search_placeholder', 'Search for jobs, companies, skills' );
$location_label     = get_theme_mod( 'banner_search_location_label', 'Khu vực' );
$search_btn_label   = get_theme_mod( 'banner_search_btn_label', 'SEARCH JOB' );

// Query distinct locations according to teacher's requirement
global $wpdb;
$table = $wpdb->prefix . 'postmeta';
$sql = "SELECT DISTINCT SUBSTRING_INDEX(`meta_value`, ',', -1) as location FROM `{$table}` WHERE `meta_key` LIKE '%location%' AND `meta_value` != '' ORDER BY location";
$location_results = $wpdb->get_results( $wpdb->prepare( $sql ) );
$selected_location = isset( $_GET['search_location'] ) ? sanitize_text_field( $_GET['search_location'] ) : '';
$search_keywords   = isset( $_GET['search_keywords'] ) ? sanitize_text_field( $_GET['search_keywords'] ) : '';
?>

<section id="custom-home-banner" class="custom-home-banner" style="background-image: linear-gradient(rgba(10, 20, 30, 0.45), rgba(10, 15, 25, 0.65)), url('<?php echo esc_url( $banner_bg ); ?>');">
    <div class="banner-container">
        <div class="banner-content">
            <?php if ( ! empty( $banner_title ) ) : ?>
                <h1 class="banner-main-title"><?php echo esc_html( $banner_title ); ?></h1>
            <?php endif; ?>

            <?php if ( ! empty( $banner_subtitle ) ) : ?>
                <p class="banner-main-subtitle">
                    <?php echo wp_kses_post( $banner_subtitle ); ?>
                </p>
            <?php endif; ?>

            <div class="banner-search-box-wrap">
                <form class="banner-job-search-form" method="GET" action="<?php echo esc_url( $jobs_page_url ); ?>">
                    <div class="search-field-group keyword-field">
                        <span class="field-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php echo esc_attr( $search_placeholder ); ?>" value="<?php echo esc_attr( $search_keywords ); ?>">
                    </div>

                    <div class="search-field-group location-field search_location custom-dropdown-wrap" id="customLocationDropdownWrap">
                        <span class="field-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </span>

                        <!-- Native select kept in DOM for form submission and teacher's requirement -->
                        <select id="search_location" name="search_location" class="hidden-native-select">
                            <option value=""><?php echo esc_html( $location_label ); ?></option>
                            <?php if ( ! empty( $location_results ) ) : ?>
                                <?php foreach ( $location_results as $value ) : 
                                    $loc_name = trim( $value->location );
                                    if ( empty( $loc_name ) ) continue;
                                    $selected = ( $selected_location === $loc_name ) ? ' selected' : '';
                                ?>
                                    <option value="<?php echo esc_attr( $loc_name ); ?>"<?php echo $selected; ?>>
                                        <?php echo esc_html( $loc_name ); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <!-- Custom select trigger -->
                        <div class="custom-select-trigger" id="customLocationTrigger" role="button" aria-haspopup="listbox" aria-expanded="false" tabindex="0">
                            <span class="custom-select-label" id="customLocationLabel">
                                <?php echo ! empty( $selected_location ) ? esc_html( $selected_location ) : esc_html( $location_label ); ?>
                            </span>
                            <span class="select-arrow">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </div>

                        <!-- Custom luxury dropdown menu -->
                        <div class="custom-select-menu" id="customLocationMenu" role="listbox">
                            <div class="custom-select-option<?php echo empty( $selected_location ) ? ' is-selected' : ''; ?>" data-value="">
                                <span class="option-text"><?php echo esc_html( $location_label ); ?> (Tất cả)</span>
                                <span class="option-check">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <?php if ( ! empty( $location_results ) ) : ?>
                                <?php foreach ( $location_results as $value ) : 
                                    $loc_name = trim( $value->location );
                                    if ( empty( $loc_name ) ) continue;
                                    $is_selected = ( $selected_location === $loc_name );
                                ?>
                                    <div class="custom-select-option<?php echo $is_selected ? ' is-selected' : ''; ?>" data-value="<?php echo esc_attr( $loc_name ); ?>">
                                        <span class="option-text"><?php echo esc_html( $loc_name ); ?></span>
                                        <span class="option-check">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="search-submit-group">
                        <button type="submit" class="banner-search-submit-btn"><?php echo esc_html( $search_btn_label ); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var wrap = document.getElementById('customLocationDropdownWrap');
    if (!wrap) return;

    var trigger = document.getElementById('customLocationTrigger');
    var label = document.getElementById('customLocationLabel');
    var nativeSelect = document.getElementById('search_location');
    var options = wrap.querySelectorAll('.custom-select-option');

    function toggleDropdown(e) {
        if (e) e.stopPropagation();
        var isOpen = wrap.classList.contains('is-open');
        if (isOpen) {
            closeDropdown();
        } else {
            openDropdown();
        }
    }

    function openDropdown() {
        wrap.classList.add('is-open');
        trigger.setAttribute('aria-expanded', 'true');
    }

    function closeDropdown() {
        wrap.classList.remove('is-open');
        trigger.setAttribute('aria-expanded', 'false');
    }

    trigger.addEventListener('click', toggleDropdown);

    trigger.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggleDropdown();
        } else if (e.key === 'Escape') {
            closeDropdown();
        }
    });

    options.forEach(function(opt) {
        opt.addEventListener('click', function(e) {
            e.stopPropagation();
            var val = opt.getAttribute('data-value');
            var text = opt.querySelector('.option-text').textContent.trim();

            if (val === '') {
                label.textContent = <?php echo json_encode( $location_label ); ?>;
            } else {
                label.textContent = text;
            }

            if (nativeSelect) {
                nativeSelect.value = val;
                var evt = new Event('change', { bubbles: true });
                nativeSelect.dispatchEvent(evt);
            }

            options.forEach(function(o) { o.classList.remove('is-selected'); });
            opt.classList.add('is-selected');

            closeDropdown();
        });
    });

    document.addEventListener('click', function(e) {
        if (!wrap.contains(e.target)) {
            closeDropdown();
        }
    });
});
</script>