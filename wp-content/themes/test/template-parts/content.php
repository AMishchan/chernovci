<?php
/**
 * Template part for displaying posts.
 */
?>

    <div class="section-block">
        <div class="section-title">
            <h4><?php the_title(); ?></h4>
        </div>
        <img src="<?php the_post_thumbnail_url(); ?>" class="section-left-image">
            <p class="section-text">
                <?php echo wp_trim_words(get_the_content(), 35,'...'); ?>
            </p>
        <div class="section-inner-date-and-more">
            <span class="section-date">
                <?php echo get_the_date(); ?>
            </span>
            <a href="<?php the_permalink(); ?>" class="section-more">
                Детальнiше
            </a>
        </div>
    </div><hr>


