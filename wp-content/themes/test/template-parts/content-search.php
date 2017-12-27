<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EasyWP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('postbox'); ?>>

    <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <?php if ( 'post' == get_post_type() ) : ?>
            <div class="entry-meta">
                    <?php easywp_top_postmeta(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-summary clearfix">
            <?php easywp_blog_post_style();

            wp_link_pages( array(
             'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'easywp' ) . '</span>',
             'after'       => '</div>',
             'link_before' => '<span>',
             'link_after'  => '</span>',
             ) );
             ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php easywp_entry_footer(); ?>
    </footer><!-- .entry-footer -->
        
</article>