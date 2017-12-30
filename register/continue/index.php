<?php
require_once '../../actions/User.php';
{
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            $go = 'no';
            if (isset($_POST['accname']) && $_POST['accname'] != "") {
                $user->updateAccname($_POST['accname']);
                $go = 'yes';
            }
            if (isset($_POST['accno']) && strlen($_POST['accno']) == 10) {
                if (User::existsAccount($_POST['accno'])) {
                    $error = 'account number already exists';
                } else {
                    $user->updateAccno($_POST['accno']);
                    $go = 'yes';
                }
            }
            if (isset($_POST['acctype']) && (strtolower($_POST['acctype']) == 'savings' || strtolower($_POST['acctype']) == 'current')) {
                $user->updateAcctype($_POST['acctype']);
                $go = 'yes';
            }
            if (isset($_POST['bname']) && $_POST['bname'] != "") {
                $user->updateBname($_POST['bname']);
                $go = 'yes';
            }
            if ($go === 'yes') {
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
            }
        }
    }else{
        header('Location: https://' . $_SERVER['HTTP_HOST']);
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

        <title>Finish Up</title>
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/img/gi.png" rel="icon">

        <!-- Bootstrap Core CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/css/gi.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <style>
            #mainNav{
                position: fixed;
            }
            #body{
                margin-top: 50px;
            }
        </style>
    </head>

    <body>
        <div id='body' class="container">
            <div class="row">
                <div class="row"><br></div>
                <div class="col-lg-6 col-lg-offset-3">
                    <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'] ?>/register/continue/">
                        <div class="panel panel-default panel-info">
                            <div class="panel-heading" align="center">
                                <b>You can fill this partially and finish up later or <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/">skip >></a></b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group list-inline">
                                            <div class="alert alert-info">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Account-Name" name="accname" type="text"  pattern="[A-Za-z_ ]{5,}" autofocus>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <input class="form-control" placeholder="Account-Number" name="accno" maxlength="10" minlength="10" type="tel" pattern="[0-9]{10,11}">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <div class="cs-select cs-skin-elastic" tabindex="0">
                                                            <select class="cs-options btn btn-block btn-info" name="acctype">
                                                                <option value="" disabled="" selected>Account Type</option>
                                                                <option value="Savings">Savings</option>
                                                                <option value="Current">Current</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="cs-select cs-skin-elastic" tabindex="0">
                                                        <select class="cs-options btn btn-block btn-info" name="bname">
                                                            <option value="" disabled="" selected="">Your Bank</option>
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
                                                <div class="alert-dark" align="center">
                                                    <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard"><b>You can do this later in the account details section</b></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <input name="submit" value="Complete" type="submit" class="btn btn-block btn-info"/>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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