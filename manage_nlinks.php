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
              <h4 class="text-uppercase text-center mb-5 fw-bold">Manage Link's</h4>

            <?php
                $linkId = $_GET['id'];
                $linkTarget = $_GET['target'];
              
                $sql = "SELECT * FROM `necessery_links` WHERE `id` = '$linkId'";
                $res = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_array($res);
              
            ?>

              <form method="POST" action="">

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example1cg">Title</label>
                    <input type="text" class="form-control form-control-lg" name="title" value="<?php echo $rows['title']; ?>"/>
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3cg">link</label>  
                    <textarea type="text" class="form-control form-control-lg" name="link"><?php echo $rows['link']; ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <?php
                        if($linkTarget == 'add'){
                            ?>
                                <button type="submit" name="add" class="btn btn-success btn-block btn-lg text-white m-2 mt-3">Add New</button>
                                <button type="submit" name="cancel" class="btn btn-dark btn-block btn-lg text-white m-2 mt-3">Cancle</button>
                            <?php
                        }else{
                            ?>
                                <button type="submit" name="delete" class="btn btn-danger btn-block btn-lg text-white m-2 mt-3" onclick="return confirm('Are you sure, You want to delete this Link !!');">Delete</button>
                                <button type="submit" name="update" class="btn btn-success btn-block btn-lg text-white m-2 mt-3">Update</button>
                                <button type="submit" name="cancel" class="btn btn-dark btn-block btn-lg text-white m-2 mt-3">Cancle</button>
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
if(isset($_POST['add'])){
    $title = $_POST['title'];
    $link = $_POST['link'];

    $sqladd = "INSERT INTO `necessery_links` (`title`, `link`) 
      VALUES ('$title', '$link')";
    $res = mysqli_query($conn, $sqladd) or die(mysqli_connect_error());

    if($res){

      $_SESSION['add'] = "<div class='text-success text-center'> <strong>A new Link has been added</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
        </script>
    <?php
    }else{

      $_SESSION['add'] = "<div class='text-danger text-center'> <strong>New addition is failed</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
        </script>
    <?php
    }
}
?>

<?php
if(isset($_POST['update'])){
    $title = $_POST['title'];
    $link = $_POST['link'];

    $sqlupdate = "UPDATE `necessery_links`
    SET `link` = '$link', `title` = '$title'
    WHERE `id` = '$linkId'";
    $res = mysqli_query($conn, $sqlupdate) or die(mysqli_connect_error());

    if($res){

      $_SESSION['update'] = "<div class='text-success text-center'> <strong>The Link has been updated</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
        </script>
    <?php
    }else{

      $_SESSION['update'] = "<div class='text-danger text-center'> <strong>The Link are not updated</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
        </script>
    <?php
    }
}
?>

<?php
    if(isset($_POST['delete'])){
        $deleteQuery = "DELETE FROM `necessery_links` WHERE id = '$linkId'";
        
        $resDelete = mysqli_query($conn, $deleteQuery);

        if($resDelete){
            $_SESSION['delete'] = "<div class='text-success text-center py-3'><strong?> The Link is Deleted Successfully </strong></div>";
            ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
            </script>
        <?php
        }else{
            $_SESSION['delete'] = "<div class='text-danger text-center py-3'><strong?> The Link is Deletation Failed </strong></div>";
            ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
            </script>
        <?php
        }
}
?>

<?php
    if(isset($_POST['cancel'])){
        ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>necessery_links.php';
            </script>
        <?php
}
?>
