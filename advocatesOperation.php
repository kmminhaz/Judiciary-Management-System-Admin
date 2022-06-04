<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Operation</title>
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
            <?php
              $profileTarget = $_GET['target'];
              $profileId = $_GET['id'];

              if($profileTarget == 'advocate'){
                  $sql = "SELECT * FROM `advocate_profile` WHERE `id` = '$profileId'";
              }elseif($profileTarget == 'judge'){
                  $sql = "SELECT * FROM `judge_profile` WHERE `id` = '$profileId'";
              }elseif($profileTarget == 'add'){
                $sqlForJudgeId = "SELECT * FROM `judge_profile` ORDER BY id DESC LIMIT 1";
                $resForJudgeId = mysqli_query($conn, $sqlForJudgeId);
                $rowsForJudgeId = mysqli_fetch_array($resForJudgeId);

                $lastJudgeId = $rowsForJudgeId['id'];
              }
            ?>

            <?php 
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>

            <?php
              if($profileTarget != 'add'){
                $res = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_array($res);
                ?>
                  <h4 class="text-uppercase text-center mb-5"><?php echo $profileTarget; ?> Profile of <span class="fw-bold fs-5"><?php echo $rows['full_name']; ?></span></h4>
                  <form method="POST" action="" class="">
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" readonly value="<?php echo $rows['full_name']; ?>"/>
                      <label class="form-label" for="form3Example1cg">Full Name</label>
                    </div>
                    
                    <?php
                        if($profileTarget == 'judge'){
                            ?>
                                <div class="form-outline mb-2">
                                    <input type="text" class="form-control form-control-lg" name="court" value="<?php echo $rows['appointedCourt']; ?>"/>
                                    <label class="form-label" for="form3Example1cg">Court Name</label>
                                </div>
                                <div class="form-outline mb-2">
                                    <input type="text" class="form-control form-control-lg" name="devision" value="<?php echo $rows['appointedDevision']; ?>"/>
                                    <label class="form-label" for="form3Example1cg">Court Devision</label>
                                </div>
                            <?php
                        }
                    ?>

                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" readonly value="<?php echo $rows['phoneNo']; ?>"/>
                      <label class="form-label" for="form3Example1cg">Phone No</label>
                    </div>

                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" readonly value="<?php echo $rows['address']; ?>"/>
                      <label class="form-label" for="form3Example1cg">Address</label>
                    </div>

                    <div class="form-outline mb-2">
                      <input type="email" class="form-control form-control-lg" readonly name="designationId" value="<?php echo $rows['email']; ?>"/>
                      <label class="form-label" for="form3Example3cg">Email</label>
                    </div>

                    <div class="d-flex justify-content-center">
                      <?php
                        if($profileTarget == 'judge'){
                          ?>
                            <button type="submit" name="update" class="btn btn-success btn-block btn-lg gradient-custom-4 text-white m-2">Update</button>
                            <button type="submit" name="delete" onclick="return confirm('Are you sure, You want to delete this profile !!');" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-white m-2">delete</button>
                          <?php
                        }else{
                          ?>
                            <button type="submit" name="delete" onclick="return confirm('Are you sure, You want to delete this profile !!');" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-white m-2">delete</button>
                          <?php
                        }
                      ?>
                    </div>
                  </form>
                <?php
              }else{
                ?>
                  <h4 class="text-uppercase text-center mb-5">Add a New Judge Profile</h4>
                  <form method="POST" action="" class="">
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" name="name"/>
                      <label class="form-label" for="form3Example1cg">Full Name</label>
                    </div>
                    
                    <div class="form-outline mb-2">
                        <input type="text" class="form-control form-control-lg" name="court"/>
                        <label class="form-label" for="form3Example1cg">Court Name</label>
                    </div>
                    
                    <div class="form-outline mb-2">
                        <input type="text" class="form-control form-control-lg" name="devision"/>
                        <label class="form-label" for="form3Example1cg">Court Devision</label>
                    </div>
                    
                    <div class="form-outline mb-2">
                        <input type="text" class="form-control form-control-lg" name="appointed"/>
                        <label class="form-label" for="form3Example1cg">Appointed In</label>
                    </div>

                    <div class="form-outline mb-2">
                      <input type="email" class="form-control form-control-lg" name="email"/>
                      <label class="form-label" for="form3Example3cg">Email</label>
                    </div>

                    <div class="d-flex justify-content-center">
                      <button type="submit" name="add" onclick="return confirm('Are you sure, You want to add this profile to Judges !!');" class="btn btn-dark btn-block btn-lg gradient-custom-4 text-white m-2"> Add Judge </button>
                    </div>
                  </form>
                <?php
              }
            ?>
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

  // others
  $court = $_POST['court'];
  $devision = $_POST['devision'];

  $sql="UPDATE `judge_profile` SET `appointedCourt`='$court', `appointedDevision`='$devision' WHERE `id`='$profileId'";
  // echo $sql;


  $query=mysqli_query($conn,$sql);
  
  if($query){

    $_SESSION['update'] = "<div class='text-success text-center'> <strong>Your profile item has been updated</strong> </div>";

    ?>
      <script type="text/javascript">
          window.location.href = '<?php echo SITEURL; ?><?php echo $profileTarget ?>_data_table.php';
      </script>
    <?php
    }else{

      $_SESSION['update'] = "<div class='text-danger text-center'> <strong>Your profile item has not been updated</strong> </div>";

    ?>
      <script type="text/javascript">
          window.location.href = '<?php echo SITEURL; ?><?php echo $profileTarget ?>_data_table.php';
      </script>
    <?php
    }
}
?>
<?php
    if(isset($_POST['delete'])){
      if($profileTarget == 'advocate'){
          $deleteQuery = "DELETE FROM advocate_profile WHERE id = '$profileId'";
      }else{
          $deleteQuery = "DELETE FROM judge_profile WHERE id = '$profileId'";
      }
        
        echo $deleteQuery;
        $resDelete = mysqli_query($conn, $deleteQuery);

        if($resDelete){
            $_SESSION['delete'] = "<div class='text-success text-center py-3'><strong?> The profile is Deleted Successfully </strong></div>";
            ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?><?php echo $profileTarget ?>_data_table.php';
            </script>
        <?php
        }else{
            $_SESSION['delete'] = "<div class='text-danger text-center py-3'><strong?> The profile is Deletation Failed </strong></div>";
            ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?><?php echo $profileTarget ?>_data_table.php';
            </script>
        <?php
        }
}
?>

