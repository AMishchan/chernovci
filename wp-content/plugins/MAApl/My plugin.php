<?php
/*
Plugin Name: Каталог
Author: Mark Avdeev
Author URI: www.lifeexample.ru
*/

function create_catalog() {
    global $wpdb;
    if ($_REQUEST['open_file'])	{
        echo'<pre>';
        var_dump($_REQUEST);
        echo'</pre>';
        //если нажата кнопка "загрузить каталог"
        if ($_FILES['file']['name']!='' && $_FILES['file']['error']==0){ //проверяем загрузился указаный фаил или нет
            $info=pathinfo($_FILES['file']['name']);
            //копируем полученный csv фаил в папку catalog в корне сайта
            if (copy($_FILES['file']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/catalog/Catalog.'.$info['extension'])){
                // создаем в базе таблицу, если же он есть то пропускаем этот шаг.
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                $table_name = $wpdb->prefix."catalog";
                $sql = "DROP TABLE `".$table_name."`";
                $wpdb->query($sql);
                if($wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
                    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `field1` varchar(40) NOT NULL,
							  `field2` varchar(40) NOT NULL,
							  `field3` varchar(40) NOT NULL,
							  `field4` varchar(40) NOT NULL,
							  `field5` varchar(40) NOT NULL,							
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

                    dbDelta($sql);
                    echo '<div id="message" class="updated fade"><p><strong>Каталог обновлен.</strong></p></div>';
                }

                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/catalog/Catalog.'.$info['extension']);
                if ($file){
                    $strings = explode("\n",$file); // построчно разбиваем фаил
                    for($i=0; $i<(count($strings)-1); $i++){//из каждой строки вырезаем значения полей
                        if($found = explode(";",iconv("WINDOWS-1251","UTF-8", $strings[$i]))){
                            //записываем их в базу
                            $sql='INSERT INTO `'.$table_name.'` VALUES("","'.$found[0].'","'.$found[1].'","'.$found[2].'","'.$found[3].'","'.$found[4].'");';
                            dbDelta($sql);
                        }
                    }


                }
                else echo "Не найден указаный CSV фаил! <font color='blue'>".$_SERVER['DOCUMENT_ROOT'].'/catalog/Catalog.'.$info['extension']."</font>";

            }
            else echo "Неудалось передать указаный фаил.";
        }
        else $error="<font color='red'>Фаил не загружен!</font> Возможно вы не указали какой фаил хотите загрузить.";
    }

    ?>

    <div class="wrap">
        <h2>Каталог </h2>
        <form method="post" action="" enctype="multipart/form-data">
            <h3>Выполнить загрузку каталога </h3>
            <em>Для обновления каталога, выберите фаил с расширением <font color="blue">.csv</font>, расположенного на вашем компьютере.<em/>
                <br/>
                <br/><input type="file"   name="file" />
                <br/>
                <br/>
                <input type="submit" name="open_file" value="Загрузить каталог" />
                <br/>
                <br/>
                <?=$error?>
        </form>

    </div>



    <?
}

function catalog_admin_menu()
{
    add_options_page('Каталог ', 'Каталог ', 8, basename(__FILE__), 'create_catalog');
}

add_action('admin_menu', 'catalog_admin_menu');


function catalog_print(){
    global $wpdb;
    $rrr = '';
    $table_name = $wpdb->prefix."catalog";
    $sql = "SELECT * FROM ".$table_name;

    $result = $wpdb->get_results($sql, ARRAY_A);

    $rrr.="<table><tr>";
    foreach($result[0] as $name=>$value){
        $rrr.="<th>".$name."</th>";
    }
    $rrr.="</tr>";
    foreach($result as $row){
        $rrr.="<tr>";
        foreach($row as $name=>$value){
            $rrr.="<td>".$value."</td>";
        }
        $rrr.="</tr>";
    }
    $rrr.="</table>";
    return $rrr;
}

add_shortcode('catalog', 'catalog_print');
?>