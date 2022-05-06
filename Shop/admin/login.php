<?php
$login = false;
$showError = false;
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 include 'db/conn.php';
 $email = $_POST['email'];
 $password = $_POST['password'];
     $sql = "Select * from users where Email='$email'";
     $result = mysqli_query($conn, $sql);
     if($result){
     $num = mysqli_num_rows($result);
     if($num == 1){
         while($row=mysqli_fetch_array($result)){
             if (password_verify($password,$row['Password'])){
                   
                $login= true;
              
                $_SESSION['loggedin'] = true;
                $_SESSION['email']=$row['Email'];
                $_SESSION['name'] = $row['Name'];
                $_SESSION['admin']=false;
                if($row['Email']==="ankit@gmail.com")
                {
                    $_SESSION['admin']=true;
                }
                header("location: index.php");
                exit;
             }
             else {
                $showError = "Invalid Credentials";
               }
         }
     } 
    else {
     $showError = "Invalid Credentials";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Login Here</title>
</head>

<body>
    <?php
    if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>'.$showError.'.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    ?>
    <div class="container-fluid mx-auto main-bg">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5">
                <figure id="logo">
                    <h1 class="text-dark"><a href="/index.html">Ankit's Dukan</a></h1>
                </figure>
                <div class="container mx-auto mb-4">                
                <form class="d-flex flex-column align-items-center" method="POST">
                <a class="form-group col-md-6 silver-color mt-5" href="/vr1/admin/register.php">Don't have an account? Register here</a>
                <h2 class="form-group col-md-6">Login</h2>
            <div class="form-group col-md-6">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    placeholder="Enter email">
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn dirbtn text-white col-md-6 mb-4">Login</button>
        </form>
    </div>
</div>
</div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>