<?php
 if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
		header('Location: httpss://' . $_SERVER['HTTP_HOST'] . '/register/');
	}
require_once '../actions/User.php';
{
    $error = '';
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if (isset($_REQUEST['plan'])) {
                if (isset($_FILES['file']) && isset($_POST['pass'])) {
                    if (md5($_POST['pass'] == $user->pass)) {
                        $imageFileType = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                        $target_file = 'uploads/' . time() . '.' . $imageFileType;
                        $uploadOk = 1;
                        $check = getimagesize($_FILES["file"]["tmp_name"]);
                        if ($check !== false) {
                            //$error = "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            $error = "File is not an image.";
                            $uploadOk = 0;
                        }
                        if ($_FILES["file"]["size"] > 10000000) {
                            $error = strlen($error) != 0 ? $error : "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != ".AAE" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
                            $error = strlen($error) != 0 ? $error : "Sorry, only JPG, JPEG, AAE, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 0) {
                            $error = strlen($error) != 0 ? $error : "Sorry, your file was not uploaded.";
                        } else {
                            if (move_uploaded_file($_FILES["file"]["tmp_name"], ($target_file))) {
                                $user->upload($_REQUEST['plan'], ($target_file));
                                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
                            } else {
                                echo $_FILES["file"]["tmp_name"].'   '.$target_file;
                                $error = strlen($error) != 0 ? $error : "Sorry, tt there was an error uploading your file.";
                            }
                        }
                    }
                }
            } else {
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
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

        <title>Verify Payment</title>
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
                    <div class="login-panel panel panel-pink">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center"> Picture Of 'Receipt Or Bank Alert' </h3>
                        </div>
                        <div class="panel-body panel-pink col-lg-12">
                            <form role="form" method="post" action="https://<?php echo $_SERVER['HTTP_HOST'].'/upload/?plan='.$_REQUEST['plan'] ?>" enctype="multipart/form-data">
                                <input class="input-group btn btn-info alert-info" style="border-color: purple" id="file" name="file" size="50" required type="file">
                                <div class="form-group">
                                </div><?php echo $error ?>
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <input class="form-control alert-danger" placeholder="Your Password" name="pass" required minlength="7" type="password">
                                </div>
                                <div class ="form-group">
                                    <input type="submit" value="Upload" style="background-color: #2299ff;" class="btn btn-warning btn-block"/>
                                </div>
                            </form>
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