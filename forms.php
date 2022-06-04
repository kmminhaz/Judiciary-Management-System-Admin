<?php include('./assets/navBar.php') ?>

<?php

$sqlgeneralUsers = "SELECT * FROM `generalusersforms`";
$resgeneralUsers = mysqli_query($conn, $sqlgeneralUsers);

$sqladministrative = "SELECT * FROM `administrativ_forms`";
$resadministrativeForms = mysqli_query($conn, $sqladministrative);

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
                        <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Forms</a></li>
                    </ul>
                </div>
            </div>
            <?php 
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            ?>
            <?php 
            if (isset($_SESSION['addForm'])) {
                echo $_SESSION['addForm'];
                unset($_SESSION['addForm']);
            }
            ?>
            <?php 
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <div class="row animated fadeInRight">
                <!--BASIC-->
                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>General Users</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <div class="">
                                    <a class="m-1 btn btn-info" href="<?php echo SITEURL ?>addFormItem.php?target=general" role="button">
                                        Add
                                    </a>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Form Name</th>
                                        <th>Form Type</th>
                                        <th>File</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($generalUsers = mysqli_fetch_array($resgeneralUsers)){
                                        ?>
                                        <tr>
                                            <td><?php echo $generalUsers['id'] ?></td>
                                            <td><?php echo $generalUsers['file_name'] ?></td>
                                            <td><?php echo $generalUsers['file_type'] ?></td>
                                            <td><?php echo $generalUsers['file'] ?></td>
                                            <td>
                                                <a class="m-1 btn btn-primary btn" href="<?php echo SITEURL ?>formUpdate.php?target=general&id=<?php echo $generalUsers['id']; ?>" role="button">
                                                    Update
                                                </a>
                                                <a onclick="return confirm('Are you sure, You want to delete this item');" class="m-1 btn btn-danger btn" href="<?php echo SITEURL ?>forms.php?btn=gdelete&id=<?php echo $generalUsers['id']; ?>" role="button">
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
                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Administrative Forms</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <div>
                                    <a class="m-1 btn btn-info btn" href="<?php echo SITEURL ?>addFormItem.php?target=administrative" role="button">
                                        Add
                                    </a>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Form Name</th>
                                        <th>File</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($administrativeForms = mysqli_fetch_array($resadministrativeForms)){
                                        ?>
                                        <tr>
                                            <td><?php echo $administrativeForms['id'] ?></td>
                                            <td><?php echo $administrativeForms['name'] ?></td>
                                            <td><?php echo $administrativeForms['pdf'] ?></td>
                                            <td>
                                                <a class="m-1 btn btn-primary btn" href="<?php echo SITEURL ?>formUpdate.php?target=administrative&id=<?php echo $administrativeForms['id']; ?>" role="button">
                                                    Update
                                                </a>
                                                <a onclick="return confirm('Are you sure, You want to delete this item');" class="m-1 btn btn-danger btn" href="<?php echo SITEURL ?>forms.php?btn=adelete&id=<?php echo $administrativeForms['id']; ?>" role="button">
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

                            <div class="row toggle-colors">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!--scroll to top-->
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="javascripts/template-script.min.js"></script>
<script src="javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>

</html>

<?php
if(isset($_GET['btn'])){
  $id = $_GET['id'];

  if($_GET['btn']=='gdelete'){
      $deleteQuery = "DELETE FROM generalusersforms WHERE id = '$id'";
  }elseif($_GET['btn']=='adelete'){
      $deleteQuery = "DELETE FROM administrativ_forms WHERE id = '$id'";
  }

    // echo "<pre>";
    // print_r($rows);
    // echo $deleteQuery;
    $resDelete = mysqli_query($conn, $deleteQuery);

  if($resDelete){
    $_SESSION['delete'] = "<div class='text-success text-center py-3'><strong?> The item is Deleted Successfully </strong></div>";
    ?>
     <script type="text/javascript">
        window.location.href = '<?php echo SITEURL; ?>forms.php';
    </script>
  <?php
  }else{
    $_SESSION['delete'] = "<div class='text-danger text-center py-3'><strong?> The item Deletation Failed </strong></div>";
    ?>
    <script type="text/javascript">
        window.location.href = '<?php echo SITEURL; ?>forms.php';
    </script>
  <?php
  }
}
?>