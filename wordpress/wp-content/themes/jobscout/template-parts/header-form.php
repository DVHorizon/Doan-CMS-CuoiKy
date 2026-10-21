<?php
/**
 *
 * Creating a custom job search form for homepage
 * The [jobs] shortcode will use search_location and search_keywords variables from the query string.
 *
 * @link https://wpjobmanager.com/document/tutorial-creating-custom-job-search-form/
 *
 * @package JobScout
 */
$find_a_job_link = get_option( 'job_manager_jobs_page_id', 0 );
$post_slug       = get_post_field( 'post_name', $find_a_job_link );
$ed_job_category = get_option( 'job_manager_enable_categories' );  

if( $post_slug ){
    $action_page = home_url( '/'. $post_slug );
}else {
    $action_page = home_url( '/jobs/' );
}

global $wpdb;
$table = $wpdb->prefix . 'postmeta';
$sql = "SELECT DISTINCT SUBSTRING_INDEX(`meta_value`, ',', -1) as location FROM `{$table}` WHERE `meta_key` LIKE '%location%' AND `meta_value` != '' ORDER BY location";
$data = $wpdb->get_results( $wpdb->prepare( $sql ) );
$selected_location = isset( $_GET['search_location'] ) ? sanitize_text_field( $_GET['search_location'] ) : '';
$search_keywords   = isset( $_GET['search_keywords'] ) ? sanitize_text_field( $_GET['search_keywords'] ) : '';
?>

<div class="job_listings">

  <form class="jobscout_job_filters" method="GET" action="<?php echo esc_url( $action_page ); ?>">
    <div class="search_jobs">

      <div class="search_keywords">
        <label for="search_keywords"><?php esc_html_e( 'Keywords', 'jobscout' ); ?></label>
        <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php echo esc_attr__( 'Tìm kiếm công việc, kỹ năng, công ty...', 'jobscout' ); ?>" value="<?php echo esc_attr( $search_keywords ); ?>">
      </div>

      <div class="search_location">
        <label for="search_location"><?php esc_html_e( 'Location', 'jobscout' ); ?></label>
        <select id="search_location" name="search_location">
          <option value=""><?php echo esc_html__( 'Khu vực', 'jobscout' ); ?></option>
          <?php if ( ! empty( $data ) ) : foreach ( $data as $value ) : 
              $loc_name = trim( $value->location );
              if ( empty( $loc_name ) ) continue;
              $selected = ( $selected_location === $loc_name ) ? ' selected' : '';
          ?>
            <option value="<?php echo esc_attr( $loc_name ); ?>"<?php echo $selected; ?>><?php echo esc_html( $loc_name ); ?></option>
          <?php endforeach; endif; ?>
        </select>
      </div>
      
      <?php if( $ed_job_category ){ ?>
          <div class="search_categories custom_search_categories">
            <label for="search_category"><?php esc_html_e( 'Job Category', 'jobscout' ); ?></label>
            <select id="search_category" class="robo-search-category" name="search_category">
            <option value=""><?php _e( 'Chọn danh mục', 'jobscout' ); ?></option>
              <?php foreach ( get_job_listing_categories() as $jobcat ) : ?>
                <option value="<?php echo esc_attr( $jobcat->term_id ); ?>"><?php echo esc_html( $jobcat->name ); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      <?php } ?>
      
      <div class="search_submit">
        <input type="submit" value="<?php echo esc_attr__( 'TÌM VIỆC', 'jobscout' ); ?>" />
      </div>

    </div>
  </form>

</div>