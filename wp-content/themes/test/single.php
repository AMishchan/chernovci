<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EasyWP
 */
?>
<?php get_header(); ?>

<div class="container">
    <div class="row">

        <?php get_sidebar();?>

        <div class="col-sm-6">

            <?php if (have_posts()) : ?>
                <section class="main">
                    <?php while (have_posts()) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', 'single' ); ?>

                    <?php endwhile; ?>

                </section>

            <?php else : ?>

                <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>

        </div>

        <?php get_sidebar('right'); ?>

    </div>
</div>
<?php get_footer(); ?>

