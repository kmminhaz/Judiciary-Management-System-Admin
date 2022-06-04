<?php include('./assets/header.php') ?>

<body>
    <div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        <div class="page-header">
            <!-- LEFTSIDE header -->
            <div class="leftside-header">
                <div class="logo">
                    <a href="index.php" class="on-click">
                        <img alt="logo" src="images/AdminLogo.png" height="45px" />
                    </a>
                </div>
                <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- RIGHTSIDE header -->
            <div class="rightside-header">
                <div class="header-middle"></div>
                <!--USER HEADERBOX -->
                <div class="header-section" id="user-headerbox">
                    <div class="user-header-wrap">
                        <!-- <div class="user-photo">
                            <img alt="profile photo" src="images/avatar/avatar_user.jpg" />
                        </div> -->
                        <div class="user-info">
                            <span class="user-name">Super Admin</span>
                        </div>
                        <!-- <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                        <i class="fa fa-minus icon-close" aria-hidden="true"></i> -->
                    </div>
                    <div class="user-options dropdown-box">
                        <div class="drop-content basic">
                            <ul>
                                <?php
                                    if(isset($_SESSION['Super-User'])){
                                        ?>
                                            <li> <a href="pages_admin-profile.php"><i class="fa fa-user" aria-hidden="true"></i> Add Admin </a></li>
                                        <?php
                                    }else{
                                        ?>
                                            <li> <a href="super-admin-login.php"><i class="fa fa-user" aria-hidden="true"></i> Login </a></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-separator"></div>
                <!--Log out -->
                <div class="header-section">
                    <a href="logout.php" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
                <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
            <div class="left-sidebar">
                <!-- left sidebar HEADER -->
                <div class="left-sidebar-header">
                    <div class="left-sidebar-title">Navigation</div>
                    <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                        <span></span>
                    </div>
                </div>
                <!-- NAVIGATION -->
                <!-- ========================================================= -->
                <div id="left-nav" class="nano">
                    <div class="nano-content">
                        <nav>
                            <ul class="nav nav-left-lines" id="main-nav">
                                <!--HOME-->
                                <li class="active-item"><a href="http://localhost:3000/"><i class="fa fa-home" aria-hidden="true"></i><span>Homepage</span></a></li>
                                <li class="active-item"><a href="dashboard.php"><i class="fa fa-cubes" aria-hidden="true"></i><span>Dashboard</span></a></li>
                                
                                <!--FORMS-->
                                <li><a href="forms.php"><i class="fa fa-columns" aria-hidden="true"></i><span>Forms</span></a></li>
                                
                                <!--TABLES-->
                                <li class="has-child-item close-item">
                                    <a><i class="fa fa-table" aria-hidden="true"></i><span>Data Table</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><a href="advocate_data_table.php">Advocates</a></li>
                                        <li><a href="judge_data_table.php">Judges</a></li>
                                    </ul>
                                </li>

                                <!--PAGES-->
                                <li class="has-child-item close-item">
                                    <a><i class="fa fa-files-o" aria-hidden="true"></i><span>Contents</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><a href="edit_homepage.php">Home page</a></li>
                                        <li><a href="laws.php">Laws</a></li>
                                        <li><a href="notice_board.php">Notice Board</a></li>
                                        <li><a href="news_reports.php">News & Reports</a></li>
                                        <li><a href="necessery_links.php">Necessery Links</a></li>
                                    </ul>
                                </li>

                                <!--HELPERS-->
                                <li class="has-child-item close-item">
                                    <a href="helps.php"><i class="fa fa-magic" aria-hidden="true"></i><span>Helps</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>