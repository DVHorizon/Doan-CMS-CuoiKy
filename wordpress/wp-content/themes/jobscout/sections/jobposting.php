<?php
/**
 * Job Posting Section - TOP JOBS
 * Gọi qua widget JobScout_Top_Jobs_Widget để tái sử dụng thống nhất
 * 
 * @package JobScout
 */

$ed_jobposting = get_theme_mod( 'ed_jobposting_section', true );
if ( ! $ed_jobposting ) {
    return;
}

$title          = get_theme_mod( 'job_posting_section_title', 'TOP JOBS' );
$number_of_jobs = get_theme_mod( 'job_posting_number_of_jobs', 6 );
$cta_btn_text   = get_theme_mod( 'job_posting_cta_btn_text', 'VIEW MORE JOBS' );

the_widget( 'JobScout_Top_Jobs_Widget', array(
    'title'          => $title,
    'number_of_jobs' => intval( $number_of_jobs ),
    'show_cta_btn'   => true,
    'cta_btn_text'   => $cta_btn_text,
) );