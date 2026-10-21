<?php
/**
 * CTA Section - CAREER WITH US
 * 
 * @package JobScout
 */

$career_bg = get_template_directory_uri() . '/images/home-career-sakura.jpg';
$about_url = home_url( '/about/' );
?>

<section id="custom-career-section" class="custom-career-section" style="background-image: linear-gradient(rgba(20, 15, 12, 0.72), rgba(15, 10, 8, 0.88)), url('<?php echo esc_url( $career_bg ); ?>');">
    <div class="career-container">
        <h2 class="career-section-title">CAREER WITH US</h2>
        
        <div class="career-text-block">
            <p>
                Plan Do See Global is a hospitality group founded in Japan and rooted in "Omotenashi", the Japanese principle of selfless hospitality. We strive to deliver unforgettable and bespoke experiences, to understand local cultures like natives, to provide service that is warm but not intrusive, and to foresee our guests' every need at all times. That is our sole mission and our pride.
            </p>
            <p>
                We are experts in all stages of project development: concept, design, implementation and management. We love to find unique ways to create experiences that surprise and delight guests and customers.
            </p>
        </div>

        <div class="career-btn-wrap">
            <a href="<?php echo esc_url( $about_url ); ?>" class="btn-more-about-us">MORE ABOUT US</a>
        </div>
    </div>
</section>