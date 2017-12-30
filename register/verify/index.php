<?php 
require_once '../../actions/User.php';
if(isset($_GET['token'])&&isset($_GET['gorb'])){
    if(User::exists(User::getEmail(str_replace('304','', ''.$_GET['gorb'])))){
        $u = new User(User::getEmail(str_replace('304','', ''.$_GET['gorb'])));
        if($u->isvered==1) header('Location: https://' . $_SERVER['HTTP_HOST'] . '/login');
        $gorb = User::getVinfo($_GET['gorb']);
        if($gorb != 0){
            if($gorb['shak'] == $_GET['token']){
                $u->verify();
                setcookie('ginvest', $u->email, time() + 360000, '/');
                setcookie('ginvestid', $u->uid, time() + 360000, '/');
                setcookie('ginvestreg', 'yes', time() + 300, '/');
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/register/continue/');
            }
        }
    }$error = 'invalid verification details';
}elseif (isset($_COOKIE['ginvest'])) {
	$user = new User($_COOKIE['ginvest']);
	if($user->isvered==0){
		$ver = $user->getVer();
		$email = $_COOKIE['ginvest'];
		$name = $user->fname;
		$url = 'https://'. $_SERVER['HTTP_HOST'] .'/register/verify/?token=' . $ver['shak'] .'&gorb=304' . $user->uid.'&verify='.sha1($ver[shak]);
		setcookie('ginvest', '', time() - 1000000, '/');
            	setcookie('ginvestid', '', time() - 1000000, '/');
            	setcookie('ginvestreg', '', time() - 1000, '/');
                echo '<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta https-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Harry">

        <title>Verify</title>
        <link href="https://'.$_SERVER['HTTP_HOST'].'/.includes/vendor/img/gi.png" rel="icon">

        <!-- Bootstrap Core CSS -->
        <link href="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/gi/css/gi.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <style>
            #mainNav{
                position: fixed;
            }
            #body{
                margin-top: 50px;
            }
        </style>
        <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
	<script type="text/javascript">
   	    (function(){
      		emailjs.init("user_BMpYng5dMsq3Rn16FDSCo");
   	    })();
        emailjs.send("colaboe","colaboe",{email: "'. $email .'", firstname: "'. $name .'", action_url: "'. $url .'"});
        </script>
    </head>

    <body class="well panel panel-default panel-pink">
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button id="menu-close" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="https://'. $_SERVER['HTTP_HOST'] .'">COLABOE</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="https://'. $_SERVER['HTTP_HOST'] .'/#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="https://'. $_SERVER['HTTP_HOST'] .'/login">Login</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <div id="body" class="container">
            <div class="row">
                <div class="col-lg-12 well panel panel-default panel-pink">
                    <div class="panel panel-default panel-warning">
                        <div class="panel-body panel-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <div align="center" class="alert alert-danger panel-pink panel-heading form-group col-lg-12">
                                        A verification mail has been sent to '. $email.' please confirm before 12 hours or register again.<br>
                                        If you dont see an email from \'The Colaboe Team\' in ten minutes please check your spam box
                                    </div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            </div>
        </div>

        <!-- jQuery -->
        <script src="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/gi/js/gi.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="https://'. $_SERVER['HTTP_HOST'] .'/.includes/vendor/js/sb-admin-2.js"></script>

    </body>

</html>
';
    }
}else{ header('Location: https://' . $_SERVER['HTTP_HOST'] . '/');}
?>


