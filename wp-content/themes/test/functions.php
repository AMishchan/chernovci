<?php
/**
 * EasyWP functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Chernovcu
 */

add_action('init', 'omyblog_init_session', 1);
if ( !function_exists('omyblog_init_session')):
    function omyblog_init_session()
    {
        session_start();
    }
endif;

define( 'EASYWP_PROURL', 'https://themesdna.com/easywp-pro-wordpress-theme/' );
define( 'EASYWP_CONTACTURL', 'https://themesdna.com/contact/' );
define( 'EASYWP_THEMEOPTIONSDIR', get_template_directory() . '/admin' );
require_once( EASYWP_THEMEOPTIONSDIR . '/customizer.php' );

add_action('admin_init', 'adminAccessSubscriber');
function adminAccessSubscriber() {
    if (current_user_can('subscriber')) {
        wp_redirect(site_url());
        exit();
    }
}

/* Отключаем админ панель для всех пользователей кроме админа. */
show_admin_bar(false);
if (current_user_can('administrator')) {
    show_admin_bar(true);
}

function easywp_get_option($option) {
    $easywp_options = get_option('easywp_options');
    if ((is_array($easywp_options)) && (array_key_exists($option, $easywp_options))) {
        return $easywp_options[$option];
    }
    else {
        return '';
    }
}

if ( ! function_exists( 'easywp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function easywp_setup() {
    
    global $wp_version;

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on EasyWP, use a find and replace
     * to change 'easywp' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'easywp', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'easywp-featured-image',  640, 300, true );
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
    'primary' => __('Primary Menu', 'easywp'),
    'left' => __('Left Menu', 'easywp'),
    'right' => __('Right Menu', 'easywp'),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    $markup = array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' );
    add_theme_support( 'html5', $markup );

//    add_theme_support( 'custom-logo', array(
//        'height'      => 173,
//        'width'       => 188,
//        'flex-height' => true,
//        'flex-width'  => true,
//        'header-text' => array( 'site-title', 'site-description' ),
//    ) );

    // Support for Custom Header
//    add_theme_support( 'custom-header', apply_filters( 'easywp_custom_header_args', array(
//        'default-image'          => '',
//        'default-text-color'     => '333333',
//        'width'                  => 1146,
//        'height'                 => 250,
//        'flex-height'            => true,
//            'wp-head-callback'       => 'easywp_header_style',
//            'uploads'                => true,
//    ) ) );

    // Set up the WordPress core custom background feature.
//    $background_args = array(
//            'default-color'          => 'eeeeee',
//            'default-image'          => '',
//            'default-repeat'         => 'repeat',
//            'default-position-x'     => 'left',
//            'wp-head-callback'       => '_custom_background_cb',
//            'admin-head-callback'    => 'admin_head_callback_func',
//            'admin-preview-callback' => 'admin_preview_callback_func',
//    );
//    add_theme_support( 'custom-background', apply_filters( 'easywp_custom_background_args', $background_args) );
//
    // Support for Custom Editor Style
    add_editor_style( 'css/editor-style.css' );

}
endif;
add_action( 'after_setup_theme', 'easywp_setup' );

/**
 * Enqueue scripts and styles.
 */
function easywp_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri(), array(), NULL);
    wp_enqueue_style( 'reset', get_template_directory_uri().'/css/reset.css' );
    wp_enqueue_style( 'bootcss', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style( 'main', get_template_directory_uri().'/css/main.css' );
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), NULL );

    wp_deregister_script( 'jquery' );
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    wp_enqueue_script('main', get_template_directory_uri().'/js/main.js');
    wp_enqueue_script('bootjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');

//
//  "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"
//
//
//  "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"
}
add_action( 'wp_enqueue_scripts', 'easywp_scripts' );

/**
 * Enqueue IE compatible scripts and styles.
 */
