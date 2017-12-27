<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EasyWP
 */

?>
<div class="section-block">
    <div class="section-title">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h4><?php the_title(); ?></h4>
                </div>
<!--                <div class="col-xs-6">-->
<!--                    <div class="section-inner-date-and-more">-->
<!--                        <span class="section-date">-->
<!--                            --><?php //the_date(); ?>
<!--                        </span>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>


    </div>
    <img src="<?php the_post_thumbnail_url(); ?>" class="section-left-image">
    <p class="section-text">
        <?php the_content(); ?>
    </p>
</div><hr>