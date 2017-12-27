<?php


function itkr_get_accounting($contract) {
    global $wpdb;

    return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}accounting WHERE `contract` = $contract ORDER BY `date` DESC");
}

function itkr_get_contract($contract) {
    global $wpdb;

    return $wpdb->get_row("SELECT * FROM {$wpdb->prefix}contract WHERE `contract` = $contract");
}

function itkr_get_dooplat($data) {
    return $data->saldop + $data->narah + $data->pererah - $data->oplata - $data->subs;
}