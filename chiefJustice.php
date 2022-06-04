<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Edite</title>
    <!-- Bootstrap CSS Link -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="help_view.css" />

    <!-- Font Awsome Icon -->
    <script
      src="https://kit.fontawesome.com/f87a50e4b9.js"
      crossorigin="anonymous"
    ></script>
</head>
<body class="darkShade">
<section class="bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center h-100">
        <div class="mt-5 pt-5 col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h4 class="text-uppercase text-center mb-5 fw-bold">Manage Chief Justice Info</h4>

            <?php
              
                $sql = "SELECT * FROM `chief_justice` WHERE `id` = '1'";
                $res = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_array($res);

                $rowCount = mysqli_num_rows($res);
                // echo $rowCount;
              
                $imgName = $rows['image'];
            ?>

              <form method="POST" action="" enctype="multipart/form-data">  
                <label class="form-label" for="form3Example1cg">Current Image</label>
                <div class="form-outline mb-2 d-flex flex-column align-items-center">
                    <img
                        src="../judiciary-system-management/public/images/<?php echo $imgName ?>"
                        alt='...'
                        class="my-2"
                        height="200px"
                        width="400px"
                    />
                    <div>
                        <label class="form-label fw-bold" for="form3Example1cg">Upload New Image</label>
                        <input type="file" id="img" class="form-control form-control-lg" name="img" value="<?php echo $imgName ?>"/>
                    </div>
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example1cg">Name</label>
                    <input type="text" class="form-control form-control-lg" name="name" value="<?php echo $rows['name']; ?>"/>
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example1cg">Appointed By</label>
                    <input type="text" class="form-control form-control-lg" name="appointedBy" value="<?php echo $rows['appointedBy']; ?>"/>
                </div>
                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example1cg">Appointed In</label>
                    <input type="text" class="form-control form-control-lg" name="appointedIn" value="<?php echo $rows['appointedIn']; ?>"/>
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3cg">Profile Link</label>  
                    <textarea type="text" class="form-control form-control-lg" name="profile"><?php echo $rows['profile']; ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <?php
                        if($rowCount != 0){
                            ?>
                                <button type="submit" name="update" class="btn btn-success btn-block btn-lg text-white m-2 mt-3">Update</button>
                                <button type="submit" name="cancel" class="btn btn-dark btn-block btn-lg text-white m-2 mt-3">Cancle</button>        
                            <?php
                        }else{
                            ?>
                                <button type="submit" name="add" class="btn btn-success btn-block btn-lg text-white m-2 mt-3">Add</button>
                            <?php
                        }
                    ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Boostrap JS Link -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
</body>
</html>
<?php include('./assets/footer.php') ?>


<?php
if(isset($_POST['update'])){
    $img = $_FILES['img']['name'];
    $name = $_POST['name'];
    $appointedBy = $_POST['appointedBy'];
    $appointedIn = $_POST['appointedIn'];
    $profile = $_POST['profile'];

    if($img == ''){
      $sqlupdate = "UPDATE `chief_justice`
        SET `name` = '$name', `appointedBy` = '$appointedBy', `appointedIn` = '$appointedIn', `profile` = '$profile'
        WHERE `id` = '1'";
    }else{
      if($imgName != ''){
        $path = "../judiciary-system-management/public/images/$imgName";
        if(!unlink($path)){
          $_SESSION['delete'] = "<div class='text-danger text-center py-3'><strong?> The image Deletation Failed </strong></div>";
          ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
            </script>
          <?php
        }
      }

      $img_type=$_FILES['img']['type'];
      $img_size=$_FILES['img']['size'];
      $img_tem_loc=$_FILES['img']['tmp_name'];
      $img_store="../judiciary-system-management/public/images/$img";
      move_uploaded_file($img_tem_loc, $img_store);

      $sqlupdate = "UPDATE `chief_justice`
        SET `image` = '$img', `name` = '$name', `appointedBy` = '$appointedBy', `appointedIn` = '$appointedIn', `profile` = '$profile'
        WHERE `id` = '1'";
    }
    // echo $sqlupdate;
    $res = mysqli_query($conn, $sqlupdate) or die(mysqli_connect_error());

    if($res){

      $_SESSION['update'] = "<div class='text-success text-center'> <strong>Chief Justice has been Updated</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
        </script>
    <?php
    }else{

      $_SESSION['update'] = "<div class='text-danger text-center'> <strong>Chief Justice has not been Updated</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
        </script>
    <?php
    }
}
?>

<?php
    if(isset($_POST['cancel'])){
        ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
            </script>
        <?php
}
?>

<?php
if(isset($_POST['add'])){
    $img = $_FILES['img']['name'];
    $img_type=$_FILES['img']['type'];
    $img_size=$_FILES['img']['size'];
    $img_tem_loc=$_FILES['img']['tmp_name'];
    $img_store="../judiciary-system-management/public/images/$img";
    move_uploaded_file($img_tem_loc, $img_store);

    $name = $_POST['name'];
    $appointedBy = $_POST['appointedBy'];
    $appointedIn = $_POST['appointedIn'];
    $profile = $_POST['profile'];

    $sqladd = "INSERT INTO `chief_justice` (`image`, `name`, `appointedBy`, `appointedIn`, `profile`) 
      VALUES ('$img', '$name', '$appointedBy', '$appointedIn', '$profile')";
    
    $res = mysqli_query($conn, $sqladd) or die(mysqli_connect_error());
    
    if($res){

      $_SESSION['add'] = "<div class='text-success text-center'> <strong>A new item has been added</strong> </div>";
      ?>
          <script type="text/javascript">
              window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
          </script>
      <?php

    }else{

      $_SESSION['add'] = "<div class='text-danger text-center'> <strong>New addition is failed</strong> </div>";
      ?>
          <script type="text/javascript">
              window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
          </script>
      <?php
    }
}
?>
