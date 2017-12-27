<?php
/**
 * @package Morkovin
 * @version 1.0
 */
/*
Plugin Name: Interkassa
Plugin URI: http://www.sdelaysite.com
Description: Interkassa 
Armstrong: My Plugin.
Author: Andrey Morkovin
Version: 1.0
Author URI: http://www.sdelaysite.com
*/

function delete_expired_codes()
{
	global $wpdb;

	$final_time = time() - get_option('morkovin_code_expiration')*3600*24;

	$table_downloadcode = $wpdb->prefix.morkovin_downloadcodes;
	
	$wpdb->query
	(  
		$wpdb->prepare
		(  
			"DELETE FROM $table_downloadcode WHERE ctime < %d", 
			$final_time
		)
	);  
}

function download_file($filename)
{	
	preg_match('/^.+\/([^\/]+)$/i', $filename, $matches);
	
	header('Content-Disposition: attachment; filename='.$matches[1]);
	header('Content-Length: '.filesize($filename));
	header('Keep-Alive: timeout=5, max=100');
	header('Connection: Keep-Alive');
	header('Content-Type: octet-stream');
	readfile($filename);
	exit;
}

function morkovin_random_string($number)
{
	//$number - кол-во символов в пароле
	$arr = array('a','b','c','d','e','f',
	'g','h','i','j','k','l',
	'm','n','o','p','r','s',
	't','u','v','x','y','z',
	'A','B','C','D','E','F',
	'G','H','I','J','K','L',
	'M','N','O','P','R','S',
	'T','U','V','X','Y','Z',
	'1','2','3','4','5','6',
	'7','8','9','0');

	// Генерируем пароль
	$pass = "";
	for($i = 0; $i < $number; $i++)
	{
	// Вычисляем случайный индекс массива
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];
	}
	return $pass;
}

function morkovin_add_admin_pages() 
{
    // Add a new submenu under Options:
    add_options_page('Морковин и Интеркасса', 'Платежная система', 8, 'interkassa', 'morkovin_options_page');
}

// mt_options_page() displays the page content for the Test Options submenu
function morkovin_options_page() 
{
	echo "<h2>Настройка платежной системы Интеркасса</h2>";
	echo "<p>Автор плагина: <a href='http://www.sdelaysite.com'>Андрей Морковин</a></p>";	
	
	//Изменение данных магазина
	echo "<h3>Общие настройки магазина</h3>";
	morkovin_change_shop();
	
	//Добавление товара
	echo "<h3>Добавить товара</h3>";
	morkovin_add_product();
	
	//Изменение информации о товаре
	echo "<h3>Список товаров</h3>";
	morkovin_change_product();	
}

//Изменение данных магазина
function morkovin_change_shop()
{
	//Если форма была отправлена, то применить изменения магазина
	if (isset($_POST['morkovin_base_setup_btn'])) 
	{   
	   if ( function_exists('current_user_can') && 
			!current_user_can('manage_options') )
				die ( _e('Hacker?', 'morkovin') );

		if (function_exists ('check_admin_referer') )
		{
			check_admin_referer('morkovin_base_setup_form');
		}

		$morkovin_shop_id = $_POST['morkovin_shop_id'];
		$morkovin_secret_key = $_POST['morkovin_secret_key'];
		$morkovin_status_url = $_POST['morkovin_status_url'];
		$morkovin_code_expiration = $_POST['morkovin_code_expiration'];

		update_option('morkovin_shop_id', $morkovin_shop_id);
		update_option('morkovin_secret_key', $morkovin_secret_key);
		update_option('morkovin_status_url', $morkovin_status_url);
		update_option('morkovin_code_expiration', $morkovin_code_expiration);
	}

	//Форма информации о магазине
	echo 
	"
		<form name='morkovin_base_setup' method='post' action='".$_SERVER['PHP_SELF']."?page=interkassa&amp;updated=true'>
	";
	
	if (function_exists ('wp_nonce_field') )
	{
		wp_nonce_field('morkovin_base_setup_form'); 
	}
	echo
	"
		<table>
			<tr>
				<td style='text-align:right;'>Идентификатор магазина:</td>
				<td><input type='text' name='morkovin_shop_id' value='".get_option('morkovin_shop_id')."'/></td>
				<td style='color:#666666;'><i>Идентификатор магазина можно узнать в личном кабинете Интеркассы.</i></td>
			</tr>
			<tr>
				<td style='text-align:right;'>Секретный код:</td>
				<td><input type='text' name='morkovin_secret_key' value='".get_option('morkovin_secret_key')."'/></td>
				<td style='color:#666666;'><i>Секретный код можно узнать в личном кабинете Интеркассы.</i></td>
			</tr>
			<tr>
				<td style='text-align:right;'>Status URL:</td>
				<td><input type='text' name='morkovin_status_url' value='".get_option('morkovin_status_url')."'/></td>
				<td style='color:#666666;'><i>Ссылка на страницу обработки платежа.</i></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style='font-size:10px; color:#666666'>http://www.moyblog.ru/status</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style='text-align:right;'>Срок хранения:</td>
				<td><input type='text' name='morkovin_code_expiration' value='".get_option('morkovin_code_expiration')."'/></td>
				<td style='color:#666666;'><i>Срок хранения ссылок.</i></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style='text-align:center'>
					<input type='submit' name='morkovin_base_setup_btn' value='Сохранить' style='width:140px; height:25px'/>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</form>
	";
}


