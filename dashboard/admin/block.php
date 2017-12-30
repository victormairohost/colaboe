<?php

include '../../actions/User.php';
include '../../actions/Admin.php'; {
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User(User::getEmail($_COOKIE['ginvestid']));
            if (($user->admin > 0) && (isset($_REQUEST['uid']) && User::exists(User::getEmail($_REQUEST['uid'])))) {
                $admin = new Admin($user);
                $us = new User(User::getEmail($_REQUEST['uid']));
                $admin->blockS($us);
            }
        } else {
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/actions/logout/');
        }
    } else {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/actions/logout/');
    }
}
header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard');
