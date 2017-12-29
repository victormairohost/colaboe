<?php
 if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/register/');
	}
require_once '../actions/User.php'; {
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User($_COOKIE['ginvest']);
            if($user->admin>0){
                include '../actions/Admin.php';
                include 'admin/index.php';
                die();
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
            <?php include '../actions/loginnav.ini.php'; ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="row"><br></div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="panel panel-pink">
                                                <div class="panel-heading" align="center">
                                                    Review Your Status
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
<!--                                                    <div class="col-lg-6">
                                                        <div class="panel panel-dark">
                                                            <div class="panel-heading" align="center">
                                                                Total Invested
                                                            </div>
                                                            <div class="panel-footer panel-dark" align="center">
                                                                NGN
                                                                <?php echo $user->totali ?>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                    <div class="col-lg-6">
                                                        <div class="panel panel-dark">
                                                            <div class="panel-heading" align="center">
                                                                Blocked
                                                            </div>
                                                            <div class="panel-footer panel-dark" align="center">
                                                                <?php echo $user->block==0?'NO':'YES' ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="panel panel-dark">
                                                            <div class="panel-heading" align="center">
                                                                Cycles Completed
                                                            </div>
                                                            <div class="panel-footer panel-dark" align="center">
                                                                <?php echo $user->cycles ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="panel panel-dark">
                                                            <div class="panel-heading" align="center">
                                                                Referrals
                                                            </div>
                                                            <div class="panel-footer panel-dark" align="center">
                                                                <?php echo $user->refs ?>                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="panel panel-warning">
                                                <div class="panel-heading" align="center">
                                                    <b>Available pools</b>
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading" style="background-color: #ece883">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <i class="fa fa-fw fa-money"></i>
                                                                    </div>
                                                                    <div class="col-sm-10 text-right">
                                                                        <div class="huge">10000</div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/invest/?plan=10">
                                                                <div class="panel-footer alert-success btn-success">
                                                                    <span class="pull-left"><?php echo !(($user->getPayee(10) instanceof User)||$user->istobepayed(10))?'Make Investment':'Investment Made'; ?></span>
                                                                    <span class="pull-right"><i class="fa <?php echo !(($user->getPayee(10) instanceof User)||$user->istobepayed(10))?'fa-arrow-circle-right':'fa-check-circle-o'; ?>"></i></span>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading" style="background-color: #dce873">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <i class="fa fa-fw fa-money"></i>
                                                                    </div>
                                                                    <div class="col-sm-10 text-right">
                                                                        <div class="huge">20000</div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/invest/?plan=20">
                                                                <div class="panel-footer alert-success btn-success">
                                                                    <span class="pull-left"><?php echo !(($user->getPayee(20) instanceof User)||$user->istobepayed(20))?'Make Investment':'Investment Made'; ?></span>
                                                                    <span class="pull-right"><i class="fa <?php echo !(($user->getPayee(20) instanceof User)||$user->istobepayed(20))?'fa-arrow-circle-right':'fa-check-circle-o'; ?>"></i></span>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 disabled">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading" style="background-color: #bce863">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <i class="fa fa-fw fa-money"></i>
                                                                    </div>
                                                                    <div class="col-sm-10 text-right">
                                                                        <div class="huge">50000</div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/invest/?plan=50">
                                                                <div class="panel-footer alert-success btn-success">
                                                                    <span class="pull-left"><?php echo !(($user->getPayee(50) instanceof User)||$user->istobepayed(50))?'Make Investment':'Investment Made'; ?></span>
                                                                    <span class="pull-right"><i class="fa <?php echo !(($user->getPayee(50) instanceof User)||$user->istobepayed(50))?'fa-arrow-circle-right':'fa-check-circle-o'; ?>"></i></span>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading" style="background-color: #ace853">
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <i class="fa fa-fw fa-money"></i>
                                                                    </div>
                                                                    <div class="col-sm-9 text-right">
                                                                        <div class="huge">100000</div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/invest/?plan=100">
                                                                <div class="panel-footer alert-success btn-success">
                                                                    <span class="pull-left"><?php echo !(($user->getPayee(100) instanceof User)||$user->istobepayed(100))?'Make Investment':'Investment Made'; ?></span>
                                                                    <span class="pull-right"><i class="fa <?php echo !(($user->getPayee(100) instanceof User)||$user->istobepayed(100))?'fa-arrow-circle-right':'fa-check-circle-o'; ?>"></i></span>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                                        <?php if(!$user->iscomplete){ echo ''
                                        .'<div class="col-lg-12">
                                            <div class="panel-body">
                                                <div class="panel panel-dark">
                                                    <div class="panel-heading" align="center">
                                                    <b>Please Note : </b>until you complete your profile you can\'t make any investment
                                                    </div>
                                                </div>
                                            </div>
                                        </div>'; }?>
                                                    
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
