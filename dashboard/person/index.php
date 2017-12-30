<?php
if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
	 header('Location: https://' . $_SERVER['HTTP_HOST'] .'/dashboard/person/');
	}
require_once '../../actions/User.php';
{
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User(User::getEmail($_COOKIE['ginvestid']));
            if (isset($_POST['pass']) && md5($_POST['pass']) == $user->pass) {
                if ((isset($_POST['fname']) && $_POST['fname'] != "")) {
                    $user->updateFname($_POST['fname']);
                }
                if ((isset($_POST['lname']) && $_POST['lname'] != "")) {
                    $user->updateLname($_POST['lname']);
                }
                if ((isset($_POST['email']) && $_POST['email'] != "")) {
                    $user->updateEmail($_POST['email']);
                }
                if (!(isset($_POST['phone']) && $_POST['phone'] != "")) {
                    $user->updatePhone($_POST['phone']);
                }
            } else {
                $error = ' please verify your password';
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

                            <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/person/">
                                <div class="panel panel-default panel-info">
                                    <div class="panel-heading" align="center">
                                        <b>Your Personal Details</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group list-inline">
                                                    <div class="alert alert-info">First Name : <?php echo $user->fname ?>
                                                        <input class="form-control" name="fname" placeholder="New Name" pattern="[A-Za-z]{20,}"/>
                                                    </div>
                                                    <div class="alert alert-info">Last Name : <?php echo $user->lname ?>
                                                        <input class="form-control" name="lname" placeholder="New Name" pattern="[A-Za-z]{20,}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group list-inline">
                                                    <div class="alert alert-info">E-Mail : <?php echo $user->email ?>
                                                        <input class="form-control" name="email" placeholder="New E-Mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/>
                                                    </div>
                                                    <div class="alert alert-info">Telephone : <?php echo $user->phone ?>
                                                        <input class="form-control" name="phone" placeholder="New Phone-Number" pattern="[0-9]{10,11}" minlength="10" maxlength="11"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="alert alert-info input-group">
                                                    <span class="input-group-addon">Referral ID&nbsp;</span>
                                                    <input class="form-control" readonly value="https://<?php echo $_SERVER['HTTP_HOST'] . '/register/?ref=' . str_replace(' ','',str_replace(':','',str_replace('-','',$user->regdate))) ?>" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="alert alert-info" align="center">
                                                    Refer 15 people and get an instant 200% of your next investment.<br> You will confirm this with your email
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="alert alert-danger" align="center">Confirm-Password
                                                    <input class="form-control" name='pass' type="password" required placeholder="Confirm-Password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6" >
                                                <?php
                                                if (isset($error)) {
                                                    echo ' 
                                                            <div class="alert alert-danger alert-dismissable alert-dismissible" align="center">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $error . ' 
                                                            </div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <input href="#" name="submit" value="Update" type="submit" class="btn btn-block btn-info"/>
                                    </div>
                                </div>
                            </form>
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
