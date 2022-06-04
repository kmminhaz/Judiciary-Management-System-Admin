<?php include('./assets/navBar.php') ?>

<?php 
$sql = "SELECT * FROM `advocate_access_request`";
$res = mysqli_query($conn, $sql);

$sqladmin = "SELECT * FROM `admin_members`";
$resadmin = mysqli_query($conn, $sqladmin);

$sqlAllAdvocate = "SELECT * FROM `advocate_profile`";
$resAdvocate = mysqli_query($conn, $sqlAllAdvocate);
$totalAdvocates = mysqli_num_rows($resAdvocate);

$sqlAllJudge = "SELECT * FROM `judge_profile`";
$resJudge = mysqli_query($conn, $sqlAllJudge);
$totalJudges = mysqli_num_rows($resJudge);

$totalUsers = $totalAdvocates + $totalJudges;
?>

            <!-- CONTENT -->
            <!-- ========================================================= -->
            <div class="content">
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
                <?php 
                if (isset($_SESSION['request'])) {
                    echo $_SESSION['request'];
                    unset($_SESSION['request']);
                }
                ?>
                <?php 
                if (isset($_SESSION['help'])) {
                    echo $_SESSION['help'];
                    unset($_SESSION['help']);
                }
                ?>
                <?php 
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                <?php 
                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                ?>
                <?php 
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                ?>
                <?php 
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-9">
                        <div class="row">
                            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                            <!--WIDGETBOX-->
                            <div class="col-sm-12 col-md-4">
                                <div class="panel widgetbox wbox-2 bg-scale-0">
                                    <a href="#">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <span class="icon fa fa-users color-darker-1"></span>
                                                    <!-- <i class="fa-solid fa-circle-user"></i>
                                                    <i class="fa-solid fa-users"></i> -->
                                                </div>
                                                <div class="col-xs-8">
                                                    <h4 class="subtitle color-darker-1">Total Users</h4>
                                                    <h1 class="title color-primary"> <?php echo $totalUsers ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                                    <a href="#">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <span class="icon fa fa-gavel color-darker-2"></span>
                                                    <!-- <i class="fa-solid fa-gavel"></i> -->
                                                </div>
                                                <div class="col-xs-8">
                                                    <h4 class="subtitle color-darker-2">Judges</h4>
                                                    <h1 class="title color-w"> <?php echo $totalJudges?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="panel widgetbox wbox-2 bg-darker-2 color-light">
                                    <a href="#">
                                        <div class="panel-content">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <span class="icon fa fa-user color-lighter-1"></span>
                                                    <!-- <i class="fa-solid fa-user-group"></i> -->
                                                </div>
                                                <div class="col-xs-8">
                                                    <h4 class="subtitle color-lighter-1">Advocates</h4>
                                                    <h1 class="title color-light"> <?php echo $totalAdvocates?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                            <!--AREA CHART-->
                            <!-- <div class="col-sm-12 col-md-8">
                                <div class="panel">
                                    <div class="panel-content">
                                        <h5><b>First semester</b> Sells</h5>
                                        <p class="section-text">Lorem ipsum <span class="highlight">dolor sit amet</span> consectetur adipisicing elit. Assumenda fugit inventore ipsam nam, qui voluptatibus</p>
                                        <canvas id="area-chart" width="400" height="160"></canvas>
                                    </div>
                                </div>
                            </div> -->
                            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                            <!--TABS WITH TABLET-->
                            <div class="col-sm-12 col-md-8">
                                <div class="tabs mt-none">
                                    <!-- Tabs Header -->
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#home" data-toggle="tab">Admins</a></li>
                                        <li><a href="#requests" data-toggle="tab">Advocate Login Requests</a></li>
                                    </ul>
                                    <!-- Tabs Content -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Position</th>
                                                            <th>Phone</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($admins = mysqli_fetch_array($resadmin)){
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $admins['adminName']; ?></td>
                                                                <td><?php echo $admins['adminEmail']; ?></td>
                                                                <td><?php echo $admins['adminPhone']; ?></td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="requests">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Phone</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($requests = mysqli_fetch_array($res)){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $requests['name'] ?></td>
                                                            <td><?php echo $requests['phoneNo'] ?></td>
                                                            <td>
                                                                <a class="m-1 btn btn-primary btn" href="<?php echo SITEURL ?>request_view.php?id=<?php echo $requests['id']; ?>" role="button">
                                                                    Check Details
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <link rel="stylesheet" href="./stylesheets/css/myStyle.css">
                            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                            <!--TO DO LIST-->
                            <?php
                                $sqlHelp = "SELECT * FROM `help_desk` WHERE `status` = 'Unchecked'";
                                $resHelp = mysqli_query($conn, $sqlHelp);
                            ?>
                            <div class="col-sm-12 col-md-4">
                                <div class="panel b-primary bt-md">
                                    <div class="panel-content p-none">
                                        <div class="widget-list list-to-do">
                                            <h4 class="list-title">Help Desk Messages</h4>
                                            <ul>
                                                <?php
                                                    while($helps = mysqli_fetch_array($resHelp)){
                                                        ?>
                                                            <li>
                                                                <div>
                                                                    <label class="check" for="check-h1"><?php echo $helps['query'] ?></label>
                                                                    <div class="my-move-end m-xs">
                                                                        <a class="m-1 btn btn-primary btn" href="<?php echo SITEURL ?>help_reply.php?id=<?php echo $helps['id']; ?>" role="button">
                                                                            Reply
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                            
                            <?php

                            $sqlgallery = "SELECT * FROM `imageslider`";
                            $resgallery = mysqli_query($conn, $sqlgallery);

                            ?>
                            
                            <!--GALLERY-->
                            <div class="col-sm-12 col-md-8">
                                <div class=" gallery-wrap">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="section-subtitle"><b>GALLERY</b></h4>
                                            <div class="panel">
                                                <div class="panel-content">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Image ID</th>
                                                                <th>Image Name</th>
                                                                <th>Options</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                        <?php
                                                        while($gallery = mysqli_fetch_array($resgallery)){
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $gallery['id'] ?></td>
                                                                <td><?php echo $gallery['imageName'] ?></td>
                                                                <td class="">
                                                                    <a class="m-1 btn btn-primary btn" href="<?php echo SITEURL ?>update_ImageSlider.php?id=<?php echo $gallery['id']; ?>" role="button">
                                                                        Update
                                                                    </a>
                                                                    <a onclick="return confirm('Are you sure, You want to delete this image !!');" class="m-1 btn btn-danger btn" href="<?php echo SITEURL ?>dashboard.php?btn=delete&id=<?php echo $gallery['id']; ?>" role="button">
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // if(isset($_POST['updateImage'])){
                    //     $imageName = "";
                    // }
                    ?>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--TIMELINE Right-->
                    <div class="col-sm-12 col-lg-3">
                        <div class="timeline">
                            <div class="timeline-box">
                                <div class="timeline-icon bg-primary">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4 class="tl-title">Website Status</h4> Working properly
                                </div>
                                <div class="timeline-footer">
                                    <span>Today. 14:25</span>
                                </div>
                            </div>
                            <div class="timeline-box">
                                <div class="timeline-icon bg-primary">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4 class="tl-title">Database Status </h4> Connected & Server is Up
                                </div>
                                <div class="timeline-footer">
                                    <span>Today. 10:55</span>
                                </div>
                            </div>
                            <div class="timeline-box">
                                <div class="timeline-icon bg-primary">
                                    <i class="fa fa-file"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4 class="tl-title">Portal Status</h4> Working Properly, No issues found yet.
                                </div>
                                <div class="timeline-footer">
                                    <span>Today. 9:20</span>
                                </div>
                            </div>
                            <div class="timeline-box">
                                <div class="timeline-icon bg-primary">
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
            <!-- RIGHT SIDEBAR -->
            <!-- ========================================================= -->
            <div class="right-sidebar">
                <div class="right-sidebar-toggle" data-toggle-class="right-sidebar-opened" data-target="html">
                    <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
                </div>
                <div id="right-nav" class="nano">
                    <div class="nano-content">
                        <div class="template-settings">
                            <h4 class="text-center">Template Settings</h4>
                            <ul class="toggle-settings pv-xlg">
                                <li>
                                    <h6 class="text">Header fixed</h6>
                                    <label class="switch">
                                        <input id="header-fixed" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Content header fixed</h6>
                                    <label class="switch">
                                        <input id="content-header-fixed" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar collapsed</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-collapsed" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar Top</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-top" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar fixed</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-fixed" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar over</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-over" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar nav left-lines</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-left-lines" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                            </ul>
                            <h4 class="text-center">Template Colors</h4>

                            <!-- <div class="row toggle-colors">
                                <div class="col-xs-6">
                                    <a href="index.html" class="on-click"> <img alt="Helsinki-green" src="images/theme/dark_green.png" /></a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="http://myiideveloper.com/helsinki/last-version/helsinki_green-light/src/index.html" class="on-click"> <img alt="Helsinki-green" src="images/theme/white_green.png" /></a>
                                </div>
                            </div>
                            <div class="row toggle-colors">
                                <div class="col-xs-6">
                                    <a href="http://myiideveloper.com/helsinki/last-version/helsinki_dark/src/index.html" class="on-click"> <img alt="Helsinki-green" src="images/theme/dark_white.png" /></a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="http://myiideveloper.com/helsinki/last-version/helsinki_light/src/index.html" class="on-click"> <img alt="Helsinki-green" src="images/theme/white_dark.png" /></a>
                                </div>
                            </div>
                            <div class="row toggle-colors">
                                <div class="col-xs-6">
                                    <a href="http://myiideveloper.com/helsinki/last-version/helsinki_blue-dark/src/index.html" class="on-click"> <img alt="Helsinki-green" src="images/theme/dark_blue.png" /></a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="http://myiideveloper.com/helsinki/last-version/helsinki_blue-light/src/index.html" class="on-click"> <img alt="Helsinki-green" src="images/theme/white_blue.png" /></a>
                                </div>
                            </div>
                            <div class="row mt-lg">
                                <div class="col-sm-12 text-center">
                                    <a  target="_blank" href="http://myiideveloper.com/helsinki/last-version/documentation/index.html"><h5> <i class="fa fa-book mr-sm"></i>Online Documentation</h5></a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>

<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:05:07 GMT -->
</html>

<?php
if(isset($_GET['btn']) && $_GET['btn']=='delete'){
  $id = $_GET['id'];
  $deleteQuery = "DELETE FROM imageslider WHERE id = '$id'";
  
  $resDelete = mysqli_query($conn, $deleteQuery);
  if($resDelete){
    $_SESSION['delete'] = "<div class='text-success text-center py-3'><strong?> The image is Deleted Successfully </strong></div>";
    ?>
     <script type="text/javascript">
        window.location.href = '<?php echo SITEURL; ?>dashboard.php';
    </script>
  <?php
  }else{
    $_SESSION['delete'] = "<div class='text-danger text-center py-3'><strong?> The image is Deletation Failed </strong></div>";
    ?>
    <script type="text/javascript">
        window.location.href = '<?php echo SITEURL; ?>dashboard.php';
    </script>
  <?php
  }
}
?>
<?php include('./assets/footer.php') ?>