<?php
require_once '../actions/User.php'; {
    $plan = null;
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if (isset($_POST['plan']) && isset($_POST['uid'])) {
                $u = new User(User::getEmail($_POST['uid']));
                $plan = $_POST['plan'];
                if ($plan == 10) {
                    if (isset($_POST['doit'])) {
                        $user->confirm($plan, $u);
                        if ($user->istobepayed($plan))
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard/invest/?plan=$plan");
                        else
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard");
                    }
                    $color = '#ece883';
                } elseif ($plan == 20) {
                    if (isset($_POST['doit'])) {
                        $user->confirm($plan, $u);
                        if ($user->istobepayed($plan))
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard/invest/?plan=$plan");
                        else
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard");
                    }
                    $color = '#dce873';
                } elseif ($plan == 50) {
                    if (isset($_POST['doit'])) {
                        $user->confirm($plan, $u);
                        if ($user->istobepayed($plan))
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard/invest/?plan=$plan");
                        else
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard");
                    }
                    $color = '#bce863';
                } elseif ($plan == 100) {
                    if (isset($_POST['doit'])) {
                        $user->confirm($plan, $u);
                        if ($user->istobepayed($plan))
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard/invest/?plan=$plan");
                        else
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . "/dashboard");
                    }
                    $color = '#ace853';
                }
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta https-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Harry">

        <title>Confirm</title>
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/img/gi.png" rel="icon">

        <!-- Bootstrap Core CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/css/gi.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="httpss://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="httpss://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container">
            <div class="row"><br><br><br><br>
                <div class=" col-lg-9 panel panel-default">
                    <div  class="panel-body">
                        <img class="img-rounded img-responsive" src="https://<?php echo $_SERVER['HTTP_HOST'].'/upload/' . ($u->hasuploaded($plan, $user)) ?>" alt="Sorry no Picture Available">
                    </div>
                </div>
                <div class="col-lg-2 col-lg-offset-1  panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'] ?>/confirm/">
                            <input name="doit" value="yes" type="hidden">
                            <input name="uid" value="<?php echo $_POST['uid'] ?>" type="hidden">
                            <input name="plan" value="<?php echo $plan ?>" type="hidden">
                            <input class="alert btn btn-lg btn-primary btn-block" type="submit" value="Confirm">
                        </form>
                        <a class="alert btn btn-lg btn-primary btn-block" href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/js/gi.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/js/sb-admin-2.js"></script>

    </body>

</html>
