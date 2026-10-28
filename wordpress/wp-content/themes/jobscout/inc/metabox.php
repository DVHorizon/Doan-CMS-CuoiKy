<?php 
/**
* JobScout Metabox for Sidebar Layout
*
* @package JobScout
*
*/ 

function jobscout_add_sidebar_layout_box(){
    $post_id   = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $shop_id   = get_option( 'woocommerce_shop_page_id' );
    $template  = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = array( 'templates/portfolio.php' );
    
    /**
     * Remove sidebar metabox in specific page template.
    */
    if( ! in_array( $template, $templates ) && ( $shop_id != $post_id ) ){
        add_meta_box( 
            'jobscout_sidebar_layout',
            __( 'Sidebar Layout', 'jobscout' ),
            'jobscout_sidebar_layout_callback', 
            'page',
            'normal',
            'high'
        );
    }

    //for post
    add_meta_box( 
        'jobscout_sidebar_layout',
        __( 'Sidebar Layout', 'jobscout' ),
        'jobscout_sidebar_layout_callback', 
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jobscout_add_sidebar_layout_box' );


/**
 * Get sidebar layout data.
 *
 * @return array
 */
if( ! function_exists( 'jobscout_get_sidebar_layout_data' ) ){
    function jobscout_get_sidebar_layout_data(){
        return array(
            'default-sidebar'=> array(
                'value'     => 'default-sidebar',
                'label'     => __( 'Default Sidebar', 'jobscout' ),
                'thumbnail' => get_template_directory_uri() . '/images/default-sidebar.png'
            ),
            'no-sidebar'     => array(
                'value'     => 'no-sidebar',
                'label'     => __( 'Full Width', 'jobscout' ),
                'thumbnail' => get_template_directory_uri() . '/images/full-width.png'
            ),
            'left-sidebar' => array(
                'value'     => 'left-sidebar',
                'label'     => __( 'Left Sidebar', 'jobscout' ),
                'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'         
            ),
            'right-sidebar' => array(
                'value'     => 'right-sidebar',
                'label'     => __( 'Right Sidebar', 'jobscout' ),
                'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'         
            )    
        );
    }
}

function jobscout_sidebar_layout_callback(){
    global $post;
    $jobscout_sidebar_layout = jobscout_get_sidebar_layout_data();
    wp_nonce_field( basename( __FILE__ ), 'jobscout_nonce' ); ?>
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'jobscout' ); ?></em></td>
        </tr>    
        <tr>
            <td>
                <?php  
                    foreach( $jobscout_sidebar_layout as $field ){  
                        $layout = get_post_meta( $post->ID, '_jobscout_sidebar_layout', true ); ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="jobscout_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                            </label>
                        </div>
                        <?php 
                    } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>  
    </table>
 <?php 
}

function jobscout_save_sidebar_layout( $post_id ){
    $jobscout_sidebar_layout = jobscout_get_sidebar_layout_data();


    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'jobscout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'jobscout_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    if('page' == $_POST['post_type'] ){  
        if( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( ! current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }
    
    $layout = isset( $_POST['jobscout_sidebar_layout'] ) ? sanitize_key( $_POST['jobscout_sidebar_layout'] ) : 'default-sidebar';

    if( array_key_exists( $layout, $jobscout_sidebar_layout ) ){
        update_post_meta( $post_id, '_jobscout_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, '_jobscout_sidebar_layout' );
    }           
}
add_action( 'save_post' , 'jobscout_save_sidebar_layout' );

/**
 * Metabox for Job Detail Sections (4 phần mô tả chi tiết công việc)
 */
function jobscout_add_job_detail_sections_box() {
    add_meta_box(
        'jobscout_job_sections_meta',
        __( 'Nội dung chi tiết 4 phần (Job Detail Sections)', 'jobscout' ),
        'jobscout_job_sections_meta_callback',
        'job_listing',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jobscout_add_job_detail_sections_box' );

function jobscout_job_sections_meta_callback( $post ) {
    wp_nonce_field( 'jobscout_job_sections_nonce_action', 'jobscout_job_sections_nonce' );

    $overview = get_post_meta( $post->ID, '_job_overview', true );
    $skills   = get_post_meta( $post->ID, '_job_skills', true );
    $love     = get_post_meta( $post->ID, '_job_love_working_here', true );
    $location = get_post_meta( $post->ID, '_job_location_desc', true );
    ?>
    <style>
        .job-meta-field { margin-bottom: 20px; }
        .job-meta-field label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 6px; color: #1e293b; }
        .job-meta-field textarea { width: 100%; min-height: 110px; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13.5px; line-height: 1.6; }
        .job-meta-field .desc { font-size: 12px; color: #64748b; margin-top: 4px; font-style: italic; }
    </style>
    <div class="job-meta-field">
        <label for="_job_overview"><?php esc_html_e( '1. Overview about Company (Mô tả công ty)', 'jobscout' ); ?></label>
        <textarea id="_job_overview" name="_job_overview" rows="5"><?php echo esc_textarea( $overview ); ?></textarea>
        <p class="desc"><?php esc_html_e( 'Nếu để trống, hệ thống sẽ tự động dùng nội dung cấu hình trong Giao diện -> Tùy biến (Customize).', 'jobscout' ); ?></p>
    </div>

    <div class="job-meta-field">
        <label for="_job_skills"><?php esc_html_e( '2. Our Key Skills (Kỹ năng yêu cầu)', 'jobscout' ); ?></label>
        <textarea id="_job_skills" name="_job_skills" rows="4"><?php echo esc_textarea( $skills ); ?></textarea>
        <p class="desc"><?php esc_html_e( 'Nếu để trống, hệ thống sẽ tự động dùng nội dung cấu hình trong Giao diện -> Tùy biến (Customize).', 'jobscout' ); ?></p>
    </div>

    <div class="job-meta-field">
        <label for="_job_love_working_here"><?php esc_html_e( '3. Why You\'ll Love Working Here (Tại sao bạn thích làm việc ở đây / Chế độ đãi ngộ)', 'jobscout' ); ?></label>
        <textarea id="_job_love_working_here" name="_job_love_working_here" rows="5"><?php echo esc_textarea( $love ); ?></textarea>
        <p class="desc"><?php esc_html_e( 'Nếu để trống, hệ thống sẽ tự động dùng nội dung cấu hình trong Giao diện -> Tùy biến (Customize).', 'jobscout' ); ?></p>
    </div>

    <div class="job-meta-field">
        <label for="_job_location_desc"><?php esc_html_e( '4. Location (Mô tả vị trí làm việc)', 'jobscout' ); ?></label>
        <textarea id="_job_location_desc" name="_job_location_desc" rows="4"><?php echo esc_textarea( $location ); ?></textarea>
        <p class="desc"><?php esc_html_e( 'Nếu để trống, hệ thống sẽ tự động dùng nội dung cấu hình trong Giao diện -> Tùy biến (Customize).', 'jobscout' ); ?></p>
    </div>
    <?php
}

function jobscout_save_job_sections_meta( $post_id ) {
    if ( ! isset( $_POST['jobscout_job_sections_nonce'] ) || ! wp_verify_nonce( $_POST['jobscout_job_sections_nonce'], 'jobscout_job_sections_nonce_action' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array( '_job_overview', '_job_skills', '_job_love_working_here', '_job_location_desc' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $val = wp_kses_post( wp_unslash( $_POST[ $field ] ) );
            if ( ! empty( trim( $val ) ) ) {
                update_post_meta( $post_id, $field, $val );
            } else {
                delete_post_meta( $post_id, $field );
            }
        }
    }
}
add_action( 'save_post_job_listing', 'jobscout_save_job_sections_meta' );