<?php {
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvestid'] == User::getID($_COOKIE['ginvest'])) {
            $user = new User(User::getEmail($_COOKIE['ginvestid']));
            if ($user->admin < 1)
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
            $admin = new Admin($user);
            $list = $admin->getUsers();
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
        <meta name="author" content="">

        <title>Colaboe</title>
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/img/gi.png" rel="icon">
        <!-- Bootstrap Core CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/css/gi.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
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
        <?php include '../actions/loginnav.ini.php'; ?>
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="row"><br></div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-purple">
                            <div class="panel-heading" align="center">
                                LIST OF REGISTERED USERS
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="panel-body panel-pink table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Phone No</th>
                                            <th>Cycles</th>
                                            <th>Referrals</th>
                                            <th>Blocked</th>
                                            <th>Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($index = 0; $index < count($list); $index++) {
                                            $prime = $index % 2 == 0 ? 'even' : 'odd';
                                            $u = $list[$index];
                                            if ($user->uid >= $u->uid)
                                                continue;
                                            $name = $u->fname . ' ' . $u->lname;
                                            $blocked = $u->block == 0 ? 'No' : 'Yes';
                                            $adm = $u->admin > 0 ? 'check"></i>&nbspYes' : 'times"></i>&nbspNo';
                                            echo ''
                                            . '<tr class="' . $prime . ' gradeX">
                                            <td><a class="btn  btn-block" href="https://' . $_SERVER['HTTP_HOST'] . '/account/?uid=' . $u->uid . '">' . $name . '</a></td>
                                            <td align="center">' . $u->phone . '</td>
                                            <td align="center">' . $u->cycles . '</td>
                                            <td align="center">' . $u->refs . '</td>
                                            <td align="center"><a class="btn btn-block" href="https://' . $_SERVER['HTTP_HOST'] . '/dashboard/admin/block.php?uid=' . $u->uid . '">' . $blocked . '</a></td>
                                            <td align="center"><a class="btn btn-block" href="https://' . $_SERVER['HTTP_HOST'] . '/dashboard/admin/admin.php?uid=' . $u->uid . '"><i class="fa fa-fw fa-' . $adm . '</a></td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-5">
                        <div class="panel panel-pink">
                            <div class="panel-heading" align="center">
                                Review Your Status
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="panel panel-dark">
                                        <div class="panel-heading" align="center">
                                            Blocked
                                        </div>
                                        <div class="panel-footer panel-dark" align="center">
                                            <?php echo $user->block == 0 ? 'NO' : 'YES' ?>
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
                                                <span class="pull-left">Make Profit</span>
                                                <span class="pull-right"><i class="fa fa-fw fa-briefcase"></i></span>
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
                                                <span class="pull-left">Make Profit</span>
                                                <span class="pull-right"><i class="fa fa-fw fa-briefcase"></i></span>
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
                                                <span class="pull-left">Make Profit</span>
                                                <span class="pull-right"><i class="fa fa-fw fa-briefcase"></i></span>
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
                                                <span class="pull-left">Make Profit</span>
                                                <span class="pull-right"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
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

        <!-- DataTables JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/datatables-responsive/dataTables.responsive.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>

    </body>


</html>
