<?php
/**
 * Decides how posts should be displayed on Homepage, Category Pages, Archive Pages and Search Pages
 *
 * @package EasyWP
 */

function easywp_blog_post_style() {
    if ( easywp_get_option('blogpoststyle') ) :
        if ( easywp_get_option('blogpoststyle') == 'excerpt' ) :
            if ( has_post_thumbnail() ) {
                if ( 1 === easywp_get_option('hide_thumbnail') ) {
                } else { ?>
                <?php if ( easywp_get_option('thumbnail_link') == 'no' ) { ?>
                    <?php the_post_thumbnail('easywp-featured-image', array('class' => 'easywp-post-thumbnail')); ?>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('easywp-featured-image', array('class' => 'easywp-post-thumbnail')); ?></a>
                <?php }
                }
            }
            the_excerpt();
        else :
            if ( has_post_thumbnail() ) {
                if ( 1 === easywp_get_option('hide_thumbnail') ) {
                } else { ?>
                <?php if ( easywp_get_option('thumbnail_link') == 'no' ) { ?>
                    <?php the_post_thumbnail('easywp-featured-image', array('class' => 'easywp-post-thumbnail entry-featured-image-block')); ?>
                <?php } else { ?>
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('easywp-featured-image', array('class' => 'easywp-post-thumbnail entry-featured-image-block')); ?></a>
                <?php }
                }
            }
            the_content( sprintf(
                    __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'easywp' ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
        endif;
    else : 
        if ( has_post_thumbnail() ) {
                if ( 1 === easywp_get_option('hide_thumbnail') ) {
                } else { ?>
                <?php if ( easywp_get_option('thumbnail_link') == 'no' ) { ?>
                        <?php the_post_thumbnail('easywp-featured-image', array('class' => 'easywp-post-thumbnail')); ?>
                <?php } else { ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('easywp-featured-image', array('class' => 'easywp-post-thumbnail')); ?></a>
                <?php }
                }
        }
        the_excerpt();
    endif;
}

// Customizer Options
function easywp_customizer_css() {
    ?>
    <style type="text/css">
        <?php if ( easywp_get_option('body_text_color') ) { ?>
            body,button,input,select,textarea {color: <?php echo esc_attr( easywp_get_option('body_text_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('link_color') ) { ?>
        a {color: <?php echo esc_attr( easywp_get_option('link_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('link_hover_color') ) { ?>
        a:hover {color: <?php echo esc_attr( easywp_get_option('link_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('header_bg_color') ) { ?>
        #easywp-header-wrapper {background: <?php echo esc_attr( easywp_get_option('header_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('header_bd_color_one') ) { ?>
        #easywp-header-wrapper {border-left: 1px solid <?php echo esc_attr( easywp_get_option('header_bd_color_one') ); ?>; border-right: 1px solid <?php echo esc_attr( easywp_get_option('header_bd_color_one') ); ?>; border-top: 1px solid <?php echo esc_attr( easywp_get_option('header_bd_color_one') ); ?>;}
        <?php } ?>
        <?php if ( easywp_get_option('header_bd_color_two') ) { ?>
        #easywp-header-inner {border-left: 1px solid <?php echo esc_attr( easywp_get_option('header_bd_color_two') ); ?>; border-right: 1px solid <?php echo esc_attr( easywp_get_option('header_bd_color_two') ); ?>; border-top: 1px solid <?php echo esc_attr( easywp_get_option('header_bd_color_two') ); ?>;}
        <?php } ?>
        <?php if ( easywp_get_option('menu_bg_color') ) { ?>
        .easywp-nav-primary {background: <?php echo esc_attr( easywp_get_option('menu_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('menu_bd_color') ) { ?>
        .easywp-nav-primary {border-top:1px solid <?php echo esc_attr( easywp_get_option('menu_bd_color') ); ?>;border-bottom:1px solid <?php echo esc_attr( easywp_get_option('menu_bd_color') ); ?>; ?>}
        <?php } ?>
        <?php if ( easywp_get_option('menu_color') ) { ?>
        .easywp-nav-primary a {color: <?php echo esc_attr( easywp_get_option('menu_color') ); ?>}
        @media only screen and (max-width: 1167px) {
        .easywp-nav-menu.easywp-responsive-menu > .menu-item-has-children:before {color: <?php echo esc_attr( easywp_get_option('menu_color') ); ?>}
        .easywp-nav-menu.easywp-responsive-menu > ul > .page_item_has_children:before {color: <?php echo esc_attr( easywp_get_option('menu_color') ); ?>}
        }
        <?php } ?>
        <?php if ( easywp_get_option('menu_hover_color') ) { ?>
        .easywp-nav-primary a:hover,.easywp-nav-primary .current-menu-item > a {color: <?php echo esc_attr( easywp_get_option('menu_hover_color') ); ?>}
        .easywp-nav-primary a:hover,.easywp-nav-primary .current_page_item > a {color: <?php echo esc_attr( easywp_get_option('menu_hover_color') ); ?>}
        .easywp-nav-primary a:hover,.easywp-nav-primary .current-menu-item > a,.easywp-nav-primary ul ul .current-menu-item > a:hover,.easywp-nav-primary .current_page_item > a,.easywp-nav-primary ul ul .current_page_item > a:hover {color: <?php echo esc_attr( easywp_get_option('menu_hover_color') ); ?>}
        .easywp-nav-primary ul ul .current-menu-item > a {color: <?php echo esc_attr( easywp_get_option('menu_hover_color') ); ?>}
        .easywp-nav-primary ul ul .current_page_item > a {color: <?php echo esc_attr( easywp_get_option('menu_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('submenu_one_bg_color') ) { ?>
        .easywp-nav-primary ul ul {background: <?php echo esc_attr( easywp_get_option('submenu_one_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('submenu_one_bd_color') ) { ?>
        .easywp-nav-primary ul ul a {border: 1px solid <?php echo esc_attr( easywp_get_option('submenu_one_bd_color') ); ?>; border-top: none;}
         @media only screen and (min-width: 1168px) {
         ul.easywp-nav-menu > li > a{border-right:1px solid <?php echo esc_attr( easywp_get_option('submenu_one_bd_color') ); ?>;}
         div.easywp-nav-menu > ul > li > a{border-right:1px solid <?php echo esc_attr( easywp_get_option('submenu_one_bd_color') ); ?>;}
        }
        <?php } ?>
        <?php if ( easywp_get_option('menu_icon_color') ) { ?>
        .easywp-responsive-menu-icon::before {color: <?php echo esc_attr( easywp_get_option('menu_icon_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('post_headings_color') ) { ?>
        .entry-title, .entry-title a {color: <?php echo esc_attr( easywp_get_option('post_headings_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('post_headings_hover_color') ) { ?>
        .entry-title a:hover {color: <?php echo esc_attr( easywp_get_option('post_headings_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('rmore_color') ) { ?>
        .easywp-readmore a {color: <?php echo esc_attr( easywp_get_option('rmore_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('rmore_bg_color') ) { ?>
        .easywp-readmore a {background: <?php echo esc_attr( easywp_get_option('rmore_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('rmore_hover_color') ) { ?>
        .easywp-readmore a:hover {color: <?php echo esc_attr( easywp_get_option('rmore_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('rmore_bg_hover_color') ) { ?>
        .easywp-readmore a:hover {background: <?php echo esc_attr( easywp_get_option('rmore_bg_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('sidebar_headings_color') ) { ?>
        .easywp-sidebar .widget-title, .easywp-sidebar .widget-title a, .easywp-sidebar .widget-title a:hover {color: <?php echo esc_attr( easywp_get_option('sidebar_headings_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('sidebar_headings_bg_color') ) { ?>
        .easywp-sidebar .widget-title {background: <?php echo esc_attr( easywp_get_option('sidebar_headings_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('sidebar_text_color') ) { ?>
        .easywp-sidebar .widget {color: <?php echo esc_attr( easywp_get_option('sidebar_text_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('sidebar_link_color') ) { ?>
        .easywp-sidebar .widget a {color: <?php echo esc_attr( easywp_get_option('sidebar_link_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('sidebar_link_hover_color') ) { ?>
        .easywp-sidebar .widget a:hover {color: <?php echo esc_attr( easywp_get_option('sidebar_link_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('footer_bg_color') ) { ?>
        #easywp-footer-widgets-container {background: <?php echo esc_attr( easywp_get_option('footer_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('footer_bd_color_one') ) { ?>
        #easywp-footer-widgets-container {border-left: 1px solid <?php echo esc_attr( easywp_get_option('footer_bd_color_one') ); ?>; border-right: 1px solid <?php echo esc_attr( easywp_get_option('footer_bd_color_one') ); ?>; border-top: 1px solid <?php echo esc_attr( easywp_get_option('footer_bd_color_one') ); ?>;}
        <?php } ?>
        <?php if ( easywp_get_option('footer_bd_color_two') ) { ?>
        #easywp-footer-widgets {border-left: 1px solid <?php echo esc_attr( easywp_get_option('footer_bd_color_two') ); ?>; border-right: 1px solid <?php echo esc_attr( easywp_get_option('footer_bd_color_two') ); ?>; border-top: 1px solid <?php echo esc_attr( easywp_get_option('footer_bd_color_two') ); ?>;}
        <?php } ?>
        <?php if ( easywp_get_option('footer_headings_color') ) { ?>
        #easywp-footer-widgets .widget .widget-title, #easywp-footer-widgets .widget .widget-title a, #easywp-footer-widgets .widget .widget-title a:hover {color: <?php echo esc_attr( easywp_get_option('footer_headings_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('footer_headings_bg_color') ) { ?>
        #easywp-footer-widgets .widget .widget-title {background: <?php echo esc_attr( easywp_get_option('footer_headings_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('footer_text_color') ) { ?>
        #easywp-footer-widgets .widget {color: <?php echo esc_attr( easywp_get_option('footer_text_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('footer_link_color') ) { ?>
        #easywp-footer-widgets .widget a {color: <?php echo esc_attr( easywp_get_option('footer_link_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('footer_link_hover_color') ) { ?>
        #easywp-footer-widgets .widget a:hover {color: <?php echo esc_attr( easywp_get_option('footer_link_hover_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('cp_color') ) { ?>
        #easywp-copyrights, #easywp-copyrights a, #easywp-copyrights a:hover {color: <?php echo esc_attr( easywp_get_option('cp_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('cp_bg_color') ) { ?>
        #easywp-copyrights {background: <?php echo esc_attr( easywp_get_option('cp_bg_color') ); ?>}
        <?php } ?>
        <?php if ( easywp_get_option('credit_color') ) { ?>
        #easywp-credits, #easywp-credits a, #easywp-credits a:hover {color: <?php echo esc_attr( easywp_get_option('credit_color') ); ?>}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_entry_meta') ) { ?>
            .entry-meta {display: none;}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_posted_date') ) { ?>
            .posted-on {display: none;}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_post_author') ) { ?>
            .byline {display: none;}
            .single .byline, .group-blog .byline {display: none;}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_post_categories') ) { ?>
            .cat-links {display: none;}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_post_tags') ) { ?>
            .tags-links {display: none;}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_comments_link') ) { ?>
            .comments-link {display: none;}
        <?php } ?>
        <?php if ( 1 === easywp_get_option('hide_read_more_button') ) { ?>
            .easywp-readmore {display: none;}
        <?php } ?>
    </style>
    <?php
}
add_action( 'wp_head', 'easywp_customizer_css' );

// Header styles
if ( ! function_exists( 'easywp_header_style' ) ) :
function easywp_header_style() {
    $header_text_color = get_header_textcolor();
    if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) { return; }
    ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
        .easywp-site-title, .easywp-site-description {position: absolute;clip: rect(1px, 1px, 1px, 1px);}
    <?php else : ?>
        .easywp-site-title, .easywp-site-title a, .easywp-site-description {color: #<?php echo esc_attr( $header_text_color ); ?>;}
    <?php endif; ?>
    </style>
    <?php
}
endif;
?>