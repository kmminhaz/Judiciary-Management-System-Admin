<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
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
  <div class="mask d-flex align-items-center h-100 gradient-custom-3 py-3">
    <div class="container h-100 my-5 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Add Form</h2>

              <?php
                $page = $_GET['target'];

                if($page == 'general'){
                  ?>
                    <form method="POST" action="" enctype="multipart/form-data">

                      <div class="form-outline mb-2">
                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="file_name"/>
                        <label class="form-label" for="form3Example1cg">Name</label>
                      </div>

                      <div class="form-outline mb-2">
                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="file_type"/>
                        <label class="form-label" for="form3Example1cg">Type</label>
                      </div>

                      <div class="form-outline mb-2">
                        <input id="pdf" type="file" name="pdf" value="" require>
                        <label for="">Choose a form as pdf file to upload</label> <br> <br>
                      </div>

                      <div class="d-flex justify-content-center">
                        <button type="submit" name="addGeneral" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Add</button>
                      </div>

                    </form>
                  <?php
                }
                elseif($page == 'administrative'){
                  ?>
                    <form method="POST" action="" enctype="multipart/form-data">

                      <div class="form-outline mb-2">
                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name"/>
                        <label class="form-label" for="form3Example1cg">Name</label>
                      </div>

                      <div class="form-outline mb-2">
                        <input type="text" name="pdf" value="" require>
                        <label for="">Give the link of your Administrativ form provided by Govt.</label> <br> <br>
                      </div>

                      <div class="d-flex justify-content-center">
                        <button type="submit" name="addAdministrative" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Add</button>
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
if(isset($_POST['addGeneral'])){
  $pdf = $_FILES['pdf']['name'];
  $pdf_type=$_FILES['pdf']['type'];
  $pdf_size=$_FILES['pdf']['size'];
  $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
  $pdf_store="./assets/pdf/forms/general/$pdf";
  move_uploaded_file($pdf_tem_loc, $pdf_store);

  $file_name = $_POST['file_name'];
  $file_type = $_POST['file_type'];

  $sql = "INSERT INTO `generalusersforms` (`file_name`, `file_type`, `file`) 
      VALUES ('$file_name', '$file_type', '$pdf')";
  $query=mysqli_query($conn,$sql);

  if($query){

    $_SESSION['addForm'] = "<div class='text-success text-center'> <strong>New Item has been added successfully</strong> </div>";
  
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>forms.php';
        </script>
    <?php
    }else{

      $_SESSION['addForm'] = "<div class='text-danger text-center'> <strong>New Item has not been added successfully</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>forms.php';
        </script>
    <?php
    }
}elseif(isset($_POST['addAdministrative'])){
  $pdf = $_POST['pdf'];

  $name = $_POST['name'];

  $sql = "INSERT INTO `administrativ_forms` (`name`, `pdf`) 
      VALUES ('$name', '$pdf')";
  $query=mysqli_query($conn,$sql);

  if($query){

    $_SESSION['addForm'] = "<div class='text-success text-center'> <strong>New Item has been added successfully</strong> </div>";
  
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>forms.php';
        </script>
    <?php
    }else{

      $_SESSION['addForm'] = "<div class='text-danger text-center'> <strong>New Item has been not added successfully</strong> </div>";
    ?>
        <script type="text/javascript">
            window.location.href = '<?php echo SITEURL; ?>forms.php';
        </script>
    <?php
    }
}
?>
