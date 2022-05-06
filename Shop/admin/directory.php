<?php
include 'db/conn.php';
$query="SELECT * FROM `form` WHERE 1 ";
$result=mysqli_query($conn,$query);
$num=mysqli_num_rows($result);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    

  <title>Dashboard</title>
</head>

<body>

   <nav class="navbar theme-bg-default">
        <div style="display:flex;justify-content:center;align-items:center;overflow: hidden;">
            <img src="image/whatsapp-logo.svg" height="30" class="d-inline-block" alt="WhatsApp Logo"
                data-toggle="modal" data-target="#qrCodeModal" style="cursor: pointer">
            <div style="width:10px;"></div>
              

        </div>
          <a href="../../index.html" style="text-decoration:none;color:white;text-align:center;font-weight:bold;font-size:30px;" >Dukan</a>
            </nav>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../admin/image/bg1.png" height="250px" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../admin/image/img1.jpeg" height="250px" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../admin/image/img3.jpeg" height="250px" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<section class="content">
      <div class="container-fluid mt-2">
        <div class="row mb-2">          
          <div class="col-sm-6 col-md-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Some Latest Forms</h3>
              </div>
              <!-- /.card-header -->
            </div>
            <!-- /.card -->
            <div class="row">
            <?php for($i=0;$i<$num;$i++) { 
              $res=mysqli_fetch_array($result);
              ?>
             
            <div class="card col-lg-5 mx-auto mt-2" style="width: 20rem; height:16rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $res['title'] ?></h5>
    <div class="row">
    <p class="card-text ml-4" > <?php echo $res['productCatagory'] ?> <br><?php
    echo $res['formslug']?><br>Location : <?php echo $res['businesslocation']?></p>
    <figure class="ml-auto">
    <img align="right" src="<?php echo $res['imgDir'] ?>" width="90px" height="90px" alt="form-img"/></figure></div>
    <div class="card-text row" style="width:100%;">
    <a class="mx-auto" href="/vr1/admin/page.php?id=<?php $email=$res['email']; $query="select id from users where Email='$email'";
     $result1=mysqli_query($conn,$query);
     $res1=mysqli_fetch_array($result1);
     echo $res1['id'] ?>" ><button class="btn btn-success">Open Form</button></a></div>
</div>

</div>
<?php } ?>
</div>
         
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</body>
</html>