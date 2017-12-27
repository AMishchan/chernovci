<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EasyWP
 */
?>

<!doctype html >
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <?php wp_head();?>
</head>
<body>

<div class="container">
    <div class="row">
        <header>

            <?php if (!(easywp_get_option('hide_social_buttons'))) { ?>
                <?php get_template_part( 'template-parts/social'); ?>
            <?php } ?>

            <div class="title-block">
                <div class="inner-title-block">
                    <div class="block-logo col-sm-4">
                        <img class="img-logo-chern" src="<?php echo get_stylesheet_directory_uri();?>/images/logo.png" alt="logo-chernovtsy">
                    </div>
                    <div class="block-title-text col-sm-8">
                        <h1><?php bloginfo('description');?></h1>
                        <h2><?php bloginfo('name');?></h2>
                        <p>М. Чернівці, 58018, вул. Максимовича, 19А</p>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="row">
        <nav class="navbar navbar-inverse">
            <span class="visible-xs">Меню</span>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            $menu = new Walker_Nav_Menu_Header();
                wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'menu'            => '',
                    'container'       => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'myNavbar',
                    'menu_class'      => 'nav navbar-nav',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '<span class="nav-text">',
                    'link_after'      => '</span>',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => $menu,
                ) );
            ?>

        </nav>
    </div>
</div>