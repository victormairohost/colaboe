<?php 
require_once 'actions/User.php';
 if (empty($_SERVER['HTTPS']) && ('on' != $_SERVER['HTTPS'])) {
		header('Location: https://' . $_SERVER['HTTP_HOST'] . '/');
	}{
    if (isset($_COOKIE['ginvest']) && isset($_COOKIE['ginvestid'])) {
        if ($_COOKIE['ginvest'] == User::getEmail($_COOKIE['ginvestid'])) {
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/dashboard/');
        }
    }
}
?>
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
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/css/gi.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Plugin CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/css/creative.min.css" rel="stylesheet">


    </head>

    <body id="page-top">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="border-bottom:0px;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button id="menu-close" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">Colaboe</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" onclick="$('#menu-close').click()" href="#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" onclick="$('#menu-close').click()" href="#contact">Contact</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/register">Register</a>
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

        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 class="huge" id="homeHeading">COLABOE</h1>
                    <hr>
                    <h2>Welcome to Colaboe.<br> We've moved from being the next best thing<br> to #<b>1</b> with simple efficiency as our major goal</h2>
                    <hr>
                    <p>
                        We are a peer to peer collaboration with a number of pools.<br>
                        Unlike other downright orthodox investments, our platform starts paying before <b>24</b> hours<br>
                        We leave our clients satisfied.
                    </p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">Learn More</a>
                </div>
            </div>
        </header>

        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <p class="text-center col-lg-10 col-lg-offset-1">
                            We are very passionate and therefore strict,<br> besides, 
                            <br>we don't want you getting lost on your way to wealth.<br>
                            That is why we outlined these easy to follow steps to take on your journey through Colaboe.<br>
                            Don't forget our main goal is <br><b>simple effficiency</b>
                        </p>
                        <div class="row">
                            <div class="col-lg-12" align="center">
                                <h2 class="section-heading">Your Steps to a Wealthy Life</h2>
                                <hr class="light">
                                <div>
                                    <p class="text-faded"><h3>Step 1 </h3>
                                    <p>Register with us right here on Colaboe <br>
                                </div>
                                <div>
                                    <h3>Step 2 </h3>
                                    <h4>Confirm Your identity through the email we'll provide</h4>
                                </div>
                                <div>
                                    <h3>Step 3 </h3>
                                    <h4>Complete Your account details and setup your profile</h4>
                                </div>
                                <div>
                                    <h3>Step 4 </h3>
                                    <h4>Make Investments You can afford</h4>
                                    <div class="col-lg-12">
                                        <div class="col-lg-2 col-lg-offset-2">10 to give 20</div>
                                        <div class="col-lg-2">20 to give 40</div>
                                        <div class="col-lg-2">50 to give 100</div>
                                        <div class="col-lg-2">100 to give 200</div>
                                    </div>
                                </div>
                                <div>
                                    <h3>Step 5 </h3>
                                    <h4>Check the investments you've made and confirm your earnings, with a hundred percent interest </h4></div>
                                <div>
                                    <h3>Step 6 </h3>
                                    <h4>If you like it share it with your friends and family, we have a rather generous referral program</p></h4>
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <h2 class="section-heading">Collaboration Requirements</h2>
                                <hr class="light">
                                <div class="col-lg-4">
                                    <b>Steady internet connection</b><br>
                                </div>
                                <div class="col-lg-4">
                                    <b>Access to speedy banking prefferably online banking</b><br>
                                </div>
                                <div class="col-lg-4">
                                    <b>An operational email address</b>
                                </div>
                            </div>
                        </div><br>
                        <div class="col-lg-12" align="center">
                            <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/register" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Let's Get In Touch!</h2>
                        <hr class="primary">
                        <p></p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                        <p><a href="mailto:colaboe.com@gmail.com">colaboe.com@gmail.com</a></p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <i class="fa fa-twitter fa-3x sr-contact"></i>
                        <p><a target="blank" href="https://www.twitter.com/ColaboeCom">@colaboecom</a></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/gi/js/gi.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="https://<?php echo $_SERVER['HTTP_HOST'] ?>/.includes/vendor/js/creative.min.js"></script>

    </body>

</html>
