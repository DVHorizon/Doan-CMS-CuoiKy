<?php
/**
 * Template part: Hiển thị 1 Card bài viết phong cách News (ảnh trái - nội dung phải)
 */
?>
<article class="news-card">
    <a href="<?php the_permalink(); ?>" class="news-card-thumb-link">
        <div class="news-card-thumb">
            <?php jobscout_news_thumbnail( 'medium_large' ); ?>
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