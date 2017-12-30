<?php
require_once '../actions/User.php';
{
    if (!isset($_REQUEST['uid']) || $_REQUEST['uid'] == "") {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
    }
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if ($user->admin > 0)
                $u = new User(User::getEmail($_REQUEST['uid']));
            else {
                if (!isset($_POST['uid']) || $_POST['uid'] == "") {
                    header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
                }
                $u = new User(User::getEmail($_REQUEST['uid']));
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
<?php include_once '../actions/loginnav.ini.php'; ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row">
                        </div>
                        <div class="col-lg-12" style="padding-top: 10px">

                            <div class="panel panel-default panel-info">
                                <div class="panel-heading" align="center">
                                    <b><?php
                                        echo strlen($user->gender) == 4 ? 'Mr ' : 'Mrs/Miss ';
                                        echo $u->fname . "'s"
                                        ?> Details</b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group list-inline">
                                                <div class="alert alert-info">First Name
                                                    <input class="form-control" readonly value="<?php echo $u->fname ?>" />
                                                </div>
                                                <div class="alert alert-info">Last Name
                                                    <input class="form-control" readonly value="<?php echo $u->lname ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group list-inline">
                                                <div class="alert alert-info">E-Mail
                                                    <input class="form-control" readonly value="<?php echo $u->email ?>" />
                                                </div>
                                                <div class="alert alert-info">Phone Number
                                                    <div class="input-group">
                                                        <span class="input-group-addon" >+234</span>
                                                        <input class="form-control" readonly value="<?php echo $u->phone ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group list-inline">
                                                <div class="alert alert-info">Account Name
                                                    <input class="form-control" readonly value="<?php echo $u->accname ?>" />
                                                </div>
                                                <div class="alert alert-info">Account Type
                                                    <input class="form-control" readonly value="<?php echo $u->acctype ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group list-inline">
                                                <div class="alert alert-info">Account Number
                                                    <input class="form-control" readonly value="<?php echo $u->accno ?>" />
                                                </div>
                                                <div class="alert alert-info">Bank Name
                                                    <input class="form-control" readonly value="<?php echo $u->bname ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
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
