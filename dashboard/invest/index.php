<?php
if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
	if(isset($_GET['plan'])) header('Location: https://' . $_SERVER['HTTP_HOST'] . '/invest/'.$_GET['plan']);
	else header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
	}
require_once '../../actions/User.php'; {
    $plan = null;
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if (isset($_REQUEST['plan'])) {
                if ($user->iscomplete) {
                    if ($user->block == 0) {
                        $plan = $_REQUEST['plan'];
                        if ($plan == 10) {
                            $user->proHelp($plan);
                            $color = '#ece883';
                        } elseif ($plan == 20) {
                            $user->proHelp($plan);
                            $color = '#dce873';
                        } elseif ($plan == 50) {
                            $user->proHelp($plan);
                            $color = '#bce863';
                        } elseif ($plan == 100) {
                            $user->proHelp($plan);
                            $color = '#ace853';
                        } else {
                            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
                        }
                    } else {
                        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
                    }
                } else {
                    header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/accdetails/');
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

        <title>Colaboe</title>
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

        <div id="wrapper">
            <?php include_once '../../actions/loginnav.ini.php'; ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row"><br></div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-success">
                                        <div class="panel-heading" align="center" <?php
            if (isset($color) && $color != null) {
                echo 'style="background-color: ' . $color . '">';
            }if ($user->getPayee($plan) instanceof User) {
                echo 'You Will Pay';
            } elseif ($user->getPayers($plan) != 0) {
                echo 'You Will Get Paid By';
            }
            ?>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">

                                        <?php
                                        //echo $user->getPayee($plan);
                                        if ($user->getPayee($plan) instanceof User) {
                                            $payee = $user->getPayee($plan);
                                            $row = $payee->getPayer($plan, $user->uid);
                                            $conf = $user->hasuploaded($plan, $payee);
                                            $col = $conf != '' ? 'success' : 'info';
                                            $but = $conf != '' ? 'Accepted' : 'Accept';
                                            $tim = new DateTime($row['time']);
    					    $tie = date_diff($tim, (new DateTime("now")));
   					    $time = ($tie->format('%h')-7);
                                            $cool = $conf > 0 ? 'success disabled' : (($time < 24) ? 'warning disabled' : 'danger disabled');
                                            $block = $conf > 0 ? '' : (($time > 24) ? 'block' : '');
                                            echo '<div align="center" class="col-lg-12 alert alert-' . $col . '" >
                                                            <div class="col-lg-12">
                                                            <form method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/account/">
                                                        <input type="hidden" name="uid" value="' . $payee->uid . '">
                                                        <button class="btn btn-warning col-lg-4 col-lg-offset-1">
                                                            <b>' . User::getNameI($payee->uid) . ' : ' . User::getPhoneI($payee->uid) . '</b>
                                                        </button>
                                                    </form>
                                                        <a href="' . $block . '" class="btn btn-' . $cool . ' col-lg-1 col-lg-offset-1">
                                                            <b>' . $time . ' Hours</b>
                                                        </a>
                                                    <form method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/decline/?plan=' . $plan . '">
                                                        <input type="hidden" name="gorb" value="' . $plan . '">
                                                        <button type="submit" class="btn btn-danger col-lg-1 col-lg-offset-1">
                                                            <b>Decline</b>
                                                        </button>
                                                    </form>
                                                    <form method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/upload/?plan=' . $plan . '">
                                                        <input type="hidden" name="uid" value="' . $payee->uid . '">
                                                        <button type="submit" class="btn btn-' . $col . ' col-lg-2 col-lg-offset-1">
                                                            <b>' . $but . '</b>
                                                        </button>
                                                    </form></div>
                                                </div>';
                                        } elseif (count($user->getPayers($plan)) != 0) {
                                            $rows = $user->getPayers($plan);
                                            foreach ($rows as $row) {
                                                $col = 'info';
                                                $but = 'Confirm';
                                                $tim = new DateTime($row['time']);
    					        $tie = date_diff($tim, (new DateTime("now")));
   					        $time = ($tie->format('%h')-7);
                                                $cool = (($time < 24) ? 'warning disabled' : 'danger disabled');
                                                $block = (($time > 24) ? 'block.php' : '');
                                                echo '<div align="center" class="alert alert-' . $col . '" >
                                                            <div class="row ">
                                                            <form method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/account/">
                                                        <input type="hidden" name="uid" value="' . $row['uid'] . '">
                                                        <button class="btn btn-warning col-lg-4 col-lg-offset-1">
                                                            <b>' . User::getNameI($row['uid']) . ' : ' . User::getPhoneI($row['uid']) . '</b>
                                                        </button>
                                                    </form>
                                                    <div class="row">
                                                        <a href="#" class="btn btn-' . $cool . ' col-lg-2 col-lg-offset-1">
                                                            <b>' . $time . ' Hours</b>
                                                        </a>
                                                    <form method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/confirm/">
                                                        <input type="hidden" name="uid" value="' . $row['uid'] . '">
                                                        <input type="hidden" name="plan" value="' . $plan . '">
                                                        <button type="submit" class="btn btn-' . $col . ' col-lg-2 col-lg-offset-1">
                                                            <b>' . $but . '</b>
                                                        </button>
                                                    </form></div></div>
                                                </div>';
                                            }
                                        } else {
                                            echo 'Please wait to be paired...';
                                        }
                                        ?>
                                    </div>
                                    <!-- .panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#wrapper -->

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
