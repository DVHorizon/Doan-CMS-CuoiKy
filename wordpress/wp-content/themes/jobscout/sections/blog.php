<?php
/**
 * Blog Section - NEWEST BLOG ENTRIES
 * Gọi qua widget JobScout_Newest_Blog_Widget để tái sử dụng thống nhất
 * 
 * @package JobScout
 */

the_widget( 'JobScout_Newest_Blog_Widget', array(
    'title'        => 'NEWEST BLOG ENTRIES',
    'number_posts' => 4,
) );