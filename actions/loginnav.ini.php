<!-- Navigation -->
<div class="navbar-default sidebar" role="navigation">
    <button id="menu-close" align="right" type="button" class="navbar-toggle btn btn-info btn-lg" style="background-color: #eef; border-color:#ccf;" data-toggle="collapse" data-target=".sidebar-nav" aria-expanded="false">
        <span class="sr-only btn">Toggle navigation</span><i class="fa fa-fw fa-bars"></i>
    </button>
    <div class="sidebar-nav navbar-collapse navbar collapse collapsing collapsed" >
        <ul class="nav" id="side-menu">
            <?php 
                echo ($user->admin>0)?'<li>
                <a href="https://' . $_SERVER['HTTP_HOST'] . '/dashboard/"><i class="fa fa-list-alt fa-fw"></i> Admin Panel</a>
            </li>':'<li>
                <a href="https://' . $_SERVER['HTTP_HOST'] . '/dashboard/"><i class="fa fa-bar-chart fa-fw"></i> Activity</a>
            </li>';
            ?>
            <li>
                <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/person"><i class="fa fa-user fa-fw"></i> Personal Details</a>
            </li>
            <li>
                <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/dashboard/accdetails/"><i class="fa fa-bank fa-fw"></i> Account Details</a>
            </li>
            <li>
                <a href="https://<?php echo $_SERVER['HTTP_HOST'] ?>/actions/logout/"><i class="fa fa-sign-out fa-rotate-180 fa-fw"></i>Logout</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->