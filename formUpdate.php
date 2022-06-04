<?php include('./assets/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
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
              <h2 class="text-uppercase text-center mb-5">Update the form</h2>

            <?php
              $formId = $_GET['id'];
              $formTarget = $_GET['target'];

              if($formTarget == 'general'){
                  $sql = "SELECT * FROM `generalusersforms` WHERE `id` = '$formId'";
              }
              if($formTarget == 'administrative'){
                  $sql = "SELECT * FROM `administrativ_forms` WHERE `id` = '$formId'";
              }
              $res = mysqli_query($conn, $sql);
              $rows = mysqli_fetch_array($res);
            ?>
            
            <?php
              if($formTarget == 'general'){
                ?>

                <form method="POST" action="" enctype="multipart/form-data">

                  <div class="form-outline mb-2">
                    <input type="text" name="file_name" class="form-control form-control-lg" value="<?php echo $rows['file_name']; ?>"/>
                    <label class="form-label" for="form3Example1cg">Name</label>
                  </div>
                  
                  <div class="form-outline mb-2">
                    <input type="text" name="file_type" class="form-control form-control-lg" value="<?php echo $rows['file_type']; ?>"/>
                    <label class="form-label" for="form3Example1cg">Type</label>
                  </div>
                
                  <article>
                    <!-- button -->
                    <button
                      type="button"
                      class="btn btn-info fw-bold text-start border-white shadow"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal<?php echo $rows['id']; ?>"
                    >
                      Show Document
                    </button>

                    <!-- Modal -->
                    <div
                      class="modal fade"
                      id="exampleModal<?php echo $rows['id']; ?>"
                      tabindex="-1"
                      aria-labelledby="exampleModalLabel"
                      aria-hidden="true"
                    >
                      <div
                        class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                      >
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5
                              class="modal-title text-dark fw-bold"
                              id="exampleModalLabel"
                            >
                              <?php echo $rows['file_name']; ?>
                            </h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <div class="modal-body text-dark">
                            <iframe
                              src="./assets/pdf/forms/general/<?php echo $rows['file']; ?>"
                              width="100%"
                              height="500px"
                            >
                            </iframe>
                          </div>
                          <div class="modal-footer">
                            <button
                              type="button"
                              class="btn btn-secondary"
                              data-bs-dismiss="modal"
                            >
                              Close
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </article>

                  <div class="form-outline my-4">
                    <input id="pdf" type="file" name="pdf" value="" require>
                    <label for="">Choose pdf file to update the pdf item</label> <br> <br>
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" name="update" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Update</button> <br>
                  </div>
                </form>

                <?php
              }elseif($formTarget == 'administrative'){
                ?>

                  <form method="POST" action="" enctype="multipart/form-data">

                  <div class="form-outline mb-2">
                    <input type="text" name="name" class="form-control form-control-lg" value="<?php echo $rows['name']; ?>"/>
                    <label class="form-label" for="form3Example1cg">Name</label>
                  </div>
                
                  <article>
                    <!-- button -->
                    <button
                      type="button"
                      class="btn btn-info fw-bold text-start border-white shadow"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal<?php echo $rows['id']; ?>"
                    >
                      Show Document
                    </button>

                    <!-- Modal -->
                    <div
                      class="modal fade"
                      id="exampleModal<?php echo $rows['id']; ?>"
                      tabindex="-1"
                      aria-labelledby="exampleModalLabel"
                      aria-hidden="true"
                    >
                      <div
                        class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                      >
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5
                              class="modal-title text-dark fw-bold"
                              id="exampleModalLabel"
                            >
                              <?php echo $rows['name']; ?>
                            </h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <div class="modal-body text-dark">
                            <iframe
                              src="<?php echo $rows['pdf']; ?>"
                              width="100%"
                              height="500px"
                            >
                            </iframe>
                          </div>
                          <div class="modal-footer">
                            <button
                              type="button"
                              class="btn btn-secondary"
                              data-bs-dismiss="modal"
                            >
                              Close
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </article>

                  <div class="form-outline my-4">
                    <input type="text" name="pdf" value="" require> <br>
                    <label for="">Give the link of the file</label> <br> <br>
                  </div>

                  <div class="d-flex justify-content-center">
                    <button type="submit" name="update" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-2">Update</button> <br>
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
  $pdf = $_FILES['pdf']['name'];
  $pdf_type=$_FILES['pdf']['type'];
  $pdf_size=$_FILES['pdf']['size'];
  $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
  if($formTarget == 'general'){
    $pdf_store="./assets/pdf/forms/general/$pdf";
    move_uploaded_file($pdf_tem_loc, $pdf_store);

    // others
    $name = $_POST['file_name'];
    $type = $_POST['file_type'];

    if($pdf == ''){
      $sql="UPDATE `generalusersforms` SET `file_name` = '$name',`file_type` = '$type' WHERE `id`='$formId'";
    }else{
      $sql="UPDATE `generalusersforms` SET `file_name` = '$name',`file_type` = '$type',`file` = '$pdf' WHERE `id`='$formId'";
    }
  }elseif($formTarget == 'administrative'){
    $pdf = $_POST['pdf'];
    
    // others
    $name = $_POST['name'];

    if($pdf == ''){
      $sql="UPDATE `administrativ_forms` SET `name` = '$name' WHERE `id`='$formId'";
    }else{
      $sql="UPDATE `administrativ_forms` SET `name` = '$name',`pdf` = '$pdf' WHERE `id`='$formId'";
    }
  }
  
  $query=mysqli_query($conn,$sql);
  if($query){

    $_SESSION['update'] = "<div class='text-success text-center'> <strong>Your pdf item has been updated</strong> </div>";

    ?>
      <script type="text/javascript">
          window.location.href = '<?php echo SITEURL; ?>forms.php';
      </script>
    <?php
    }else{

      $_SESSION['update'] = "<div class='text-danger text-center'> <strong>Your pdf item has not been updated</strong> </div>";

    ?>
      <script type="text/javascript">
          window.location.href = '<?php echo SITEURL; ?>forms.php';
      </script>
    <?php
    }
}
?>
