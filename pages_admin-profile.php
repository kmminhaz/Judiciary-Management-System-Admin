<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
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
              <h4 class="text-uppercase text-center mb-5 fw-bold">Manage Admin's</h4>

              <?php
              if (isset($_SESSION['login'])) {
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
                  }
              ?>

              <form method="POST" action="">

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example1cg">Name</label>
                    <input type="text" class="form-control form-control-lg" name="name"/>
                </div>

                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3cg">Email</label>  
                    <textarea type="text" class="form-control form-control-lg" name="email"></textarea>
                </div>
                
                <div class="form-outline mb-2">
                    <label class="form-label" for="form3Example3cg">Phone</label>  
                    <textarea type="text" class="form-control form-control-lg" name="phone"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="add" class="btn btn-success btn-block btn-lg text-white m-2 mt-3">Add New</button>
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
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $setPass = uniqid();
      $password = md5($setPass);

        $addQuery = "INSERT INTO `admin_members` (`adminName`, `adminEmail`, `adminPhone`, `adminPassword`) 
          VALUES ('$name', '$email', '$phone', '$password')";

        $resAdd = mysqli_query($conn, $addQuery);

        if($resAdd){
            $subject = "An email regarding to your post as Admin in Judiciary Management System";
            $body = "An Admin ability has been given to you. \n Your Initial Admin Password is : $setPass \n Go to this link : http://localhost/projects/Defence/admin/ for login";
            $headers = "From: km3009721@gmail.com";
            if (mail($email, $subject, $body, $headers)) {

                // echo "An Email has been sent to $judgeEmail for your password reset";
                $_SESSION['add'] = "<div class='text-success text-center py-3'><strong?> The Profile is Added Successfully </strong></div>";
                ?>
                <script type="text/javascript">
                    window.location.href = '<?php echo SITEURL; ?>dashboard.php';
                </script>
                <?php
            } else {
                $_SESSION['error'] = "<div class='text-wrong text-center py-3'><strong?> The Email Sending Failed </strong></div>";
            }
        }else{
            $_SESSION['add'] = "<div class='text-danger text-center py-3'><strong?> The Admin Addition Failed </strong></div>";
        }
}
?>

<?php
    if(isset($_POST['cancel'])){
        ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>dashboard.php';
            </script>
        <?php
}
?>
