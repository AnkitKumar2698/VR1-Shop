<?php
session_start();
include 'db/conn.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
$email=$_SESSION['email'];
 $query="select Paid,FilledForms from users where Email='$email' ";
 $result=mysqli_query($conn,$query);
 $res=mysqli_fetch_array($result);
 $form_Can_Be_Filled=1;
 $_SESSION['paidmember']=$res['Paid'];
 if($_SESSION['paidmember'])
 {
    $form_Can_Be_Filled=10;
 }
 $forms_left=$form_Can_Be_Filled-$res['FilledForms'];
 $_SESSION['leftForms']=$forms_left;
 function showForms(){
   if($_SESSION['leftForms']===0){
   echo " To Fill Form Buy Premium";
   }
   else
   {
     echo "Add New Form (",$_SESSION['leftForms'],")";
   }
 };
 $query="select id,title from form where email='$email'";
 $result=mysqli_query($conn,$query);
 $number_of_forms=mysqli_num_rows($result);
 function setproducts($formID){
  $totalproduct=1;
  if($_SESSION['paidmember'])
  {
    $totalproduct=10;
  }
  include 'db/conn.php';
  $query="select totalProducts from form where id='$formID'";
  $resultleftforms=mysqli_query($conn,$query);
  $resleftforms=mysqli_fetch_array($resultleftforms);
  $product_left=$totalproduct-$resleftforms['totalProducts'];
  $_SESSION['leftproducts']=$product_left;
  return $product_left;
  }
  function showProducts($leftproducts)
  {
    if($leftproducts===0 && !$_SESSION['paidmember'])
    {
      echo "Buy Premium";
    }
    else if($leftproducts===0){
      echo "Limit Exceded";
    }
    else
    {
      echo "Add products (",$leftproducts,")";
    }
  }
    $query="select id,WhatsAppNumber from users where Email='$email'";
$result4=mysqli_query($conn,$query);
$res4=mysqli_fetch_array($result4);
$user_id=$res4['id'];
$WhatsappNumber=$res4['WhatsAppNumber'];
$formURL=$_SERVER['SERVER_NAME']."/vr1/admin/page.php?id=$user_id";
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
    <style>
        #myDiv1{
            display:none;
        }
        @media (max-width: 768px){
            .btn-responsive-sm {
                font-size: 10px;
            }
        }
    </style>
    

  <title>Dashboard</title>
</head>

<body>
  <?php include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
  ?>
  
         <nav class="navbar navbar-expand-lg navbar-white bg-white ml-auto">

<div class="container-fluid mx-auto" id="navbarSupportedContent">
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <button type="submit" class="btn btn-success"> <a class="nav-link text-white" target="__blank" href="https://api.whatsapp.com/send?phone=<?php echo $WhatsappNumber ?>&text=<?php echo "Hello You can Buy the Product From here ",$formURL ?>">WhatsApp</a></button>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <button type="submit" class="btn btn-success"> <a class="nav-link text-white" href="/vr1/admin/newForm.php"><?php showForms() ?></a></button>
    </li>
  </ul>
</div>
</nav>
<section class="content">
      <div class="container-fluid mt-2">
        <div class="row mb-2">
          
          <div class="col-sm-6 col-md-8 ml-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"># Form</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive-sm">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Form Title</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php for($i=1;$i<=$number_of_forms;$i++) {
                     $resForm=mysqli_fetch_array($result); 
                    $left= setproducts($resForm['id']);
                    
                     ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $resForm['title'] ?>
                    </td>
                    <td><a href="/vr1/admin/editform.php?id=<?php echo $resForm['id'] ?>"><button class="btn btn-primary mb-2">Edit Form</button></a>
                    <a href="/vr1/admin/productForm.php?id=<?php echo $resForm['id'] ?>"><button class="btn  btn-warning ml-1 mb-2"><?php showProducts($left) ?></button></a>
                    <button class="btn btn-success ml-1 mb-2" id="toggle1">Show/Hide Product</button>
                  </td>
                  </tr>
                  <tr><td colspan="3">
                  <div class="card" id="myDiv1">
                    <div class="card-header">
                      <h3 class="card-title"># Product</h3>
                    </div>
                    <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                    <th>S.No.</th>
                    <th>Form Title</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php  $form_id=$resForm['id'];
                        $query="select id,name from product where formID='$form_id'";
                        $result1=mysqli_query($conn,$query);
                        $total_forms =mysqli_num_rows($result1);
                      for($j=1;$j<=$total_forms;$j++) {
                      $resproduct=mysqli_fetch_array($result1);
                    ?>
                  <tr>
                    <td><?php echo $j ?></td>
                    <td><?php echo $resproduct['name'] ?>
                    </td>
                    <td><a href="/vr1/admin/editProduct.php?id=<?php echo $resproduct['id'] ?>"><button class="btn btn-primary">Edit Product</button></a>
                  </td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</td> </tr>
<?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
         
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
  <script>

    const targetDiv1 = document.getElementById("myDiv1");
    const btn1 = document.getElementById("toggle1");

    btn1.onclick = function() {
      if(targetDiv1.style.display !== "none"){
        targetDiv1.style.display = "none";
      } else {
        targetDiv1.style.display = "block";
      }
    }

  </script>
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