//Изменение информации о товаре
function morkovin_change_product()
{
	global $wpdb;
	$table_products = $wpdb->prefix.morkovin_products;
	
	//Сохранение изменений товаров
	if ( isset($_POST['morkovin_products_setup_btn']) ) 
    {   
       if (function_exists('current_user_can') && 
            !current_user_can('manage_options') )
                die ( _e('Hacker?', 'morkovin') );

        if (function_exists ('check_admin_referer') )
        {
            check_admin_referer('morkovin_products_setup_form');
        }
		  
		$morkovin_product_name = $_POST['morkovin_product_name'];
        $morkovin_product_cost = $_POST['morkovin_product_cost'];
		$morkovin_product_id = $_POST['morkovin_product_id'];
		$morkovin_product_url = $_POST['morkovin_product_url'];
		
		$wpdb->update
					(
						$table_products,  
						array( 'name' => $morkovin_product_name, 'cost' => $morkovin_product_cost, 'url' => $morkovin_product_url),  
						array( 'id' => $morkovin_product_id ),  
						array( '%s', '%s', '%s'),  
						array( '%d' )
					);
			
    }
	
	//Удаление товара
	if ( isset($_POST['morkovin_products_delete_btn']) ) 
    {   
       if (function_exists('current_user_can') && 
            !current_user_can('manage_options') )
                die ( _e('Hacker?', 'morkovin') );

        if (function_exists ('check_admin_referer') )
        {
            check_admin_referer('morkovin_products_setup_form');
        }
		  
		$morkovin_product_id = $_POST['morkovin_product_id'];
		
		$wpdb->query("DELETE FROM $table_products WHERE id = $morkovin_product_id"); 
    }
	
	//Вывод формы информации по товарам
	$products = $wpdb->get_results("SELECT * FROM $table_products");
	foreach ($products as $item) 	
	{
		echo
		"
			<form name='morkovin_products_setup' method='post' action='".$_SERVER['PHP_SELF']."?page=interkassa&amp;updated=true'>
		";
		
		if (function_exists ('wp_nonce_field') )
		{
			wp_nonce_field('morkovin_products_setup_form'); 
		}
		
		echo
		"
				<p style='padding-top:30px;'><b>Товар ID = ".$item->id."</b></p>
				<table>
					<tr>
						<td style='text-align:right;'>Название:</td>
						<td><input type='text' name='morkovin_product_name' value='".$item->name."' style='width:300px;'/></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td style='text-align:right;'>Цена:</td>
						<td>
							<input type='text' name='morkovin_product_cost' value='".$item->cost."'/>
							<input type='hidden' name='morkovin_product_id' value='".$item->id."'/>
						</td>
						<td style='color: #666666;'><i>Соблюдайте формат поля - целая часть от дробной отделяется точкой, в дробной обязательно присутствуют два разряда.</i></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style='padding-left:5px; font-size:10px; color:#666666'>Пример: 1.00</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td style='text-align:right;'>URL товара:</td>
						<td>
							<input type='text' name='morkovin_product_url' value='".$item->url."' style='width:300px;'/>
						</td>
						<td style='color:#666666;'><i>Ссылка на товар, для его загрузки после успешной оплаты.</i></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style='padding-left:5px; font-size:10px; color:#666666'>Пример: http://www.moysite.ru/uploads/product1.zip</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type='submit' name='morkovin_products_setup_btn' value='Сохранить' style='width:140px; height:25px'/>
							<input type='submit' name='morkovin_products_delete_btn' value='Удалить' style='width:140px; height:25px'/>
						</td>
					</tr>
				</table>
			</form>
		";
	}
}

