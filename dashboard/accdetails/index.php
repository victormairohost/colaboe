<?php
if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
	 header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/accdetails/');
	}
require_once '../../actions/User.php';
{
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if (isset($_POST['pass']) && md5($_POST['pass']) == $user->pass) {
                if ((isset($_POST['accname']) && $_POST['accname'] != "")) {
                    $user->updateAccname($_POST['accname']);
                }
                if ((isset($_POST['accno'])) || $user->iscomplete = false) {
                    if ($_POST['accno'] != $user->accno) {
                        if (!User::existsAccount($_POST['accno'])) {
                            if (strlen($_POST['accno']) == 10)
                                $user->updateAccno($_POST['accno']);
                            if ((isset($_POST['acctype']) && $_POST['acctype'] != "") && (strlen($_POST['accno']) == 10 || $user->iscomplete == false)) {
                                $user->updateAcctype($_POST['acctype']);
                            } else
                                $error = 'account type can not change without change in account number';
                            if ((isset($_POST['bname']) && $_POST['bname'] != "") && (strlen($_POST['accno']) == 10 || $user->iscomplete == false)) {
                                $user->updateBname($_POST['bname']);
                            } else
                                $error = isset($error) ? $error : 'bank can not change without change in account number';
                        }else {
                            $error = 'account number exists';
                        }
                    } else {
                        $error = 'valid account number required check account number';
                    }
                } else {
                    $error = 'new account number required';
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
                            <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/accdetails/">
                                <div class="panel panel-default panel-info">
                                    <div class="panel-heading" align="center">
                                        <b>Your Account Details</b>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group list-inline">
                                                    <div class="alert alert-info">Account Name : <?php echo $user->accname ?>
                                                        <input class="form-control" name="accname" placeholder="New Name"  pattern="[A-Za-z_ ]{5,}"/>
                                                    </div>
                                                    <div class="alert alert-info">Account Number : <?php echo $user->accno ?>
                                                        <input class="form-control" maxlength="10" minlength="10" type="tel" name="accno" placeholder="New Number"  pattern="[0-9]{10,}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group list-inline">
                                                    <div class="alert alert-info">Account Type : <?php echo $user->acctype ?>
                                                        <div class="cs-select cs-skin-elastic" tabindex="0">
                                                            <select class="cs-options btn btn-block btn-info" name="acctype">
                                                                <option value="" selected="">Other Type</option>
                                                                <option value="Savings">Savings</option>
                                                                <option value="Current">Current</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-info">Bank Name : <?php echo $user->bname ?>
                                                        <div class="cs-select cs-skin-elastic" tabindex="0">
                                                            <select class="cs-options btn btn-block btn-info" name="bname">
                                                                <option value="" selected="">New Bank</option>
                                                                <option value="Diamond Bank">Diamond Bank</option>
                                                                <option value="First Bank">First Bank</option>
                                                                <option value="Skye Bank">Skye Bank</option>
                                                                <option value="Eco Bank">Eco Bank</option>
                                                                <option value="Keystone Bank">Keystone Bank</option>
                                                                <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
                                                                <option value="Wema Bank">Wema Bank</option>
                                                                <option value="UBA Bank">UBA Bank</option>
                                                                <option value="Access Bank">Access Bank</option>
                                                                <option value="City Bank">City Bank</option>
                                                                <option value="Enterprise Bank">Enterprise Bank</option>
                                                                <option value="Fidelity Bank">Fidelity Bank</option>
                                                                <option value="First City Monument Bank">First City Monument Bank</option>
                                                                <option value="Heritage Bank">Heritage Bank</option>
                                                                <option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
                                                                <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                                                <option value="Union Bank">Union Bank</option>
                                                                <option value="Zenith Bank">Zenith Bank</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 center-block" align="center">
                                                <div class="row" align="center">
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
