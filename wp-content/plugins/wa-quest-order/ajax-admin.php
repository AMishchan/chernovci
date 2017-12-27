<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;

if(isset($_POST['fio']) && isset($_POST['id'])){
$fio = trim($_POST['fio']);
$id = $_POST['id'];

$sql = "UPDATE `wp_quest_orders` SET `fio` = '$fio' WHERE `wp_quest_orders`.`id` = $id";
$wpdb->query($sql);
echo "Запись обнавлена";

} else if (isset($_POST['key']) && isset($_POST['id'])){

  $id = $_POST['id'];
  $status = trim($_POST['key']);
  $sql = "UPDATE `wp_quest_orders` SET `status` = '$status' WHERE `wp_quest_orders`.`id` = $id";
  $wpdb->query($sql);
  echo "Заказ подтвержден!";

} else if(isset($_POST['phone']) && isset($_POST['id'])){
  $phone = trim($_POST['phone']);
  $id = $_POST['id'];

  $sql = "UPDATE `wp_quest_orders` SET `phone` = '$phone' WHERE `wp_quest_orders`.`id` = $id";
  $wpdb->query($sql);
  echo "Запись обнавлена";
} else if(isset($_POST['phone']) && isset($_POST['name']) && isset($_POST['ident'])){


  $table_name = $wpdb->prefix . "quest_orders";

  $ticket_id = trim($_POST['ident']);
  $quest_id = substr($ticket_id, 0, 4);
  $queste_name = get_the_title( $quest_id );
  $time_quest = substr($ticket_id, 4, 4).'/'.substr($ticket_id, 8, 2).'/'.substr($ticket_id, 10, 2).'/'.substr($ticket_id, 12, 2).':'.substr($ticket_id, 14, 2);
  $fio = trim($_POST['name']);
  $phone = trim($_POST['phone']);
  $price = "0";
  $status = "Резерв";

  $check = $wpdb->get_results( "SELECT id FROM wp_quest_orders WHERE ticket_id = $ticket_id" );
  if (count($check) > 0){
      echo 'Кто-то опередил вас! Выберите пожалуйста другое время.';
  }else {
    $rows_affected = $wpdb->insert( $table_name,
                          [
                           'time_quest' => $time_quest,
                           'quest_name' => $queste_name,
                           'fio' => $fio,
                           'phone' => $phone,
                           'price' => $price ,
                           'status' => $status,
                           'quest_id' => $quest_id,
                           'ticket_id' => $ticket_id,
                           ] );
    echo 'Вы забронировали квест '.$queste_name.' на '.$time_quest.'! Наш оператор свяжется с вами в ближайшее время. Спасибо!' ;
  }
}
