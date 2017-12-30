<?php

require_once '../actions/User.php'; {
    $plan = null;
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if (isset($_POST['gorb'])) {
                $plan = $_POST['gorb'];
                if ($plan == 10) {
                    $user->decline($plan);
                } elseif ($plan == 20) {
                    $user->decline($plan);
                } elseif ($plan == 50) {
                    $user->decline($plan);
                } elseif ($plan == 100) {
                    $user->decline($plan);
                }
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
            } else {
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard');
            }
        } else {
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/actions/logout/');
        }
    } else {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/actions/logout/');
    }
}

