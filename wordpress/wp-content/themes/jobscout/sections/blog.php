<?php
/**
 * Blog Section - NEWEST BLOG ENTRIES
 * Gọi qua widget JobScout_Newest_Blog_Widget để tái sử dụng thống nhất
 * 
 * @package JobScout
 */

$ed_blog = get_theme_mod( 'ed_blog_section', true );
if ( ! $ed_blog ) {
    return;
}

$blog_title   = get_theme_mod( 'blog_section_title', 'NEWEST BLOG ENTRIES' );
$number_posts = get_theme_mod( 'blog_section_number_posts', 4 );

the_widget( 'JobScout_Newest_Blog_Widget', array(
    'title'        => $blog_title,
    'number_posts' => intval( $number_posts ),
) );