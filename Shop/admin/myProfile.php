<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include 'db/conn.php';
$email=$_SESSION['email'];
$query="select Name,Password,WhatsAppNumber,location from users where Email='$email'";
$result=mysqli_query($conn,$query);
$res=mysqli_fetch_array($result);
$previous_name=$res['Name'];
$previous_wp=$res['WhatsAppNumber'];
$previous_password=$res['Password'];
$previous_location=$res['location'];
$passnotmatch=false;
if(isset($_POST['update']))
{
    $newName=$_POST['name'];
    $newWP=$_POST['number'];
    $newLocation=$_POST['location'];
    $enterPASS=$_POST['password'];
    if (password_verify($enterPASS,$previous_password)){
        $query= "UPDATE `users` SET `Name`='$newName',`WhatsAppNumber`='$newWP',`location`='$newLocation' where Email='$email'";
        $result2=mysqli_query($conn,$query);
        $query="select Name,Password,WhatsAppNumber,location from users where Email='$email'";
$result=mysqli_query($conn,$query);
$res=mysqli_fetch_array($result);
$previous_name=$res['Name'];
$previous_wp=$res['WhatsAppNumber'];
$previous_password=$res['Password'];
$previous_location=$res['location'];
    }
    else{
$passnotmatch=true;
    }
}
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');


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
    <title>Update Profile</title>
</head>

<body>
    <section class="content">
    <div class="container-fluid mx-auto admin-bg">
        <div class="row">
            <div class="col-md-9 ml-auto mt-5">
                <div class="container-fluid mx-auto mb-4">                
                <form class="d-flex flex-column align-items-center" action="/vr1/admin/myProfile.php" method="POST">
                <h2 class="form-group col-md-6 mt-5">Profile Settings</h2>
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                            value="<?php echo $previous_name?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email address</label>
                        <input type="email" readonly="true" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                        value="<?php echo $email?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="location">Business Location</label>
                        <input type="text" class="form-control" id="location" name="location" aria-describedby="emailHelp"
                        value="<?php echo $previous_location?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number">WhatsApp Number</label>
                        <input type="number" class="form-control" id="number" name="number" value="<?php echo $previous_wp?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Enter Previous Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password">
                    </div>
                    <?php if(isset($_POST['update']) && !$passnotmatch) {?>
                        <div>
                          Update Success
                      </div>
                  <?php  }?>
                      <?php if(isset($_POST['update']) && $passnotmatch) {?>
                        <div>
                            Password NOT Match
                      </div>
                  <?php  }?>
                    <button type="submit" name="update" class="dirbtn btn text-white col-md-6 mb-4">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </section>
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
<?php include('includes/footer.php') ?>;