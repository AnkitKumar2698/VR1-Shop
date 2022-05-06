<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
if($_SESSION['admin']==false)
{
  header("location : login.php");
  exit;
}
include 'db/conn.php'; 
if(isset($_POST['search']))
{
 $_SESSION['user_email']= $_POST['table_search'];
 $email=$_SESSION['user_email'];
  $query="select id,Name,Paid from users where Email='$email'";
  $result=mysqli_query($conn,$query);
  $res=mysqli_fetch_array($result);
  if($res)
  {
 
  $_SESSION['issearchpaid']=$res['Paid'];
  }
}
function showPaid()
 {
   if($_SESSION['issearchpaid'])
   {
     echo "Already Paid Member";
   }
   else
   {
     echo "Add Paid Member";
   }
 }
if(isset($_POST['make_paid']))
 {
   $email=$_SESSION['user_email'];
   $paid=1;
   $query="UPDATE `users` SET `Paid`='$paid' where Email='$email'";
   $result=mysqli_query($conn,$query);
  
 }
 
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
    

  <title>Admin Page</title>
</head>

<body>
  <?php include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
  ?>
<section class="content">
   <form method="POST" action="/vr1/admin/users.php">
      <div class="container-fluid mt-5">
      <div class="row">
          <div class="col-sm-6 col-md-8 ml-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Details Table</h3>
      
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Enter email Here">

                    <div class="input-group-append">
                      <button type="submit" name="search" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>User Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($_POST['search']) && $res ) {?>
                    <tr>
                      <td><?php echo $res['id']?></td>
                      <td><?php echo $res['Name']?></td>
                      <td><?php echo $email?></td>
                      <td><button class="btn btn-info" name="make_paid"><?php showPaid() ?></button></td>
                    </tr>
                   <?php }?>
                   <?php if(isset($_POST['search']) && !$res) {?>
                    <tr>
                      <td>
                      <p> No User Found</p>
                   </td>
                    </tr>
                   <?php }?>
                  </tbody>
                </table>
              </div>
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