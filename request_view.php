<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advocate Request</title>
    <!-- Bootstrap CSS Link -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="request_view.css" />

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
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Check Request</h2>
              <?php 
              if (isset($_SESSION['request_cancled'])) {
                  echo $_SESSION['request_cancled'];
                  unset($_SESSION['request_cancled']);
                }
                ?>

              <?php
                $requestId = $_GET['id'];

                $sql = "SELECT * FROM `advocate_access_request` WHERE `id` = '$requestId'";
                $res = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_array($res);
                
                $sqlForAdvocateId = "SELECT * FROM `advocate_profile` ORDER BY id DESC LIMIT 1";
                $resForAdvocateId = mysqli_query($conn, $sqlForAdvocateId);
                $rowsForAdvocateId = mysqli_fetch_array($resForAdvocateId);

                $lastAdvocateId = $rowsForAdvocateId['id'];
            ?>

              <form method="POST" action="">

                <div class="form-outline mb-2">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" readonly name="name" value="<?php echo $rows['name']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Name</label>
                </div>

                <div class="form-outline mb-2">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" readonly name="address" value="<?php echo $rows['address']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Address</label>
                </div>

                <div class="form-outline mb-2 d-flex justify-content-center">
                    <a class="btn btn-primary fw-bold" href="../Assets/General Pdf/<?php echo $rows['llbCertification']; ?>">
                        LLB Certification
                    </a>
                </div>

                <div class="form-outline mb-2">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" readonly name="phoneNo" value="<?php echo $rows['phoneNo']; ?>"/>
                  <label class="form-label" for="form3Example1cg">Phone No</label>
                </div>

                <div class="form-outline mb-2">
                  <input type="emailAddress" id="form3Example3cg" class="form-control form-control-lg" readonly name="emailAddress" value="<?php echo $rows['emailAddress']; ?>"/>
                  <label class="form-label" for="form3Example3cg">EmailAddress</label>
                </div>

                <div class="form-outline mb-2">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" readonly name="password" value="<?php echo $rows['password']; ?>"/>
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="accept" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Accept</button> <br>
                  <button type="submit" name="reject" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-body m-2">Reject</button> <br>
                  <button type="submit" name="close" class="btn btn-secondary btn-block btn-lg gradient-custom-4 text-body m-2">Close</button>
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
if(isset($_POST['accept'])){
    $advocateId = $lastAdvocateId + 1;
    $full_name = $_POST['name'];
    $phoneNo = $_POST['phoneNo'];
    $advocateAddress = $_POST['address'];
    $advocateEmail = $_POST['emailAddress'];
    $password = md5($_POST['password']);

    $sqlinsert = "INSERT INTO `advocate_profile` (`advocateId`, `full_name`, `phoneNo`, `address`, `email`, `password`) 
    VALUES ('$advocateId', '$full_name', '$phoneNo', '$advocateAddress', '$advocateEmail', '$password')";
    $resinsert = mysqli_query($conn, $sqlinsert);

    if($resinsert){
        $sqldlt = "DELETE FROM `advocate_access_request` WHERE `id` = '$requestId'";
        $resdlt = mysqli_query($conn, $sqldlt);

        if($resdlt){
            $subject = "An email regarding to your request for your profile in Judiciary Management System";
            $body = "Your request for an advocate portal has been accepted \n Your advocate ID is : $advocateId \n login with the email & password you set for yourself \n Go to http://localhost/projects/Defence/advocate/ for login";
            $headers = "From: km3009721@gmail.com";
            if (mail($advocateEmail, $subject, $body, $headers)) {
                // echo "An Email has been sent to $judgeEmail for your password reset";
                $_SESSION['request'] = "<div class='text-success text-center'> <strong>New Advocate has been added</strong> </div>";
                ?>
                <script type="text/javascript">
                    window.location.href = '<?php echo SITEURL; ?>dashboard.php';
                </script>
                <?php
            } else {
                echo "Email sending failed...";
            }
        }
    }else{
        $_SESSION['request_cancled'] = "<div class='text-danger text-center'> <strong>Your profile has not been updated</strong> </div>";
        ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>request_view.php';
        </script>
        <?php
    }
}elseif(isset($_POST['reject'])){
    $sqldelete = "DELETE FROM `advocate_access_request` WHERE `id` = '$requestId'";
    $resdelete = mysqli_query($conn, $sqldelete);

    if($resdelete){
        ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>dashboard.php';
        </script>
        <?php
    }
}elseif(isset($_POST['close'])){
    ?>
    <script type="text/javascript">
        window.location.href = '<?php echo SITEURL; ?>dashboard.php';
    </script>
    <?php
}
?>
