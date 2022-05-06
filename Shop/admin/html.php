<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    require('db/conn.php');
    $title = $_POST['name'];
    $slug = $_POST['slug'];
    $url = $_POST['url'];
    $location = $_POST['location'];
    $whatsappNo = $_POST['whatsappNumber'];
    $featuredImg = $_FILES['featuredImg']['name'];
    $product_title = $_POST['product_title'];
    $productImg1 = $_FILES['productImg1']['name'];
    $productImg2 =  $_FILES['productImg2']['name'];
    $product_details = $_POST['product_details'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $prodcut_promo = $_POST['product_promo'];
    $product_limit = $_POST['product_limit'];
    $product_weight = $_POST['product_weight'];

    $query = "INSERT INTO `products` (`Title`, `Slug`, `Url`, `Location`, `WhatsappNo`, `FeaturedImage`, `ProductTitle`, `ProductImage1`, `ProductImage2`, `ProductDetails`, `Product_Name`, `Product_Description`, `Product_Price`, `Product_Promo`, `Product_Limit`, `Product_Weight`, `Date`) VALUES ('$title', '$slug', '$url', '$locaiton', '$whatsappNo', '$featuredImg', '$product_title', '$productImg1', ' $productImg2', '$product_details', '$product_name', '$product_description', '$product_price', '$prodcut_promo', '$product_limit', '$product_weight', CURRENT_TIMESTAMP)";
    $result = mysqli_query($conn,$query);
    echo var_dump($result);
    if($result){
       echo"Hello";
    }
    else {
        echo mysqli_error($conn,$result);
    }
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


    <title>Hello, world!</title>
</head>

<body>
    <?php require('partials/nav.php') ?>
    <div class="container-fluid mt-5">
        <div class="row"></div>
        <div class="col-md-9 register-right">

        <form method="POST" action="/vr1/admin/html.php" enctype="multipart/form-data">
                        <h3>Form Basic Info </h3>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" required id="title" name="title" aria-describedby="emailHelp"
                                placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Form Slug</label>
                            <input type="text" name="slug" id="slug" required class="form-control" placeholder="Enter Slug">
                            <small id="emailHelp" class="form-text text-muted">Avoid Using reserved terms like: form,
                                order and vendor.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Form URL</label>
                            <input type="text" class="form-control" required id="url" name="url" aria-describedby="emailHelp"
                                placeholder="Enter url">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Business Location</label>
                            <input type="text" class="form-control" required id="location" name="location"
                                aria-describedby="emailHelp" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Whatsapp to</label>
                            <input type="number" class="form-control" required id="whatsappNumber" name="whatsappNumber"
                                aria-describedby="emailHelp" placeholder="Enter whatsapp number">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Featured Image</label>
                            <small id="emailHelp" class="form-text text-muted">Image that will appear when shared on
                                social media.Please use JPG format file with size of 150kb</small>
                            <input type="file" required name="featuredImg" id="featuredImg" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Title</label>
                            <input type="text" required class="form-control" id="product_title" name="product_title"
                                aria-describedby="emailHelp" placeholder="Enter Product Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Product Image1</label>
                            <input type="file" required class="form-control-file" name="productImg1" id="productImg1">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Product Image2</label>
                            <input type="file" class="form-control-file" name="productImg2" id="productImg2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Product Details</label>
                            <textarea class="form-control" required id="product_details" name="product_details"
                                rows="3"></textarea>
                        </div>
                        <h3>Product Info </h3>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <hr>
                        <h2>Single Product</h2>
                        <div class="container-fluid mx-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlEmail1">Price</label>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">RM</span>
                                            </div>
                                            <input type="text" class="form-control col-sm-5"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlEmail1">Promo</label>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">RM</span>
                                            </div>
                                            <input type="text" class="form-control col-sm-5"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlEmail1">Limit</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control col-sm-7"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlEmail1">Weight</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control col-sm-5"
                                                aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

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