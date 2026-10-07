<?php
/**
 * Title: Header
 * Slug: car-exhibition/header
 * Categories: header, car-exhibition
 * Keywords: header
 * Block Types: core/template-part/header
 */
?>

<!-- wp:group {"align":"wide","className":"header-wrap","style":{"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"layout":{"type":"constrained","justifyContent":"center","contentSize":"100%"}} -->
<div class="wp-block-group alignwide header-wrap" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:group {"className":"header-top","layout":{"type":"constrained","contentSize":"70%"}} -->
<div class="wp-block-group header-top"><!-- wp:group {"className":"header-top-inner","style":{"spacing":{"padding":{"top":"10px","bottom":"10px"}}},"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group header-top-inner" style="padding-top:10px;padding-bottom:10px"><!-- wp:columns {"verticalAlignment":"center","className":"header-top-boxes"} -->
<div class="wp-block-columns are-vertically-aligned-center header-top-boxes"><!-- wp:column {"verticalAlignment":"center","width":"10%","className":"header-blank-box1"} -->
<div class="wp-block-column is-vertically-aligned-center header-blank-box1" style="flex-basis:10%"></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"15%","className":"header-phone-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-phone-box" style="flex-basis:15%"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|link-color"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"}},"textColor":"link-color","fontFamily":"body"} -->
<p class="has-link-color-color has-text-color has-link-color has-body-font-family" style="font-size:14px;font-style:normal;font-weight:400"><img class="wp-image-21" style="width: 48px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/phone.png" alt=""><a href="tel:+1234567890" data-type="tel" data-id="tel:+1234567890"><?php esc_html_e('+1234567890','car-exhibition'); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-mail-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-mail-box" style="flex-basis:20%"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|link-color"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"}},"textColor":"link-color","fontFamily":"body"} -->
<p class="has-link-color-color has-text-color has-link-color has-body-font-family" style="font-size:14px;font-style:normal;font-weight:400"><img class="wp-image-22" style="width: 48px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/mail.png" alt=""><a href="mailto:festivora@example.com"></a><a href="mailto:festivora@example.com"><?php esc_html_e('AutoExpo@example.com','car-exhibition'); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"45%","className":"header-text-box"} -->
<div class="wp-block-column is-vertically-aligned-center header-text-box" style="flex-basis:45%"><!-- wp:paragraph {"align":"right","style":{"elements":{"link":{"color":{"text":"var:preset|color|link-color"}}},"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"400"}},"textColor":"link-color","fontFamily":"body"} -->
<p class="has-text-align-right has-link-color-color has-text-color has-link-color has-body-font-family" style="font-size:14px;font-style:normal;font-weight:400;text-transform:capitalize"><img class="wp-image-24" style="width: 48px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/announce.png" alt=""><a href="#"><?php esc_html_e('Limited VIP Passes – Reserve Yours Today!','car-exhibition'); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"10%","className":"header-blank-box2"} -->
<div class="wp-block-column is-vertically-aligned-center header-blank-box2" style="flex-basis:10%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"header-bottom","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"20px","bottom":"20px"}}},"layout":{"type":"constrained","contentSize":"70%"}} -->
<div class="wp-block-group header-bottom" style="margin-top:0px;margin-bottom:0px;padding-top:20px;padding-bottom:20px"><!-- wp:columns {"verticalAlignment":"center","className":"header-btm-boxes","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center header-btm-boxes"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-btm-left"} -->
<div class="wp-block-column is-vertically-aligned-center header-btm-left" style="flex-basis:20%"><!-- wp:group {"className":"logo-box","layout":{"type":"constrained"}} -->
<div class="wp-block-group logo-box"><!-- wp:site-title {"level":0,"style":{"typography":{"fontSize":"30px","fontStyle":"normal","fontWeight":"700"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"60%","className":"header-btm-middle"} -->
<div class="wp-block-column is-vertically-aligned-center header-btm-middle" style="flex-basis:60%"><!-- wp:navigation {"textColor":"link-color","icon":"menu","overlayBackgroundColor":"primary","overlayTextColor":"base","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account","woocommerce/mini-cart"]},"style":{"spacing":{"blockGap":"25px"},"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"14px","textTransform":"capitalize"}},"fontFamily":"body","layout":{"type":"flex","justifyContent":"left"}} -->
<!-- wp:navigation-link {"label":"Home","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Exhibitors","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Schedule","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Speakers","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Buy Now","opensInNewTab":true,"url":"https://www.theclassictemplates.com/products/auto-expo-wordpress-theme","kind":"custom","isTopLevelLink":true} /-->

<!-- /wp:navigation --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-btm-right"} -->
<div class="wp-block-column is-vertically-aligned-center header-btm-right" style="flex-basis:20%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"link-color","style":{"elements":{"link":{"color":{"text":"var:preset|color|link-color"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600"},"border":{"radius":"6px"},"spacing":{"padding":{"left":"18px","right":"18px","top":"10px","bottom":"10px"}}},"fontFamily":"body"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-link-color-color has-text-color has-link-color has-body-font-family has-custom-font-size wp-element-button" href="#" style="border-radius:6px;padding-top:10px;padding-right:18px;padding-bottom:10px;padding-left:18px;font-size:14px;font-style:normal;font-weight:600"><?php esc_html_e('Get Tickets','car-exhibition'); ?><img class="wp-image-31" style="width: 10px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/arrow-right.png" alt=""></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->