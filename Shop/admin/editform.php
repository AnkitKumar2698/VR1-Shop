<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include 'db/conn.php';
$formURL=$_SESSION['name']."/".$_SERVER['SERVER_NAME'];    
$email=$_SESSION['email'];
$idFromURL=$_GET['id']  ;
if($idFromURL>=0){
   $query="select email from form where id='$idFromURL'";
   $resultID=mysqli_query($conn,$query);
   $resultArrayForResultID=mysqli_fetch_array($resultID);
   if( $resultArrayForResultID['email']!==$email)
   {
     header("location: form.php");
     exit;
   }
   else{
    $query="select title,formslug,businesslocation,productCatagory from form where id='$idFromURL'";
    $resultFromURLID=mysqli_query($conn,$query);
    $resFromURLID=  mysqli_fetch_array($resultFromURLID);
    $title_from_previous_form=$resFromURLID['title'];
    $formSlug_from_previous_form=$resFromURLID['formslug'];
    $businessLocation_from_previous_form=$resFromURLID['businesslocation'];
    $product_catagory_from_previous_form=$resFromURLID['productCatagory'];
    if(isset($_POST['form_save']))
    {
        $title = $_POST['title'];
        $formSlug= $_POST['slug'];
        $businessLocation = $_POST['location'];
        $featuredImg = $_FILES['featuredImg'];
        $product_catagory = $_POST['product_title'];
        $img_dir1="uploads/".($_FILES['featuredImg']['name']);
      
        $query="UPDATE `form` SET `title`='$title',`formslug`='$formSlug',`businesslocation`='$businessLocation',`imgDir`='$img_dir1',`productCatagory`='$product_catagory' WHERE `id`='$idFromURL'";
        $result1=mysqli_query($conn,$query);
        if($result1)
        {
           move_uploaded_file($_FILES['featuredImg']['tmp_name'],$img_dir1);  
        }
        else
        {
            echo "Data not Saved";
        }
            header("location:form.php");
            exit;
    }
  }
}

$query="select WhatsAppNumber from users where Email='$email'";
$result=mysqli_query($conn,$query);
$res=mysqli_fetch_array($result);
$WhatsappNumber=$res['WhatsAppNumber'];
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


    <title>Form</title>
</head>

<body>
    <?php 
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    ?>
    <section class="content">
    <div class="container-fluid mt-5">
        <div class="row">
        <div class="col-sm-6 col-md-8 ml-auto register-right">
                
                
                <form method="POST" action="/vr1/admin/editform.php?id=<?php echo $idFromURL ?>" enctype="multipart/form-data">
                        <h3>Form Basic Info </h3>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" required id="title" name="title" aria-describedby="emailHelp"
                            value="<?php echo $title_from_previous_form ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Form Slug</label>
                            <input type="text" name="slug" id="slug" required class="form-control" value="<?php echo $formSlug_from_previous_form ?>"
                            <small id="emailHelp" class="form-text text-muted">Avoid Using reserved terms like: form,
                                order and vendor.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Form URL</label>
                            <input type="text" readonly="true" class="form-control" required id="url" name="url" aria-describedby="emailHelp"
                               value="<?php echo $formURL ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Business Location</label>
                            <input type="text" class="form-control" required id="location" name="location"
                                aria-describedby="emailHelp" value="<?php echo $businessLocation_from_previous_form ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Whatsapp to</label>
                            <input type="number" readonly="true" class="form-control" required id="whatsappNumber" name="whatsappNumber"
                                aria-describedby="emailHelp" value="<?php echo $WhatsappNumber ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Featured Image</label>
                            <small id="emailHelp" class="form-text text-muted">Image that will appear when shared on
                                social media.Please use JPG format file with size of 150kb</small>
                            <input type="file" accept="image/png, image/gif, image/jpeg, image/jpg, image/svg"  required name="featuredImg" id="featuredImg" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Catagory</label>
                            <input type="text" required class="form-control" id="product_title" name="product_title"
                                aria-describedby="emailHelp" value="<?php echo $product_catagory_from_previous_form ?>">
                        </div>
                        <button type="submit" name="form_save" class="btn btn-primary mb-3">Submit</button>
                    </form>
                </div>

            </div>
        </div>
        </section>

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
<?php include('includes/footer.php') ?>;