<?php
// подключение стилей для админки
function my_stylesheet_admin(){
wp_enqueue_style("style-admin", plugins_url( 'assets/css/style-admin.css', __FILE__));
wp_enqueue_script( 'admin', plugins_url( 'assets/js/admin.js', __FILE__) , array(), '1.0.0', true );
//table-sorter
wp_enqueue_style("theme-table", plugins_url( 'assets/css/theme.default.min.css', __FILE__));
wp_enqueue_script( 'script-table', plugins_url('assets/js/jquery.tablesorter.min.js', __FILE__), array(), '1.0.0', true );
}
add_action('admin_head', 'my_stylesheet_admin');


function waqo_deactivate(){
  // TODO
}


function questTableCreate() {
  global $wpdb;

  $table_name = $wpdb->prefix . "quest_orders";

  if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

      $sql = "CREATE TABLE " . $table_name . " (
  	  id int(9) NOT NULL AUTO_INCREMENT,
  	  time_order  DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  	  time_quest VARCHAR(55) NOT NULL,
  	  quest_name tinytext NOT NULL,
  	  fio text NOT NULL,
  	  phone VARCHAR(55) NOT NULL,
      price VARCHAR(55) NOT NULL,
      status VARCHAR(55) NOT NULL,
      quest_id VARCHAR(55) NOT NULL,
      ticket_id BIGINT(16) NOT NULL,

  	  UNIQUE KEY id (id)
  	  );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
    }
}

add_action( 'init', 'create_quest' );
function create_quest() {
    register_post_type( 'quest',
        array(
            'labels' => array(
                'name' => 'My Quests',
                'singular_name' => 'Quest',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Quest',
                'edit' => 'Edit',
                'edit_item' => 'Edit Quest',
                'new_item' => 'New Quest',
                'view' => 'View',
                'view_item' => 'View Quest',
                'search_items' => 'Search Quest',
                'not_found' => 'No Quest found',
                'not_found_in_trash' => 'No Quests found in Trash',
                'parent' => 'Parent Quest'
            ),
            'public' => true,
            'menu_position' => 30,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-tickets-alt',
            'has_archive' => true,
            'description' => 'Quest',
        )
    );
}
function quest_taxonomy() {
  $labels = array(
		'name'              => 'Quest Category',
		'singular_name'     => 'Quest',
		'search_items'      => 'Search Quests',
		'all_items'         => 'All Quests',
		'parent_item'       => 'Parent Quest',
		'parent_item_colon' => 'Parent Quest:',
		'edit_item'         => 'Edit Quest',
		'update_item'       => 'Update Quest',
		'add_new_item'      => 'Add New Quest',
		'new_item_name'     => 'New Quest Name',
		'menu_name'         => 'Quest',
	);
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);

    register_taxonomy( 'quest_categories', 'quest', $args );
}
add_action( 'init', 'quest_taxonomy');
