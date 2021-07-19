<?php

function chek_session()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if (!(isset($session['status_login']))) {
        redirect('auth/login');
    }
}

function chek_role1()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if ($session['akses'] != 1) {
        redirect('errorakses');
    }
}
