<?php
session_start();
if(!isset($_SESSION['gotocart']))
{
   header("location:../../index.html");
   exit;
}
$totalPrice=0;
$text="Name: ".$_SESSION['customer_name'].", Note: ".$_SESSION['customer_notes'].",  Product : ";
$k=0;

foreach($_SESSION['arr'] as $getelements)
{
    $k++;
    $text=$text.$k.". ";
    $text=$text.$getelements[0];
    $text=$text." of Price: ";
    $text=$text.(string)$getelements[1];
    $text=$text.", ";
}
$WhatsappNumber=$_SESSION['wp']
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
    

  <title>Cart</title>
</head>

<body>
  <?php include('includes/header.php');

  ?>  
  <nav class="navbar theme-bg-default">
  <div style="display:flex;justify-content:center;align-items:center;overflow: hidden;">
      <img src="image/whatsapp-logo.svg" height="30" class="d-inline-block" alt="WhatsApp Logo"
          data-toggle="modal" data-target="#qrCodeModal" style="cursor: pointer">
      <div style="width:10px;"></div>
      <span style="width:500px;color:rgba(255,255,255,0.5);margin-top:2px;cursor: pointer;" data-toggle="modal"
          data-target="#qrCodeModal"> Order Form</span>
  </div>
  <a href="/vr1/admin/login.php"><img src="image/orderla-logo-form.svg" height="30" class="float-right" alt=""
          style="position: absolute; top:9px;right:6px;"></a>
</nav>
<section class="content">
   <form method="POST" action="/vr1/admin/users.php">
      <div class="container-fluid mt-5">
      <div class="row">
          <div class="col-9 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products in Your Cart</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Product Price(RM)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $arr=$_SESSION['arr'];
                      
                      foreach($arr as $key=>$onearr) {
                          
                         $totalPrice=$totalPrice+$onearr[1];
                         
                      ?>
                    <tr>
                      <td><?php echo $onearr[0]?></td>
                      <td><?php echo $onearr[1]?></td>
                      
                      <td><a href="/vr1/admin/deleteitem.php?id=<?php  echo $key ?>">Remove</a></td>
                    
                    </tr>
                 <?php }?>
                 <tr>
                     <td> Total :</td>
                     <td> <?php echo $totalPrice; ?></td>
                      </tr>
                  </tbody>
                </table>
                <br>
                <br>
                <div align="center">
                <?php $text=$text." Total Price is : ".(string)$totalPrice?>
                  <a href="https://api.whatsapp.com/send?phone=<?php echo $WhatsappNumber ?>&text=<?php echo $text?>" class="btn btn-success">Buy Now</a>
                      </div>
              </div>
              <br>
              <br>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</form>
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
    <?php
    include('includes/footer.php');
?>
</body>

</html>