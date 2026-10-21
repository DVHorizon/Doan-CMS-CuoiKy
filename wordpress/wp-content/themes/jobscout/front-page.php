<?php
/**
 * Front Page
 * 
 * @package JobScout
 */

$home_sections = jobscout_get_home_sections();

get_header();

get_template_part( 'sections/banner' );
get_template_part( 'sections/jobposting' );
get_template_part( 'sections/cta' );
get_template_part( 'sections/blog' );

get_footer();