//Добавление товара
function morkovin_add_product()
{
	global $wpdb;
	$table_products = $wpdb->prefix.morkovin_products;
	
	
	//Сохранение добавленного товара в базу
	if ( isset($_POST['morkovin_add_product_btn']) ) 
    {   
       if (function_exists('current_user_can') && 
            !current_user_can('manage_options') )
                die ( _e('Hacker?', 'morkovin') );

        if (function_exists ('check_admin_referer') )
        {
            check_admin_referer('morkovin_add_product_form');
        }
		  
		$morkovin_product_name = $_POST['morkovin_product_name'];
        $morkovin_product_cost = $_POST['morkovin_product_cost'];
		$morkovin_product_url = $_POST['morkovin_product_url'];
		
		$wpdb->insert
					(
						$table_products,  
						array( 'name' => $morkovin_product_name, 'cost' => $morkovin_product_cost, 'url' => $morkovin_product_url),  
						array( '%s', '%s', '%s')
					);
    }
	
	//Форма добавления товара
	echo
		"
			<form name='morkovin_add_product' method='post' action='".$_SERVER['PHP_SELF']."?page=interkassa&amp;updated=true'>
		";
		
		if (function_exists ('wp_nonce_field') )
		{
			wp_nonce_field('morkovin_add_product_form'); 
		}
	
	echo
	"
			<table>
				<tr>
					<td style='text-align:right;'>Название:</td>
					<td><input type='text' name='morkovin_product_name' style='width:300px;'/></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style='text-align:right;'>Цена:</td>
					<td>
						<input type='text' name='morkovin_product_cost'/>
					</td>
					<td style='color: #666666;'><i>Соблюдайте формат поля - целая часть от дробной отделяется точкой, в дробной обязательно присутствуют два разряда.</i></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style='padding-left:5px; font-size:10px; color:#666666'>Пример: 1.00</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style='text-align:right;'>URL товара:</td>
					<td>
						<input type='text' name='morkovin_product_url' style='width:300px;'/>
					</td>
					<td style='color:#666666;'><i>Ссылка на товар, для его загрузки после успешной оплаты.</i></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style='padding-left:5px; font-size:10px; color:#666666'>Пример: http://www.moysite.ru/uploads/product1.zip</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type='submit' name='morkovin_add_product_btn' value='Добавить' style='width:140px; height:25px'/>
					</td>
				</tr>
			</table>
		</form>
	";
}

function start_download()
{
	global $wpdb;
	
	delete_expired_codes();
	
	$dcode = $_GET['dcode'];
	
	$table_downloadcode = $wpdb->prefix.morkovin_downloadcodes;	
	$table_products = $wpdb->prefix.morkovin_products;
	
	$code_product = $wpdb->get_row
	(  
		$wpdb->prepare
		(  
			"SELECT * FROM $table_downloadcode WHERE downloadcode = %s", 
			$dcode
		)
	);
	
	if($code_product)
	{	
		$product_code_id = $code_product->product_id;
		
		$product = $wpdb->get_row
		(  
			$wpdb->prepare
			(  
				"SELECT * FROM $table_products WHERE id = %d", 
				$product_code_id
			)
		);
		
		$url = $product->url;
		
		download_file($url);
	}
	else
	{
		echo "Ссылка не активна";
	}
}

