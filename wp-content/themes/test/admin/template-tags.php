<?php
/**
 * Post meta functions
 *
 * @package EasyWP
 */
 
if ( ! function_exists( 'easywp_top_postmeta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function easywp_top_postmeta() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $byline = sprintf(
        _x( '<i class="fa fa-user" aria-hidden="true"></i> by %s', 'post author', 'easywp' ),
        '<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>&nbsp;&nbsp;&nbsp;&nbsp;'
    );

    $posted_on = sprintf(
        _x( '<i class="fa fa-calendar" aria-hidden="true"></i> Posted on %s', 'post date', 'easywp' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>&nbsp;&nbsp;&nbsp;&nbsp;'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    if ( comments_open() ) {
        echo '<span class="comments-link"><i class="fa fa-comments" aria-hidden="true"></i> ';
        comments_popup_link( __( 'Leave a comment', 'easywp' ), __( '1 Comment', 'easywp' ), __( '% Comments', 'easywp' ) );
        echo '</span>';
    }

}
endif;


if ( ! function_exists( 'easywp_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function easywp_entry_footer() {
    if ( 'post' == get_post_type() ) {
        $categories_list = get_the_category_list( ', ' );
        if ( $categories_list ) {
            printf( '<span class="cat-links">' . __( '<i class="fa fa-folder-open" aria-hidden="true"></i> Posted in %1$s', 'easywp' ) . '&nbsp;&nbsp;&nbsp;</span>', $categories_list );
        }
        $tags_list = get_the_tag_list( '', __( ', ', 'easywp' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links">' . __( '<i class="fa fa-tags" aria-hidden="true"></i> Tagged %1$s', 'easywp' ) . '&nbsp;&nbsp;&nbsp;</span>', $tags_list );
        }
    }
    edit_post_link( __( 'Edit', 'easywp' ), '<span class="edit-link">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i> ', '</span>' );
}
endif;
?>