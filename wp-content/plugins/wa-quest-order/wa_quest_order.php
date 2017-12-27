<?php
/*
Plugin Name: WA Quest Order
Description: Online ticket booking in the quest room
Version: 1.0
Author: Michael Chizhevskiy
Author URI: http://WebApe.pro
Plugin URI: http://WebApe.pro
*/
register_activation_hook( __FILE__ , 'questTableCreate' ); // создание таблицы заявок
register_deactivation_hook( __FILE__ , 'waqo_deactivate' );
include 'initialization.php';



function wptuts_scripts_basic()
{
    wp_enqueue_style("main", plugins_url( 'assets/css/main.css', __FILE__));
    wp_register_script( 'script', plugins_url( 'assets/js/script.js', __FILE__ ), array( 'jquery' ) );
    wp_register_script( 'script', get_template_directory_uri() . 'assets/js/script.js', array( 'jquery' ) );
    wp_enqueue_script( 'script' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' );




add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_menu_page( 'Orders', 'Quest Order', 'manage_options', 'quest-orders', 'my_plugin_options', 'dashicons-clipboard' );
}

function my_plugin_options() {
global $wpdb;
$orders = $wpdb->get_results( "SELECT id, time_order, time_quest ,quest_name,fio,phone,status FROM wp_quest_orders" );
echo "<div class='table-wrap'>";
echo "<h2>Таблица заказов</h2>";
echo '<div id="ajax_msg" class="alert alert-success" style="display: none;">No changes made</div>';
echo '<table class="quest table table-bordered">';
echo '<thead><tr><th>№ п/п</th><th>Время Заказа</th><th>Квест</th><th>Время Квеста</th><th>ФИО</th><th>Телефон</th><th>Статус</th><th>Управление</th></tr></thead><tbody>';

foreach ($orders as $order) {
  $o_status = $order->status;
  if ('Резерв' == $order->status ){
    $status = 'danger';
  } else if ('Подтвержден' == $order->status){
    $status = 'success';
  } else {
    $status = 'active';
    $o_status = 'Завершен';
  }

  echo "<tr>";
  echo "<td>" . $order->id . "</td>";
  echo "<td>" . $order->time_order . "</td>";
  echo "<td>" . $order->quest_name . "</td>";
  echo "<td>" . $order->time_quest . "</td>";
  echo "<td title='Click to edit'><div class='editable' onclick='makeElementEditable(this)' onblur='updateEventFIO(this, $order->id )' contenteditable='false'>" . $order->fio . "</div></td>";
  echo "<td title='Click to edit'><div class='editable' onclick='makeElementEditable(this)' onblur='updateEventPhone(this, $order->id )' contenteditable='false'>" . $order->phone . "</div></td>";
  echo "<td class='{$status}'>" . $o_status . "</td>";
  echo "<td><button class='btn-order btn-dell dashicons dashicons-no-alt' onclick='deleteEvent(this, $order->id)'></button>";
  echo "<button class='btn-order btn-prove dashicons dashicons-yes' onclick='proveEvent(this, $order->id)'></button></td>";
  echo "</tr>";
  echo "</div>";
}

echo '</tbody></table>';
}

function wp_event_shortcode(){
  include  'includes/table-events.php';
}
add_shortcode('event', 'wp_event_shortcode');
