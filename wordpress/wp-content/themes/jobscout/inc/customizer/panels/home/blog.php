<?php
/**
 * Blog Section
 *
 * @package jobscout
 */
if ( ! function_exists( 'jobscout_customize_register_frontpage_blog' ) ) :

function jobscout_customize_register_frontpage_blog( $wp_customize ){

    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'jobscout' ),
            'priority' => 35,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Enable/Disable Section */
    $wp_customize->add_setting( 
        'ed_blog_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'jobscout_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new JobScout_Toggle_Control( 
            $wp_customize,
            'ed_blog_section',
            array(
                'section'     => 'blog_section',
                'label'       => __( 'Enable/Disable Blog Section', 'jobscout' ),
                'description' => __( 'Enable Blog Section to display latest posts in the Front Page', 'jobscout' ),
            )
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'NEWEST BLOG ENTRIES', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section'     => 'blog_section',
            'label'       => __( 'Tiêu đề khối bài viết (Blog Title)', 'jobscout' ),
            'description' => __( 'Tiêu đề hiển thị phía trên danh sách bài viết blog.', 'jobscout' ),
            'type'        => 'text',
        )
    );

    /** Number of Posts */
    $wp_customize->add_setting(
        'blog_section_number_posts',
        array(
            'default'           => 4,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        )
    );
    
    $wp_customize->add_control(
        'blog_section_number_posts',
        array(
            'section'     => 'blog_section',
            'label'       => __( 'Số lượng bài viết hiển thị', 'jobscout' ),
            'description' => __( 'Nhập số lượng bài viết muốn hiển thị dạng lưới (VD: 2, 4, 6...).', 'jobscout' ),
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1,
                'max'  => 30,
                'step' => 1,
            ),
        )
    );
    /** Blog Section Ends */  

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_frontpage_blog' );