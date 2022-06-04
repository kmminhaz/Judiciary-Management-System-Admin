<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advocate gallery</title>
    <!-- Bootstrap CSS Link -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="gallery_view.css" />

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
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="my-3 col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Reply to the gallery</h2>

            <?php
              $galleryId = $_GET['id'];

              $sql = "SELECT * FROM `imageslider` WHERE `id` = '$galleryId'";
              $res = mysqli_query($conn, $sql);
              $rows = mysqli_fetch_array($res);
            ?>

              <form method="POST" action="" enctype="multipart/form-data">

                <div class="form-outline mb-2">
                  <input type="text" class="form-control form-control-lg" readonly value="<?php echo $rows['imageName']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Name</label>
                </div>

                <div class="form-outline mb-2">
                  <img src="./images/sliderImages/<?php echo $rows['imageName']; ?>" alt="No Image found" srcset="" height="150px" width="300px">
                  <label class="form-label" for="form3Example1cg"></label>
                </div>

                <div class="form-outline mb-2">
                  <label for="">Chose your image here</label> <br> <br>
                  <input id="img" type="file" name="img" value="" require>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="update" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Update</button> <br>
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
  $img_type=$_FILES['img']['type'];
  $img_size=$_FILES['img']['size'];
  $img_tem_loc=$_FILES['img']['tmp_name'];
  $img_store="./images/sliderImages/$img";
  move_uploaded_file($img_tem_loc, $img_store);

  $sql="UPDATE `imageslider` SET `imageName` = '$img' WHERE `id`='$galleryId'";
  
  $query=mysqli_query($conn,$sql);
  if($query){

    $_SESSION['update'] = "<div class='text-success text-center'> <strong>Your slider image has been updated</strong> </div>";
  
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>dashboard.php';
        </script>
    <?php
    }else{

      $_SESSION['update'] = "<div class='text-danger text-center'> <strong>Your slider image has not been updated</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>dashboard.php';
        </script>
    <?php
    }
}
?>
