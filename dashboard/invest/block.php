<?php
require_once '../../actions/User.php'; {
    $plan = null;
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/actions/logout/');
        }
    } else {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/actions/logout/');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Harry">

        <title>Collabo</title>
        <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/img/gi.png" rel="icon">
        <!-- Bootstrap Core CSS -->
        <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/css/gi.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">
            <?php include_once '../../actions/loginnav.ini.php'; ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row"><br></div>
                        <div class="col-lg-12">
                            <div class="panel-red">
                                <div align="center" class="panel-heading">
                                    Request Block
                                </div>
                                <div class="panel-body panel-danger">
                                    <div align="center" class="col-lg-12 alert alert-dark" >
                                        <div class="col-lg-12">
                                            <form method="post" action="http://' <?php echo $_SERVER['HTTP_HOST'] ?> '/account/">
                                                <input type="hidden" name="uid" value="<?php echo $payee->uid ?>">
                                                <button class="btn btn-warning col-lg-4 col-lg-offset-1">
                                                    <b>' . User::getNameI($payee->uid) . ' : ' . User::getPhoneI($payee->uid) . '</b>
                                                </button>
                                            </form>
                                            <a href="' . $block . '" class="btn btn-' . $cool . ' col-lg-2 col-lg-offset-1">
                                                <b>' . $time . ' Days ago</b>
                                            </a>
                                            <form method="post" action="http://' . $_SERVER['HTTP_HOST'] . '/upload/?plan=' . $plan . '">
                                                <input type="hidden" name="uid" value="' . $payee->uid . '">
                                                <button type="submit" class="btn btn-' . $col . ' col-lg-2 col-lg-offset-1">
                                                    <b>' . $but . '</b>
                                                </button>
                                            </form> </div>
                                    </div>
                                </div>
                            </div
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/js/gi.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/js/sb-admin-2.js"></script>

    </body>

</html>
