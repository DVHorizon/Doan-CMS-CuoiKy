<?php
/**
 * Banner Section - Custom Homepage
 * 
 * @package JobScout
 */

$banner_bg = get_template_directory_uri() . '/images/home-banner-pagoda.jpg';
$jobs_page_url = home_url( '/jobs/' );

// Query distinct locations according to teacher's requirement
global $wpdb;
$location_query = "SELECT DISTINCT SUBSTRING_INDEX(`meta_value`, ',', -1) as location 
                   FROM `{$wpdb->postmeta}` 
                   WHERE `meta_key` LIKE '%location%' AND `meta_value` != '' 
                   ORDER BY location ASC";
$location_results = $wpdb->get_results( $location_query );
$selected_location = isset( $_GET['search_location'] ) ? sanitize_text_field( $_GET['search_location'] ) : '';
$search_keywords   = isset( $_GET['search_keywords'] ) ? sanitize_text_field( $_GET['search_keywords'] ) : '';
?>

<section id="custom-home-banner" class="custom-home-banner" style="background-image: linear-gradient(rgba(10, 20, 30, 0.45), rgba(10, 15, 25, 0.65)), url('<?php echo esc_url( $banner_bg ); ?>');">
    <div class="banner-container">
        <div class="banner-content">
            <h1 class="banner-main-title">FIND YOUR DREAM JOBS</h1>
            <p class="banner-main-subtitle">
                The secret behind our company is simple: to always put ourselves in the other person's shoes-employee, guest or customer. This allows us to see the world through their eyes, anticipate their needs and better understand their feelings.
            </p>

            <div class="banner-search-box-wrap">
                <form class="banner-job-search-form" method="GET" action="<?php echo esc_url( $jobs_page_url ); ?>">
                    <div class="search-field-group keyword-field">
                        <span class="field-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <input type="text" id="search_keywords" name="search_keywords" placeholder="Search for jobs, companies, skills" value="<?php echo esc_attr( $search_keywords ); ?>">
                    </div>

                    <div class="search-field-group location-field">
                        <span class="field-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea6a1b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </span>
                        <select id="search_location" name="search_location">
                            <option value="">Tokyo</option>
                            <?php 
                            if ( ! empty( $location_results ) ) {
                                foreach ( $location_results as $loc ) {
                                    $loc_name = trim( $loc->location );
                                    if ( ! empty( $loc_name ) && strcasecmp( $loc_name, 'Tokyo' ) !== 0 ) {
                                        $selected = ( $selected_location === $loc_name ) ? ' selected' : '';
                                        echo '<option value="' . esc_attr( $loc_name ) . '"' . $selected . '>' . esc_html( $loc_name ) . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                        <span class="select-arrow">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </div>

                    <div class="search-submit-group">
                        <button type="submit" class="banner-search-submit-btn">SEARCH JOB</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>