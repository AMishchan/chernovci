<?php
/*
Plugin Name: itkr-import-file
Plugin URI:
Description: import file
Author:
Contributor:
Contributor:
Author URI:
Version: 1.0
*/
?>

<?php

function itkr_read_dirs($file)
{

    if (is_file($file)) {
      
        $info = new SplFileInfo($file);
        if ($info->getExtension() == 'sql' ) {
            return $file;
        }
    } elseif (is_dir($file)) {
        $dir_files = scandir($file);
        foreach ($dir_files as $f) {
            if ($f == '.' || $f == '..') continue;
            $result = itkr_read_dirs($file.'/'.$f);
            if (is_null($result)) continue;
            $list[] = $result;
        }
        return $list;
    }
}

?>
<?php function itkr_options_page() 
{ ?>

    <?php
        if( wp_verify_nonce( $_POST['fileup_nonce'], 'my_file_upload' ) ){
            if ( ! function_exists( 'wp_handle_upload' ) )
                require_once( ABSPATH . 'wp-admin/includes/file.php' );

            $file = &$_FILES['my_file_upload'];
            $overrides = array( 'test_form' => false );

            $movefile = wp_handle_upload( $file, $overrides );
//
            if ( $movefile && empty($movefile['error']) ) {
                echo "<div class='updated notice notice-success is-dismissible'><p>Файл загружен</p></div>\n";
//
            } else {
                echo "<div class='error'><p>Произошла ошибка при загрузке</p></div>\n";
            }
        }

    ?>

    <div class="wrap">


        <h2>Добавить файл</h2>

        <form method="post" enctype="multipart/form-data" action="">
            <?php wp_nonce_field( 'my_file_upload', 'fileup_nonce' ); ?>
            <input name="my_file_upload" type="file" />
            <input type="submit" value="Отправить">
        </form>
    </div>
    
    <?php
}
add_action('admin_menu', 'itkr_import_file_add_menu');
function itkr_import_file_add_menu() {
    add_menu_page('Імпорт', 'Імпорт', 'administrator', 'import-file', 'itkr_options_page', 'dashicons-clipboard', 85);
}

add_action('admin_menu', 'register_itkr_custom_submenu_page');
function register_itkr_custom_submenu_page() {
    add_submenu_page('import-file', 'Добавить в базу', 'Добавить в базу', 'administrator', 'import-file-insert', 'itkr_custom_submenu_page_callback');
}

function itkr_custom_submenu_page_callback() {
    global $wpdb;

    $arr_upload = itkr_read_dirs(wp_upload_dir()['basedir']);
    $arr_years = [];
    $arr_month = [];

    for($i = 0; $i < count($arr_upload); $i++) {
        $arr_years = array_merge($arr_years, $arr_upload[$i]);
    }

    for($i = 0; $i < count($arr_years); $i++) {
        $arr_month = array_merge($arr_month, $arr_years[$i]);
    }

//    $files = array_filter($arr_month, function($el){
//        return !is_null($el);
//    });

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_to_db'])) {

        $insert_file = $_POST['insert_file'];
        $table = $_POST['insert_to_db'];

        if (!is_file($insert_file)) {
            $response = 'Формат файла не корректен';
            return $response;
        }

        $file = file_get_contents($insert_file);

        if (!$file) {
            $response = 'Ошибка при чтении файла';
            return $response;
        }


        $arr = explode(';', $file);

//        $output = array_slice($arr, 0, 10);

        if ($table == '1') {
            foreach ($arr as $sql) {
                $arr = explode(',', $sql);
                $arr[0] = substr($arr[0], strpos($arr[0], '(' ) + 1);
                $arr[12] = substr($arr[12], 0, -1);

                    $wpdb->query("INSERT INTO {$wpdb->prefix}accounting
                     (`contract`, `saldop`, `narah`, `pererah`, `oplata`, `subs`, `obs`, `rozstr`, `date`)
                     VALUES ($arr[0], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[12], $arr[11], $arr[1])");


            }
        } elseif ($table == '2') {
            foreach ($arr as $sql) {
                $arr = explode(',', $sql);
                $arr[0] = substr($arr[0], strpos($arr[0], '(' ) + 1);
                $arr[12] = substr($arr[12], 0, -1);

                $wpdb->query("INSERT INTO {$wpdb->prefix}contract
                  (`contract`, `street`, `bud`, `kwart`)
                  VALUES ($arr[0], $arr[2], $arr[3], $arr[4])");
           }
        }

        echo "<div class='updated notice notice-success is-dismissible'><p>Файл выполнен</p></div>\n";
    }

    echo '<div class="wrap">';
    echo '<h2>Добавити в БД</h2>';
    echo '
        <form method="post" action="">
        <select name="insert_to_db" id="">
            <option value="1">' . $wpdb->prefix.'accounting</option>
            <option value="2">' . $wpdb->prefix.'contract</option>
        </select>
        
        <select name="insert_file" id="">';
        
        foreach($arr_month as $file) {
            echo '<option value="'.$file.'">'.basename($file).'</option>';
        }

        echo '
            </select>
            <input type="submit" value="Добавити">
            </form>
            </div>
        ';

}
