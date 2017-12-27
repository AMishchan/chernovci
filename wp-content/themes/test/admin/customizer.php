<?php
/**
 * EasyWP Theme Customizer.
 *
 * @package EasyWP
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {return NULL;}

class EasyWP_Customize_Button_Control extends WP_Customize_Control {
        public $type = 'button';
        protected $button_tag = 'button';
        protected $button_class = 'button button-primary';
        protected $button_href = 'javascript:void(0)';
        protected $button_target = '';
        protected $button_onclick = '';
        protected $button_tag_id = '';

        public function render_content() {
        ?>
        <span class="center">
        <?php
        echo '<' . esc_html($this->button_tag);
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if ('button' == $this->button_tag) {
            echo ' type="button"';
        }
        else {
            echo ' href="' . esc_url($this->button_href) . '"' . (empty($this->button_tag) ? '' : ' target="' . esc_attr($this->button_target) . '"');
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="' . esc_js($this->button_onclick) . '"';
        }
        if (!empty($this->button_tag_id)) {
            echo ' id="' . esc_attr($this->button_tag_id) . '"';
        }
        echo '>';
        echo esc_html($this->label);
        echo '</' . esc_html($this->button_tag) . '>';
        ?>
        </span>
        <?php
        }
}

class EasyWP_Customize_Static_Text_Control extends WP_Customize_Control {
    public $type = 'static-text';

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    protected function render_content() {
        if ( ! empty( $this->label ) ) :
            ?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
        endif;

        if ( ! empty( $this->description ) ) :
            ?><div class="description customize-control-description"><?php

            if( is_array( $this->description ) ) {
                echo '<p>' . implode( '</p><p>', $this->description ) . '</p>';
            } else {
                echo $this->description;
            }

            ?></div><?php
        endif;

    }
}

function easywp_register_theme_customizer( $wp_customize ) {

    if(method_exists('WP_Customize_Manager', 'add_panel')):
    $wp_customize->add_panel('easywp_main_options_panel', array( 'title' => __('Theme Options', 'easywp'), 'priority' => 10, ));
    endif;
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'easywp_main_options_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = 20;
    $wp_customize->get_section( 'colors' )->panel = 'easywp_main_options_panel';
    $wp_customize->get_section( 'colors' )->priority = 40;
      
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

    $wp_customize->add_section( 'sc_easywp_getting_started', array( 'title' => esc_html__( 'Getting Started', 'easywp' ), 'description' => __( 'Thanks for your interest in EasyWP! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'easywp' ), 'panel' => 'easywp_main_options_panel', 'priority' => 5, ) );

    $wp_customize->add_setting( 'easywp_options[documentation]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new EasyWP_Customize_Button_Control( $wp_customize, 'easywp_documentation_control', array( 'label' => esc_html__( 'Documentation', 'easywp' ), 'section' => 'sc_easywp_getting_started', 'settings' => 'easywp_options[documentation]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => 'https://themesdna.com/easywp-wordpress-theme/', 'button_target' => '_blank', ) ) );

    $wp_customize->add_setting( 'easywp_options[contact]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new EasyWP_Customize_Button_Control( $wp_customize, 'easywp_contact_control', array( 'label' => esc_html__( 'Contact Us', 'easywp' ), 'section' => 'sc_easywp_getting_started', 'settings' => 'easywp_options[contact]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => 'https://themesdna.com/contact/', 'button_target' => '_blank', ) ) );

    $wp_customize->add_setting( 'easywp_options[body_text_color]', array( 'default' => '#555555', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_body_text_color_control', array( 'label' => esc_html__( 'Main Text Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[body_text_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[link_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_link_color_control', array( 'label' => esc_html__( 'Main Link Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[link_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[link_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_link_hover_color_control', array( 'label' => esc_html__( 'Main Link Hover Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[link_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[header_bg_color]', array( 'default' => '#e0e0e0', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_header_bg_color_control', array( 'label' => esc_html__( 'Header Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[header_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[header_bd_color_one]', array( 'default' => '#a8a8a8', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_header_bd_color_one_control', array( 'label' => esc_html__( 'Header Outer Border Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[header_bd_color_one]' ) ) );

    $wp_customize->add_setting( 'easywp_options[header_bd_color_two]', array( 'default' => '#f9f9f9', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_header_bd_color_two_control', array( 'label' => esc_html__( 'Header Inner Border Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[header_bd_color_two]' ) ) );

    $wp_customize->add_setting( 'easywp_options[menu_bg_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_menu_bg_color_control', array( 'label' => esc_html__( 'Menu Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[menu_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[menu_bd_color]', array( 'default' => '#222222', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_menu_bd_color_control', array( 'label' => esc_html__( 'Menu Border Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[menu_bd_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[menu_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_menu_color_control', array( 'label' => esc_html__( 'Menu Link Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[menu_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[menu_hover_color]', array( 'default' => '#dddddd', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_menu_hover_color_control', array( 'label' => esc_html__( 'Menu Link Hover Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[menu_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[submenu_one_bg_color]', array( 'default' => '#222222', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_submenu_one_bg_color_control', array( 'label' => esc_html__( 'Sub Menu Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[submenu_one_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[submenu_one_bd_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_submenu_one_bd_color_control', array( 'label' => esc_html__( 'Sub Menu Border Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[submenu_one_bd_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[menu_icon_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_menu_icon_color_control', array( 'label' => esc_html__( 'Responsive Menu Icon Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[menu_icon_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[post_headings_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_post_headings_color_control', array( 'label' => esc_html__( 'Post Title Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[post_headings_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[post_headings_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_post_headings_hover_color_control', array( 'label' => esc_html__( 'Post Title Hover Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[post_headings_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[rmore_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_rmore_color_control', array( 'label' => esc_html__( 'Read More Button Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[rmore_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[rmore_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_rmore_bg_color_control', array( 'label' => esc_html__( 'Read More Button Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[rmore_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[rmore_hover_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_rmore_hover_color_control', array( 'label' => esc_html__( 'Read More Button Hover Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[rmore_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[rmore_bg_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_rmore_bg_hover_color_control', array( 'label' => esc_html__( 'Read More Button Hover Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[rmore_bg_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[sidebar_headings_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_sidebar_headings_color_control', array( 'label' => esc_html__( 'Sidebar Title Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[sidebar_headings_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[sidebar_headings_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_sidebar_headings_bg_color_control', array( 'label' => esc_html__( 'Sidebar Title Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[sidebar_headings_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[sidebar_text_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_sidebar_text_color_control', array( 'label' => esc_html__( 'Sidebar Text Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[sidebar_text_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[sidebar_link_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_sidebar_link_color_control', array( 'label' => esc_html__( 'Sidebar Link Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[sidebar_link_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[sidebar_link_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_sidebar_link_hover_color_control', array( 'label' => esc_html__( 'Sidebar Link Hover Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[sidebar_link_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_bg_color]', array( 'default' => '#e0e0e0', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_bg_color_control', array( 'label' => esc_html__( 'Footer Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_bd_color_one]', array( 'default' => '#a8a8a8', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_bd_color_one_control', array( 'label' => esc_html__( 'Footer Outer Border Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_bd_color_one]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_bd_color_two]', array( 'default' => '#f9f9f9', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_bd_color_two_control', array( 'label' => esc_html__( 'Footer Inner Border Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_bd_color_two]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_headings_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_headings_color_control', array( 'label' => esc_html__( 'Footer Title Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_headings_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_headings_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_headings_bg_color_control', array( 'label' => esc_html__( 'Footer Title Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_headings_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_text_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_text_color_control', array( 'label' => esc_html__( 'Footer Text Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_text_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_link_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_link_color_control', array( 'label' => esc_html__( 'Footer Link Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_link_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[footer_link_hover_color]', array( 'default' => '#000000', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_footer_link_hover_color_control', array( 'label' => esc_html__( 'Footer Link Hover Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[footer_link_hover_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[cp_color]', array( 'default' => '#ffffff', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_cp_color_control', array( 'label' => esc_html__( 'Copyrights Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[cp_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[cp_bg_color]', array( 'default' => '#333333', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_cp_bg_color_control', array( 'label' => esc_html__( 'Copyrights Background Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[cp_bg_color]' ) ) );

    $wp_customize->add_setting( 'easywp_options[credit_color]', array( 'default' => '#7d7d7d', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'easywp_cp_color_control', array( 'label' => esc_html__( 'Theme Credits Color', 'easywp' ), 'section' => 'colors', 'settings' => 'easywp_options[credit_color]' ) ) );

    $wp_customize->add_section( 'sc_easywp_posts', array( 'title' => esc_html__( 'Post Options', 'easywp' ), 'panel' => 'easywp_main_options_panel', 'priority' => 260 ) );
    
    $wp_customize->add_setting( 'easywp_options[hide_entry_meta]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_entry_meta_control', array( 'label' => esc_html__( 'Hide Entry Meta', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_entry_meta]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_posted_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_posted_date_control', array( 'label' => esc_html__( 'Hide Posted Date', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_posted_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_post_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_post_author_control', array( 'label' => esc_html__( 'Hide Post Author', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_post_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_post_categories]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_post_categories_control', array( 'label' => esc_html__( 'Hide Post Categories', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_post_categories]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_post_tags]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_post_tags_control', array( 'label' => esc_html__( 'Hide Post Tags', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_post_tags]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_comments_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_comments_link_control', array( 'label' => esc_html__( 'Hide Comment Link', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_comments_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_thumbnail]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_thumbnail_control', array( 'label' => esc_html__( 'Hide Thumbnails from Every Page', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_thumbnail]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_thumbnail_single]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_thumbnail_single_control', array( 'label' => esc_html__( 'Hide Thumbnails from Posts/Pages', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_thumbnail_single]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[hide_read_more_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_read_more_button_control', array( 'label' => esc_html__( 'Hide Read More Button', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[hide_read_more_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[thumbnail_link]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_thumbnail_link' ) );

    $wp_customize->add_control( 'easywp_thumbnail_link_control', array( 'label' => esc_html__( 'Thumbnail Link', 'easywp' ), 'description' => __('Do you want thumbnails to be linked to their post?', 'easywp'), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[thumbnail_link]', 'type' => 'select', 'choices' => array( 'yes' => __('Yes', 'easywp'), 'no' => __('No', 'easywp') ) ) );

    $wp_customize->add_setting( 'easywp_options[blogpoststyle]', array( 'default' => 'excerpt', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_blogpost_style' ) );

    $wp_customize->add_control( 'easywp_blogpoststyle_control', array( 'label' => esc_html__( 'Post Content', 'easywp' ), 'description' => __('<b>Show content</b> will show the whole post content while <b>show excerpt</b> will only show the first few lines', 'easywp'), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[blogpoststyle]', 'type' => 'select', 'choices' => array( 'excerpt' => __('Show excerpt', 'easywp'), 'content' => __('Show content', 'easywp') ) ) );

    $wp_customize->add_setting( 'easywp_options[read_more_text]', array( 'default' => 'Continue Reading...', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'easywp_read_more_text_control', array( 'label' => esc_html__( 'Read More Text', 'easywp' ), 'section' => 'sc_easywp_posts', 'settings' => 'easywp_options[read_more_text]', 'type' => 'text', ) );

    $wp_customize->add_section( 'sc_easywp_sociallinks', array( 'title' => esc_html__( 'Social Links', 'easywp' ), 'panel' => 'easywp_main_options_panel', 'priority' => 400, ));

    $wp_customize->add_setting( 'easywp_options[hide_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_checkbox', ) );

    $wp_customize->add_control( 'easywp_hide_social_buttons_control', array( 'label' => esc_html__( 'Hide Social Buttons', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[hide_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'easywp_options[twitterlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_twitterlink_control', array( 'label' => esc_html__( 'Twitter URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[twitterlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[facebooklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_facebooklink_control', array( 'label' => esc_html__( 'Facebook URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[facebooklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[googlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) ); 

    $wp_customize->add_control( 'easywp_googlelink_control', array( 'label' => esc_html__( 'Google Plus URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[googlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[pinterestlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_pinterestlink_control', array( 'label' => esc_html__( 'Pinterest URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[pinterestlink]', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'easywp_options[linkedinlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_linkedinlink_control', array( 'label' => esc_html__( 'Linkedin Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[linkedinlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[instagramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_instagramlink_control', array( 'label' => esc_html__( 'Instagram Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[instagramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[flickrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_flickrlink_control', array( 'label' => esc_html__( 'Flickr Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[flickrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[youtubelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_youtubelink_control', array( 'label' => esc_html__( 'Youtube URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[youtubelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[vimeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_vimeolink_control', array( 'label' => esc_html__( 'Vimeo URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[vimeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[soundcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_soundcloudlink_control', array( 'label' => esc_html__( 'Soundcloud URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[soundcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[lastfmlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_lastfmlink_control', array( 'label' => esc_html__( 'Lastfm URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[lastfmlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[githublink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_githublink_control', array( 'label' => esc_html__( 'Github URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[githublink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[bitbucketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_bitbucketlink_control', array( 'label' => esc_html__( 'Bitbucket URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[bitbucketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[tumblrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_tumblrlink_control', array( 'label' => esc_html__( 'Tumblr URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[tumblrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[digglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_digglink_control', array( 'label' => esc_html__( 'Digg URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[digglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[deliciouslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_deliciouslink_control', array( 'label' => esc_html__( 'Delicious URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[deliciouslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[stumblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_stumblelink_control', array( 'label' => esc_html__( 'Stumbleupon Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[stumblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[redditlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_redditlink_control', array( 'label' => esc_html__( 'Reddit Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[redditlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[dribbblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_dribbblelink_control', array( 'label' => esc_html__( 'Dribbble Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[dribbblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[behancelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_behancelink_control', array( 'label' => esc_html__( 'Behance Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[behancelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[codepenlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_codepenlink_control', array( 'label' => esc_html__( 'Codepen Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[codepenlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[jsfiddlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_jsfiddlelink_control', array( 'label' => esc_html__( 'JSFiddle Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[jsfiddlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[stackoverflowlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_stackoverflowlink_control', array( 'label' => esc_html__( 'Stack Overflow Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[stackoverflowlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[stackexchangelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_stackexchangelink_control', array( 'label' => esc_html__( 'Stack Exchange Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[stackexchangelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[bsalink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_bsalink_control', array( 'label' => esc_html__( 'BuySellAds Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[bsalink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[slidesharelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_slidesharelink_control', array( 'label' => esc_html__( 'SlideShare Link', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[slidesharelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[skypeusername]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'easywp_skypeusername_control', array( 'label' => esc_html__( 'Skype Username', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[skypeusername]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[emailaddress]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_email' ) );

    $wp_customize->add_control( 'easywp_emailaddress_control', array( 'label' => esc_html__( 'Email Address', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[emailaddress]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'easywp_options[rsslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'easywp_rsslink_control', array( 'label' => esc_html__( 'RSS Feed URL', 'easywp' ), 'section' => 'sc_easywp_sociallinks', 'settings' => 'easywp_options[rsslink]', 'type' => 'text' ) );

    $wp_customize->add_section( 'sc_easywp_footer', array( 'title' => esc_html__( 'Footer', 'easywp' ), 'panel' => 'easywp_main_options_panel', 'priority' => 440 ) );

    $wp_customize->add_setting( 'easywp_options[footer_text]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'easywp_sanitize_html', ) );

    $wp_customize->add_control( 'easywp_footer_text_control', array( 'label' => esc_html__( 'Footer copyright notice', 'easywp' ), 'section' => 'sc_easywp_footer', 'settings' => 'easywp_options[footer_text]', 'type' => 'text', ) );

    $wp_customize->add_section( 'sc_easywp_upgrade', array( 'title' => esc_html__( 'Upgrade to Pro', 'easywp' ), 'priority' => 400 ) );
    
    $wp_customize->add_setting( 'easywp_options[upgrade_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new EasyWP_Customize_Static_Text_Control( $wp_customize, 'easywp_upgrade_text_control', array(
        'label'       => esc_html__( 'EasyWP Pro', 'easywp' ),
        'section'     => 'sc_easywp_upgrade',
        'settings' => 'easywp_options[upgrade_text]',
        'description' => array(
            esc_html__( 'Do you enjoy EasyWP? Upgrade to EasyWP Pro now and get:', 'easywp' ),
            '<ul>' .
                '<li>' . esc_html__( 'Font Options', 'easywp' ) . '</li>' .
                '<li>' . esc_html__( 'Layout Options', 'easywp' ) . '</li>' .
                '<li>' . esc_html__( 'Search Engine Optimized', 'easywp' ) . '</li>' .
                '<li>' . esc_html__( 'WooCommerce Support', 'easywp' ) . '</li>' .
                '<li>' . esc_html__( 'More Customizer options', 'easywp' ) . '</li>' .
            '</ul>',
            '<strong><a href="'.EASYWP_PROURL.'" class="customizer-prolink customizer-proupgrade" target="_blank">' . esc_html__( 'Upgrade To Pro', 'easywp' ) . '</a></strong>'
        ),
    ) ) );  

}

function easywp_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
function easywp_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function easywp_sanitize_thumbnail_link( $input ) {
    $valid = array('yes','no');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function easywp_sanitize_blogpost_style( $input ) {
    $valid = array('excerpt','content');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function easywp_sanitize_email( $input ) {
    if ( '' != $input && is_email( $input ) ) {
        $input = sanitize_email( $input );
    } else {
        $input = '';
    }
    return $input;
}

add_action( 'customize_register', 'easywp_register_theme_customizer' );

function easywp_customizer_js_scripts() {    
    wp_enqueue_script('easywp-theme-customizer-js', get_template_directory_uri() . '/admin/js/customizer.js', array( 'jquery', 'customize-preview' ), NULL, true);
}
add_action( 'customize_preview_init', 'easywp_customizer_js_scripts' );
?>