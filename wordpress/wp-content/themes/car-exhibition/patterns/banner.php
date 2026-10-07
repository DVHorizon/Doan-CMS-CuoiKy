<?php
/**
 * Title: Banner
 * Slug: car-exhibition/banner
 * Categories: car-exhibition
 * Keywords: banner
 * Block Types: core/post-content
 * Post Types: page, wp_template
 */

$car_exhibition_pluginsList = get_option( 'active_plugins' );
$car_exhibition_plugin = 'contact-form-7/wp-contact-form-7.php';
$car_exhibition_results = in_array( $car_exhibition_plugin , $car_exhibition_pluginsList);
if ( $car_exhibition_results )  {
?>

<!-- wp:group {"metadata":{"name":"Banner"},"className":"slider-section","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group slider-section" style="margin-top:0px;margin-bottom:0px;padding-right:0px;padding-left:0px"><!-- wp:cover {"isUserOverlayColor":false,"minHeight":600,"sizeSlug":"full","align":"center","className":"banner-cover","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"layout":{"type":"constrained","contentSize":"70%"}} -->
<div class="wp-block-cover aligncenter banner-cover" style="padding-top:0;padding-right:var(--wp--preset--spacing--20);padding-bottom:0;padding-left:var(--wp--preset--spacing--20);min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"banner-content","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-content"><!-- wp:group {"className":"slider-top","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group slider-top" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","className":"banner-heading wow fadeInDown","style":{"typography":{"fontSize":"60px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"body"} -->
<h2 class="wp-block-heading has-text-align-center banner-heading wow fadeInDown has-body-font-family" style="font-size:60px;font-style:normal;font-weight:700"><?php esc_html_e('Where Innovation Meets the Road','car-exhibition'); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"slider-searchform-dynamic wow fadeInDown","layout":{"type":"constrained"}} -->
<div class="wp-block-group slider-searchform-dynamic wow fadeInDown"><!-- wp:shortcode -->
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"slider-bottom wow fadeInDown","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group slider-bottom wow fadeInDown"><!-- wp:group {"className":"owl-carousel","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group owl-carousel" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:image {"id":42,"width":"600px","height":"250px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider1.png" alt="" class="wp-image-42" style="object-fit:cover;width:600px;height:250px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":42,"width":"600px","height":"250px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider2.png" alt="" class="wp-image-42" style="object-fit:cover;width:600px;height:250px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":44,"width":"600px","height":"250px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider3.png" alt="" class="wp-image-44" style="object-fit:cover;width:600px;height:250px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<?php } else { ?>

<!-- wp:group {"metadata":{"name":"Banner"},"className":"slider-section","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"right":"0px","left":"0px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group slider-section" style="margin-top:0px;margin-bottom:0px;padding-right:0px;padding-left:0px"><!-- wp:cover {"isUserOverlayColor":false,"minHeight":600,"sizeSlug":"full","align":"center","className":"banner-cover","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"layout":{"type":"constrained","contentSize":"70%"}} -->
<div class="wp-block-cover aligncenter banner-cover" style="padding-top:0;padding-right:var(--wp--preset--spacing--20);padding-bottom:0;padding-left:var(--wp--preset--spacing--20);min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"banner-content","layout":{"type":"constrained"}} -->
<div class="wp-block-group banner-content"><!-- wp:group {"className":"slider-top","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group slider-top" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","className":"banner-heading wow fadeInDown","style":{"typography":{"fontSize":"60px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"body"} -->
<h2 class="wp-block-heading has-text-align-center banner-heading wow fadeInDown has-body-font-family" style="font-size:60px;font-style:normal;font-weight:700"><?php esc_html_e('Where Innovation Meets the Road','car-exhibition'); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"slider-searchform-static wow fadeInDown","layout":{"type":"constrained"}} -->
<div class="wp-block-group slider-searchform-static wow fadeInDown"><!-- wp:html -->
<div class="search-box">
    <div class="field">
        <label><?php esc_html_e('City / Venue','car-exhibition'); ?></label>
        <span class="location"><?php esc_html_e('Select Expo Location','car-exhibition'); ?> <i class="icon"></i></span>
    </div>

    <div class="divider"></div>

    <div class="field">
        <label><?php esc_html_e('Event Days','car-exhibition'); ?></label>
        <span class="days"><?php esc_html_e('Choose Date ','car-exhibition'); ?></span>
    </div>

    <div class="divider"></div>

    <div class="field">
        <label><?php esc_html_e('Exhibitor / Category','car-exhibition'); ?></label>
        <span class="category"><?php esc_html_e('Select Category ','car-exhibition'); ?></span>
    </div>

    <div class="divider"></div>

    <div class="field">
        <label><?php esc_html_e('Pass Type','car-exhibition'); ?></label>
        <span class="pass"><?php esc_html_e('Choose Pass ','car-exhibition'); ?></span>
    </div>

    <a href="#" class="search-btn">
        <i class="icon"></i>
    </a>
</div>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"slider-bottom wow fadeInDown","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group slider-bottom wow fadeInDown"><!-- wp:group {"className":"owl-carousel","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group owl-carousel" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:image {"id":42,"width":"600px","height":"250px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider1.png" alt="" class="wp-image-42" style="object-fit:cover;width:600px;height:250px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":42,"width":"600px","height":"250px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider2.png" alt="" class="wp-image-42" style="object-fit:cover;width:600px;height:250px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"id":44,"width":"600px","height":"250px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider3.png" alt="" class="wp-image-44" style="object-fit:cover;width:600px;height:250px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<?php } ?>    