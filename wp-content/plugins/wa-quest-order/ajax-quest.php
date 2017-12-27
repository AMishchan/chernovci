<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

function checkIdent($ident){
  global $wpdb;

  $check = $wpdb->get_results( "SELECT id FROM wp_quest_orders WHERE ticket_id = $ident" );
  if (count($check) > 0 ){
    return 'class="booked"';
  }else {
    return false;
  }
}

if(isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day'])){
  $year = $_POST['year'];
  $month = $_POST['month'];
  $day = $_POST['day'];
  if (9 > $day){
    $day = "0".$day;
  }

$my_posts = new WP_Query;
$myposts = $my_posts->query( array(
	'post_type' => 'quest'
) );
foreach( $myposts as $pst ){

  $date = get_field('quest_date', $pst->ID);
  $people = get_field('people', $pst->ID);
  $c_time = get_field('current_time', $pst->ID);
  $add_quest = get_field('add_quest', $pst->ID);

  $ident = $pst->ID.$year.$month.$day;// идентификатор билета
  if('on' == $add_quest){
  	echo '<div class="wrap-quests row"><div class="quest-info columns large-2">' .$pst->post_title. '<span class="kvest-size">'.$people.' человек</span></div>';
    echo '<div class="quest-time columns large-10"> <ul class="time-list">';

    foreach ($c_time as $time) {
      $clear_time = str_replace(':','',$time['quest_time']);
      $final_ident = $ident.$clear_time;
      $qtime = $time['quest_time'];
      echo '<li '.checkIdent($final_ident).'  data-ident="'.$final_ident.'">' . $qtime . '</li>';
    }
  }
  echo '</ul></div></div>';
}
}
