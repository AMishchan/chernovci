<?php

if( isset( $_GET['logout'] ) ) {
    wp_logout();
}

if ($_SERVER["REQUEST_URI"] == '/osobistij-kabinet' ||
    $_SERVER["REQUEST_URI"] == '/podati-pokazannya-lichilnikiv' ||
    $_SERVER["REQUEST_URI"] == '/splatiti-poslugi' ||
    $_SERVER["REQUEST_URI"] == '/abonentnij-viddil'
) {
    if (!is_user_logged_in()) {
        wp_redirect(get_site_url().'/avtorizaciya');
        exit();
    }
}

if ($_SERVER["REQUEST_URI"] == '/avtorizaciya') {
    if (is_user_logged_in()) {
        wp_redirect(get_site_url().'/osobistij-kabinet');
        exit();
    }
}