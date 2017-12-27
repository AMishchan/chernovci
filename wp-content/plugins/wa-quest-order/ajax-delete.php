<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

if(isset($_POST['id'])){
global $wpdb;

$id = $_POST['id'];

$sql = "DELETE FROM `wp_quest_orders` WHERE `wp_quest_orders`.`id` = $id;";
$wpdb->query($sql);

echo "Запись удалена";
}
