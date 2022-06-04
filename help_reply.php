<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advocate help</title>
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
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="my-3 col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Reply to the help</h2>

            <?php
              $helpId = $_GET['id'];

              $sql = "SELECT * FROM `help_desk` WHERE `id` = '$helpId'";
              $res = mysqli_query($conn, $sql);
              $rows = mysqli_fetch_array($res);
            ?>

              <form method="POST" action="" class="">

                <div class="form-outline mb-2">
                  <input type="text" class="form-control form-control-lg" readonly name="name" value="<?php echo $rows['name']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Name</label>
                </div>

                <div class="form-outline mb-2">
                  <input type="text" class="form-control form-control-lg" readonly name="email" value="<?php echo $rows['email']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Email</label>
                </div>

                <div class="form-outline mb-2">
                  <input type="text" class="form-control form-control-lg" readonly name="designation" value="<?php echo $rows['designation']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Designation</label>
                </div>

                <div class="form-outline mb-2">
                  <input type="email" class="form-control form-control-lg" readonly name="designationId" value="<?php echo $rows['designationId']; ?>"/>
                  <label class="form-label" for="form3Example3cg">Designation Id</label>
                </div>

                <div class="form-outline mb-2">
                  <textarea type="text" class="form-control form-control-lg" readonly name="query"><?php echo $rows['query']; ?></textarea>
                  <label class="form-label" for="form3Example3cg">Query</label>
                </div>

                <div class="form-outline mb-2">
                  <textarea type="text" class="form-control form-control-lg" name="message"></textarea>
                  <label class="form-label" for="form3Example3cg">Message</label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="reply" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Reply</button> <br>
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
if(isset($_POST['reply'])){
    $message = $_POST['message'];
    $status = "Checked";

    $sqlupdate = "UPDATE `help_desk` 
    SET `answer` = '$message', `status` = '$status'
    WHERE `id` = '$helpId'";
    $res = mysqli_query($conn, $sqlupdate) or die(mysqli_connect_error());

    if($res){
      $full_name = $_POST['name'];
      $portalId = $_POST['designationId'];
      $designation = $_POST['designation'];
      $title = "Reply from help desk";
      $message = $_POST['message'];
      $status = "new";

      $sqlinsert = "INSERT INTO `notification` (`portalId`, `name`, `designation`, `title`, `message`, `status`) 
      VALUES ('$portalId', '$full_name', '$designation', '$title', '$message', '$status')";
      $resinsert = mysqli_query($conn, $sqlinsert);

      $_SESSION['help'] = "<div class='text-success text-center'> <strong>The reply is sent</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>dashboard.php';
        </script>
    <?php
    }else{

      $_SESSION['help'] = "<div class='text-danger text-center'> <strong>The reply is not sent</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>dashboard.php';
        </script>
    <?php
    }
}
?>
