<?php

function registration_validation( $username, $password, $nsf, $email, $phone, $contract, $kwart )  {
    global $reg_errors, $wpdb;

    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) || empty($nsf) || empty($phone) || empty($contract) || empty($kwart)) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username', 'Username too short. At least 4 characters is required');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Password length must be greater than 5');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email', 'Email is not valid');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email Already in use');
    }

    $base = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}contract WHERE `contract` = $contract AND `kwart` = $kwart");

    if ( !$base ) {
        $reg_errors->add('contract', 'Данного договора и номера квартиры в базе не найдено');
    }

    if ( is_wp_error( $reg_errors ) ) {
        return $reg_errors;
//        foreach ( $reg_errors->get_error_messages() as $error ) {
//            echo '
//                <div class="alert alert-danger alert-dismissible fade in" role="alert">
//                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
//                        aria-hidden="true">x</span></button>
//                <p>' . $error . '</p>
//                </div>
//            ';
//        }
    }
    return false;
}

function complete_registration()
{
    global $reg_errors, $username, $password, $email, $first_name, $phone, $contract, $kwart;

    if (count($reg_errors->get_error_messages()) < 1) {
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,
            'first_name' => $first_name,
        );
        $user = wp_insert_user($userdata);

        add_user_meta($user, 'contract', $contract);
//        add_user_meta($user, 'personal_acc_num', $contract);
//        add_user_meta($user, 'last_payment', $kwart);

        $headers = 'From: '. get_option('admin_email') . "\r\n";
        wp_mail("$email", 'Регистрация', 'Вы зарегестрированы на сайте «Чернівцітеплокомуненерго»', $headers);
        return true;

    }
}

function showErrLog() {
    echo $_SESSION['err_log'];
//    $_SESSION['err_log'] = 'fsdfsd';
}

//function itkr_login($log, $pwd) {
//    global $reg_errors;
//    $reg_errors = new WP_Error;
//
//    $user = wp_authenticate( $log, $pwd );
//
//    // авторизация не удалась
//    if ( is_wp_error($user) ) {
//        $reg_errors->add('pwd', 'Неправильный пароль или логин');
//
////            wp_redirect(get_site_url().'/avtorizaciya');
//
//    } else {
//        wp_signon();
//        wp_redirect(get_site_url().'/osobistij-kabinet');
//    }
//}