<?php
    if(isset($_POST['add'])){
      $judgeId = $lastJudgeId + 1;
      $name = $_POST['name'];
      $court = $_POST['court'];
      $devision = $_POST['devision'];
      $appointed = $_POST['appointed'];
      $email = $_POST['email'];

        $addQuery = "INSERT INTO `judge_profile` (`judgeId`, `full_name`, `appointedCourt`, `appointedDevision`, `appointed_in`, `email`) 
          VALUES ('$judgeId' ,'$name', '$court', '$devision', '$appointed', '$email')";

        $resAdd = mysqli_query($conn, $addQuery);

        if($resAdd){
            $subject = "An email regarding to your Judge Profile in Judiciary Management System";
            $body = "A Judge Portal has been created for you \n Your Judge ID is : $judgeId \n Go to this link : http://localhost/projects/Defence/judge/html/forgot-password.php/ and provide your Judge Email and Judge Id for first time login and then set your password inside the profile tab of your Judge Portal \n for farther login";
            $headers = "From: km3009721@gmail.com";
            if (mail($email, $subject, $body, $headers)) {

                // echo "An Email has been sent to $judgeEmail for your password reset";
                $_SESSION['add'] = "<div class='text-success text-center py-3'><strong?> The Profile is Added Successfully </strong></div>";
                ?>
                <script type="text/javascript">
                    window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
                </script>
                <?php
            } else {
                $_SESSION['error'] = "<div class='text-wrong text-center py-3'><strong?> The Email Sending Failed </strong></div>";
            }
        }else{
            $_SESSION['add'] = "<div class='text-danger text-center py-3'><strong?> The Profile Addition Failed </strong></div>";
            ?>
            <script type="text/javascript">
                window.location.href = '<?php echo SITEURL; ?>judge_data_table.php';
            </script>
        <?php
        }
}
?>
