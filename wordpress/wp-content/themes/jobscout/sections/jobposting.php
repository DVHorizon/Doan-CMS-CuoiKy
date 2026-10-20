<?php
/**
 * Job Posting Section - TOP JOBS
 * Gọi qua widget JobScout_Top_Jobs_Widget để tái sử dụng thống nhất
 * 
 * @package JobScout
 */

the_widget( 'JobScout_Top_Jobs_Widget', array(
    'title'          => 'TOP JOBS',
    'number_of_jobs' => 6,
    'show_cta_btn'   => true,
    'cta_btn_text'   => 'VIEW MORE JOBS',
) );