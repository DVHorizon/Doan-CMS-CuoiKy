<?php
/**
 * Template part: Hiển thị 1 Card bài viết phong cách News (ảnh trái - nội dung phải)
 */
?>
<article class="news-card">
    <a href="<?php the_permalink(); ?>" class="news-card-thumb-link">
        <div class="news-card-thumb">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
            <?php else: ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/banner-image.jpg'); ?>"
                    alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
        </div>
    </a>

    <div class="news-card-body">
        <h3 class="news-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="news-card-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="news-card-readmore">Read More</a>
    </div>
</article>