function interkassa_process()
{	
	global $wpdb;
	$table_products = $wpdb->prefix.morkovin_products;
	
	//Данные от Интеркассы
	$status_data['ik_payment_id'] = $_POST["ik_payment_id"];
	$status_data['ik_paysystem_alias'] = $_POST["ik_paysystem_alias"];
	$status_data['ik_sign_hash'] = $_POST['ik_sign_hash'];
	$status_data['ik_baggage_fields'] = $_POST['ik_baggage_fields'];
	$status_data['ik_trans_id'] = $_POST['ik_trans_id'];
	$status_data['ik_currency_exch'] = $_POST['ik_currency_exch'];
	$status_data['ik_fees_payer'] = $_POST['ik_fees_payer'];
	

	//Данные магазина из таблицы о магазине
	$my_secret_key = get_option('morkovin_secret_key');
	$my_data['ik_shop_id'] = get_option('morkovin_shop_id');

	//Сколько нужно было бы заплатить
	$product_id = $status_data['ik_payment_id'];
	
	$product_id = 1;
	
	$product = $wpdb->get_row
	(  
		$wpdb->prepare
		(  
			"SELECT * FROM $table_products WHERE id = %d", 
			$product_id
		)
	);
	
	$my_data['ik_payment_amount'] = $product->cost;
	
	//Остальные данные для хеша
	$my_data['ik_payment_id'] = $status_data['ik_payment_id'];
	$my_data['ik_paysystem_alias'] = $status_data['ik_paysystem_alias'];
	$my_data['ik_baggage_fields'] = $status_data['ik_baggage_fields'];
	$my_data['ik_payment_state'] = "success";
	$my_data['ik_trans_id'] = $status_data['ik_trans_id'];
	$my_data['ik_currency_exch'] = $status_data['ik_currency_exch'];
	$my_data['ik_fees_payer'] = $status_data['ik_fees_payer'];
	
	//Положительные результат транзакции
	$status_data['payment_state'] = "success";
	
	$my_sing_hash_str = $my_data['ik_shop_id'].':'. //Идетификатор магазина
	$my_data['ik_payment_amount'].':'. //Сумма платежа
	$my_data['ik_payment_id'].':'. //Идентификатор покупки
	$my_data['ik_paysystem_alias'].':'. //Способ оплаты
	$my_data['ik_baggage_fields'].':'. //Дополнительное поле (эл. почта)
	$my_data['ik_payment_state'].':'. //Статус (успешный = success)
	$my_data['ik_trans_id'].':'. //Уникальный номер платежа
	$my_data['ik_currency_exch'].':'. //Курс валюты
	$my_data['ik_fees_payer'].':'. //Плательщик комиссии 0 - за счет продавца
	$my_secret_key;
	
	$my_sign_hash = strtoupper(md5($my_sing_hash_str));

	//if($status_data['ik_sign_hash'] === $my_sign_hash) 
	{
		$code = morkovin_random_string(10);
		$ctime = time();
		//$product_id = $my_data['ik_payment_id'];
		$product_id = 1;
		
		$table_downloadcode = $wpdb->prefix.morkovin_downloadcodes;
		
		$wpdb->insert
					(
						$table_downloadcode,  
						array( 'downloadcode' => $code, 'ctime' => $ctime, 'product_id' => $product_id),  
						array( '%s', '%d', '%d')
					);
		
		$status_url = get_option('morkovin_status_url');
		preg_match('/^http(s)?\:\/\/[^\/]+\/(.*)$/i', $status_url, $matches);
		
		$morkovin_download_url = $_SERVER['HTTP_HOST']."/".$matches[2];
		
		wp_mail($my_data['ik_baggage_fields'], "Покупка", "Вот вам ссылка на покупку: http://$morkovin_download_url?dcode=$code");
	}
}

function morkovin_run($content) 
{
	
	$status_url = get_option('morkovin_status_url');
	preg_match('/^http(s)?\:\/\/[^\/]+\/(.*)$/i', $status_url, $matches);
	
	$real_url = $_SERVER['REQUEST_URI'];	
	preg_match('/^\/([^\?]*)(\?.+)?$/i', $real_url, $real_matches);
	
	if($real_matches[1] == $matches[2])
	{	
		if ( isset($_GET['dcode']) ) 
		{
			start_download();
		}
		else
		{
			interkassa_process();
		}
	}	
}

function morkovin_install()
{
    global $wpdb;
	
	$table_products = $wpdb->prefix.morkovin_products;
	$table_downloadcodes = $wpdb->prefix.morkovin_downloadcodes;
	
    $sql1 = 
	"
		CREATE TABLE IF NOT EXISTS `".$table_downloadcodes."` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `downloadcode` varchar(64) NOT NULL,
		  `product_id` int(11) NOT NULL,
		  `ctime` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";
	
	$sql2 =
	"
		CREATE TABLE IF NOT EXISTS `".$table_products."` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `name` varchar(250) NOT NULL,
		  `cost` varchar(250) NOT NULL,
		  `url` varchar(250) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";

	
    $wpdb->query($sql1);
	$wpdb->query($sql2);
	
	//Значения по умолчанию для настроек магазина
	add_option('morkovin_shop_id', 'Не задано');
	add_option('morkovin_secret_key', 'Не задано');
	add_option('morkovin_status_url', 'http://myblog.loc/status');
	add_option('morkovin_code_expiration', '10');
}

function morkovin_uninstall()
{
    global $wpdb;
	
	$table_products = $wpdb->prefix.morkovin_products;
	$table_downloadcodes = $wpdb->prefix.morkovin_downloadcodes;
	
    $sql1 = "DROP TABLE `".$table_products."`;";
	$sql2 = "DROP TABLE `".$table_downloadcodes."`";
	
    $wpdb->query($sql1);
	$wpdb->query($sql2);
	
	delete_option('morkovin_shop_id');
	delete_option('morkovin_secret_key');
	delete_option('morkovin_status_url');
	delete_option('morkovin_code_expiration');
}

register_activation_hook( __FILE__, 'morkovin_install');
register_deactivation_hook( __FILE__, 'morkovin_uninstall');

add_action('admin_menu', 'morkovin_add_admin_pages');
add_action( 'init', 'morkovin_run' );

?>
