<?php
if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/register/');
	}
require_once '../actions/User.php';
{
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User(User::getEmail($_COOKIE['ginvestid']));
        }
    }
    $ref = isset($_REQUEST['ref'])?"?ref=".$_REQUEST['ref']:'';
    if (!(isset($_POST['fname']) && $_POST['fname'] != "")) {
        
    } else if (!(isset($_POST['lname']) && $_POST['lname'] != "")) {
        $error = 'last name required';
    } else if (!(isset($_POST['email']) && ($_POST['email'] != ""))) {
        $error = 'email';
    } else if (!(isset($_POST['phone']) && strlen($_POST['phone']) >= 10)) {
        $error = 'no phone number';
    } else if (!(isset($_POST['gender']) && (strtolower($_POST['gender']) == 'male' || strtolower($_POST['gender']) == 'female'))) {
        $error = 'invalid gender pick one';
    } else if (!(isset($_POST['agree']))) {
        $error = 'You have to agree first';
    } else if (!(isset($_POST['pass']) && strlen($_POST['pass']) >= 7)) {
        $error = 'invalid password : password can be anything more than 6 digits';
    } else if (!(isset($_POST['cpass']) && strlen($_POST['cpass']) >= 7)) {
        $error = 'please verify password';
    } else if (User::exists($_POST['email'])) {
        $error = 'email already exists';
    } else if (User::existsPhone($_POST['phone'])) {
        $error = 'phone number already exists';
    } else if ($_POST['cpass'] != $_POST['pass']) {
        $error = 'passwords do not match';
    } else {
        $user = User::make($_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['gender'], $_POST['pass']);
        if(isset($_REQUEST['ref']))
            $user->addref($_REQUEST['ref']);
        if ($user != null) {
            setcookie('ginvest', $_POST['email'], time() + 360000, '/');
            setcookie('ginvestid', User::getID($_POST['email']), time() + 360000, '/');
            setcookie('ginvestreg', 'yes', time() + 300, '/');
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/register/verify/');
        } else {
            
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

        <title>Register</title>
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
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work else if you view the page via file:// -->
        <!--[else if lt IE 9]>
            <script src="httpss://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="httpss://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endelse if]-->
    </head>

    <body>

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button id='menu-close' type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="https://<?php echo $_SERVER['HTTP_HOST'] ?>">COLABOE</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="https://<?php echo $_SERVER['HTTP_HOST'] ?>#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/login">Login</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <div id='body' class="container">
            <div class="row">
                <div class="row"><br></div>
                <div class="col-lg-4">
                    <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'].'/register/'.$ref ?>">
                        <div class="panel panel-default panel-pink">
                            <div class="panel-heading" align="center">
                                <b>Sign Up</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group list-inline">
                                            <div class="alert alert-info">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="First Name" name="fname" type="text" pattern="[A-Za-z]{3,}" value="" autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Last Name" name="lname"  type="text" pattern="[A-Za-z]{3,}">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="E-Mail" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon" >+234</span>
                                                    <input class="form-control" placeholder="Phone Number" name="phone" type="tel" pattern="[0-9]{10,11}" maxlength="11" minlength="10">
                                                </div>
                                                <div class="form-group" align="center">
                                                    <div class="form-control alert-danger" align="center">
                                                        <label>
                                                            <input name="gender" type="radio" value="male" >Male
                                                        </label>
                                                        <label>
                                                            <input name="gender" type="radio" value="female" > Female
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="alert-dark form-control" style="padding-left:10px">
                                                    <label><input type="checkbox" name="agree" > &nbspAccept <a class="light right">Terms & Conditions</a> </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12 ">
                                        <div class="form-group col-lg-12">
                                            <input class="form-control" placeholder="Password" name="pass" minlength="7" type="password" >
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <input class="form-control" placeholder="Confirm-Password" name="cpass" minlength="7" type="password" >
                                        </div>
                                    </div>
                                </div>
                                <?php {
                                    if (isset($error) && ( $error != NULL || $error != "")) {
                                        echo '<div class="alert alert-danger" align="center">' . $error . '</div>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="panel-footer">
                                <input name="submit" value="Register" type="submit" class="btn btn-block btn-success" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 well panel panel-default panel-pink">
                    <div class="panel panel-default panel-warning">
                        <div class="panel-body panel-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-warning form-group col-lg-12">
                                        This is a very good platform they even have multiple investments. And I choose who to block. I have invested in all the pools and have gotten payment
                                    </div><br>
                                </div>
                            </div>
                        </div>
                    </div>
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