function easywp_ie_scripts() {
    wp_enqueue_script( 'easywp-html5shiv', get_template_directory_uri(). '/js/html5shiv.min.js', array(), NULL, false);
    wp_script_add_data( 'easywp-html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'easywp-respond', get_template_directory_uri(). '/js/respond.min.js', array(), NULL, false );
    wp_script_add_data( 'easywp-respond', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'easywp_ie_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function easywp_widgets_init() {

    register_sidebar(array(
        'id' => 'easywp-header-banner',
        'name' => __( 'Header Banner', 'easywp' ),
        'description' => __( 'This sidebar is located on the header of the web page.', 'easywp' ),
        'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>')
    );

    register_sidebar(array(
        'id' => 'easywp-left-sidebar',
        'name' => __( 'Left Sidebar', 'easywp' ),
        'description' => __( 'This sidebar is located on the left-hand side of web page.', 'easywp' ),
        'before_widget' => '<div id="%1$s" class="side-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>')
    );

    register_sidebar(array(
        'id' => 'easywp-right-sidebar',
        'name' => __( 'Right Sidebar', 'easywp' ),
        'description' => __( 'This sidebar is located on the right-hand side of web page.', 'easywp' ),
    //    'before_widget' => '<div id="%1$s" class="side-widget widget %2$s">',
        'before_widget' => '<div  id="%1$s" class="aside-right-image %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '')
    );

    register_sidebar(array(
        'id' => 'easywp-footer-1',
        'name' => __( 'Footer 1', 'easywp' ),
        'description' => __( 'This sidebar is located on the left bottom of web page.', 'easywp' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>')
    );

    register_sidebar(array(
        'id' => 'easywp-footer-2',
        'name' => __( 'Footer 2', 'easywp' ),
        'description' => __( 'This sidebar is located on the middle bottom of web page.', 'easywp' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>')
    );

    register_sidebar(array(
        'id' => 'easywp-footer-3',
        'name' => __( 'Footer 3', 'easywp' ),
        'description' => __( 'This sidebar is located on the middle bottom of web page.', 'easywp' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>')
    );

    register_sidebar(array(
        'id' => 'easywp-footer-4',
        'name' => __( 'Footer 4', 'easywp' ),
        'description' => __( 'This sidebar is located on the right bottom of web page.', 'easywp' ),
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>')
    );
}
add_action( 'widgets_init', 'easywp_widgets_init' );

// Get custom-logo URL
//function easywp_custom_logo() {
//    if ( ! has_custom_logo() ) {return;}
//    $easywp_custom_logo_id = get_theme_mod( 'custom_logo' );
//    $easywp_logo = wp_get_attachment_image_src( $easywp_custom_logo_id , 'full' );
//    return $easywp_logo[0];
//}

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a "Home" link as the first item
//function easywp_page_menu_args( $args ) {
//    $args['show_home'] = true;
//    return $args;
//}
//add_filter( 'wp_page_menu_args', 'easywp_page_menu_args' );

// Category ids in post class
//function easywp_category_id_class($classes) {
//        global $post;
//        foreach((get_the_category($post->ID)) as $category)
//            $classes [] = 'wpcat-' . $category->cat_ID . '-id';
//            return $classes;
//}
//add_filter('post_class', 'easywp_category_id_class');

// Change excerpt length
//function easywp_excerpt_length($length) {
//    if ( is_admin() ) {
//        return $length;
//    }
//    return 45;
//}
//add_filter('excerpt_length', 'easywp_excerpt_length');

// Change excerpt more word
//function easywp_excerpt_more($more) {
//       if ( is_admin() ) {
//         return $more;
//       }
//       global $post;
//       $readmoretext = __( 'Continue Reading...', 'easywp' );
//        if ( easywp_get_option('read_more_text') ) {
//                $readmoretext = easywp_get_option('read_more_text');
//        }
//       return '...<div class="easywp-readmore"><a class="read-more-link" href="'. esc_url( get_permalink($post->ID) ) . '">'.esc_html($readmoretext).'<span class="screen-reader-text">  '.get_the_title().'</span></a></div>';
//}
//add_filter('excerpt_more', 'easywp_excerpt_more');

// Adds custom classes to the array of body classes.
//function easywp_body_classes( $classes ) {
//    // Adds a class of group-blog to blogs with more than 1 published author.
//    if ( is_multi_author() ) {
//        $classes[] = 'group-blog';
//    }
//    if ( is_page_template( 'template-full-width.php' ) || is_404() ) {
//        $classes[] = 'easywp-body-full-width';
//    }
//    return $classes;
//}
//add_filter( 'body_class', 'easywp_body_classes' );

//pagination
function wp_corenavi() {
    global $wp_query;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total'] = $max;
    $a['current'] = $current;

    $total = 1; //1 - выводить текст "Страница N из N", 0 - не выводить
    $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
    $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
    $a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
    $a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"

    if ($max > 1) echo '<div class="navigation">';
//    if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
    echo /*$pages .*/ paginate_links($a);
    if ($max > 1) echo '</div>';
}

//Разрешаем загружать файлы данных расширений
function additional_mime_types( $mimes ) {
    $mimes['sql'] = 'application/sql';
        return $mimes;
    }
add_filter( 'upload_mimes', 'additional_mime_types' );


/**
 * Other theme functions
 */
require_once get_template_directory() . '/library/register.php';
require_once get_template_directory() . '/library/user_info.php';
require_once get_template_directory() . '/library/route.php';
require_once get_template_directory() . '/library/class-walker-header-menu.php';
require get_template_directory() . '/admin/template-tags.php';
require_once get_template_directory() . '/admin/custom.php';
?>