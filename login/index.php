<?php
 if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/login/');
	}
require_once '../actions/User.php'; {
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvest'] == User::getEmail($_COOKIE['ginvestid'])) {
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
        }
    } else if (!isset($_POST['email']) || !isset($_POST['pass'])) {
        setcookie("ginvest", "", time() - 1000000, '/');
        setcookie("ginvestid", "", time() - 1000000, '/');
    } else {
        $email = $_POST['email'];
        if (!User::valid($email, $_POST['pass'])) {
            $error = (User::exists($email)) ? "Wrong Password" : "Email not registered";
        } else {
            $user = new User($email);
            if ($user->isvered == 1) {
                $r = $_POST['remember'] == yes ? (15 * 7 * 24 * 60) : 600;
                setcookie('ginvest', $email, time() + 60 * $r, '/');
                setcookie('ginvestid', $user->uid, time() + 60 * $r, '/');
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
            } else
                $error = 'Unconfirmed email';
        }
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta https-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Harry">

        <title>Sign in</title>
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
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel  panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center"> Login</h3>
                        </div>
                        <div class="panel-body primary panel-primary">
                            <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'] ?>/login/">
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-Mail" name="email" required type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <h6><?php
                                        if (isset($error)) {
                                            echo $error;
                                        }
                                        ?></h6>
                                    <input class="form-control" placeholder="Password" name="pass" required type="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="yes"> Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div >
                                    <input type="submit" value="Login" style="background-color: #2299ff;" class="btn btn-lg btn-info btn-block"/>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer col-lg-12 panel-heading" style="border: solid #22aaff thin;">
                            <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/register" style="background-color: #22aaff;" class="btn btn-primary btn-block">No Account? Register</a>
                            <!--<a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/fgpw/" style="background-color: #22aaff;" class="btn btn-danger btn-block">Or Forgot Password ?</a>-->
                        </div>
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
