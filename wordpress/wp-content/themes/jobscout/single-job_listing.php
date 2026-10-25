<?php
/**
 * The template for displaying all single job posts.
 *
 * Custom Single Job Detail Template matching design specification
 * Fully customizable via Admin Customizer -> Job Detail Settings
 *
 * @package JobScout
 */

get_header(); ?>

<div id="primary" class="content-area single-job-detail-page-wrapper">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'job-single' );
        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php 
get_footer();