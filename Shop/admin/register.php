<?php
 include 'db/conn.php';
$showAlert = false;
$showError = false;
$alldetailsnotfield=false;
$validEmail=false;
if(isset($_POST['Register'])){

 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 
 $cpassword = $_POST['cpassword'];
 $number = $_POST['number'];
 $location=" ";
 if($name=="" || $email== "" || $password=="" || $cpassword==""  || $number=="")
 {
    $alldetailsnotfield=true;
    
 }
 // Check whether these username exists or not
 else{
   
 $existSql = "SELECT `id`, `Name`, `Password`, `WhatsAppNumber`, `Date`, `Paid`, `FilledForms`, `location` FROM `users` WHERE `Email`='$email'";
 $result1 = mysqli_query($conn, $existSql) or die(mysqli_error($conn)) ;
 $numExistRows = mysqli_num_rows($result1);
 if($numExistRows> 0){
     $showError="Email Already Registered";
 }
 else{
   if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
     $validEmail=true; 
   } 
 else if(($password == $cpassword)){
    
     $hash = password_hash($password, PASSWORD_DEFAULT);
    
     $sql = "INSERT INTO `users` ( `Name`, `Email`, `Password`, `WhatsAppNumber`, `Date`,`location`) VALUES ('$name', '$email', '$hash', '$number', CURRENT_TIMESTAMP,'$location')";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
   
     if($result){
         $showAlert= true;
     } 
     if(isset($_SESSION['loggedin']))
     {
         $_SESSION['loggedin']=false;
     }
     header("location: form.php");
     exit;
 }
 else {

     $showError = "Your Password Do Not Match";
 }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Register Here</title>
</head>

<body>
    <?php
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You Account has been created.
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
                    <h1 class="text-dark">Dukan</h1>
                </figure>
                <div class="container mx-auto mb-4">                
                <form class="d-flex flex-column align-items-center" method="POST" action="/vr1/admin/register.php" >
                <a class="form-group col-md-6 silver-color mt-4" href="/freelancer/admin/login.php">Already have an account? Login here</a>
                <h2 class="form-group col-md-6">Register</h2>
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                            placeholder="Enter Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                            <?php if($validEmail) { ?>
                            <p style="color:red">*Enter Valid Email </p>
                            <?php }?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword"
                            placeholder="Password">
                        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password
                            else.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number">WhatsApp Number</label>
                        <input type="number" class="form-control" id="number" name="number" placeholder="Enter Number">
                    </div>
                    <div>
                        <?php if(isset($_POST['Register']) && $alldetailsnotfield) {
                        ?>
                       <p style="color:red">*All Details Mandatory</p>
                       <?php }?>
                    </div>
                    <input type="submit" name="Register" class="dirbtn btn text-white col-md-6 mb-4" value="Register">
                    <p style="font-size:10px">After Register Please Login using Above Email and Password</p>
                </form>
                </div>
            </div>
        </div>
    </div>
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