<?php 
session_start();
include 'db/conn.php';
$userID=$_GET['id'];
$query="select Name,WhatsAppNumber,Email,location from users where id='$userID'";
$result1=mysqli_query($conn,$query);
$res1=mysqli_fetch_array($result1);
$email=$res1['Email'];
 
if(!isset($_SESSION['arr']))
{
  $_SESSION['arr']=array();
}
if(isset($_POST['cartGo']))
{   $query="select WhatsAppNumber from users where id='$userID'";
    $resultwp=mysqli_query($conn,$query);
    $reswp=mysqli_fetch_array($resultwp);
    $_SESSION['wp']=$reswp['WhatsAppNumber'];
    $_SESSION['gotocart']=true;
    $_SESSION['customer_name']=$_POST['my_id'];
    $_SESSION['customer_notes']=$_POST['customer_notes'];
   header("location: Cart.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
   

    <nav class="navbar theme-bg-default">
        <div style="display:flex;justify-content:center;align-items:center;overflow: hidden;">
            <img src="image/whatsapp-logo.svg" height="30" class="d-inline-block" alt="WhatsApp Logo"
                data-toggle="modal" data-target="#qrCodeModal" style="cursor: pointer">
            <div style="width:10px;"></div>
            <span style="width:500px;color:rgba(255,255,255,0.5);margin-top:2px;cursor: pointer;" data-toggle="modal"
                data-target="#qrCodeModal"> Order Form</span>
        </div>
        <a href="../../index.html"><button style="position: absolute; top:9px;right:6px;" class="btn btn-outline-light">Dukan</button></a>
    </nav>
    <div class="container mb-4">
        <div class="row">
            <div class="col-lg-8 mx-auto py-0 py-md-2">
                <div class="card ">
                    <div class="card-body" style="padding:14px;">

                        <div style="height:3px;"></div>

                        <img class="float-right" width="40px" height="40px" src="image/share-solid.svg" id="shareBtn"
                            style="cursor: pointer;padding-right:0px;padding-top:0px;">
                        <center>
                            <h2 style="font-weight:600;font-size:27px;padding-left:26px;padding-right:26px;">
                                <?php echo $res1['Name'] ?>
                            </h2>
                            <h5 style="font-size:20px;padding-left:26px;padding-right:26px;">
                               <?php echo $res1['WhatsAppNumber'] ?>
                            </h5>
                            <h6 style="font-size:20px;padding-left:26px;padding-right:26px;">
                               <?php echo $res1['location'] ?>
                            </h6>
                        </center>
                        <hr>
                        <?php 
                         $query="select productCatagory,imgDir from form where email='$email'"; 
                         $result1=mysqli_query($conn,$query);
                        
                          $number_of_forms=mysqli_num_rows($result1);
                         
                        
                        for($i=1;$i<=$number_of_forms;$i++) {
                            $res1=mysqli_fetch_array($result1);

                         
                          $img= $res1['imgDir'];
                         
                          
                            ?>
                        <p align="center"><img src="<?php echo $img ?>" class="img-fluid"><br></p>
                        <p align="center"> <?php echo $res1['productCatagory']?><br></p>   
                           <?php  }?>
                        <p>All Products<br></p>

                    </div>
                    <div class="card mt-2">
                        <div class="card-body" style="padding: 12px;"><strong
                                style="font-size: 13px; color: grey;">Please select item(s) you want to order and fill
                                in your details below.</strong>
                            <hr>
                            <h4 style="font-size: 14px; color: grey;"><strong>1. SELECT ITEMS</strong></h4>
                            <div class="nav-scroller sticky" id="SectionNavID">
                                <ul class="nav__inner">
                                    <?php 
                                     $query="select productCatagory from form where email='$email'"; 
                                     $result2=mysqli_query($conn,$query);
                                    $number_of_forms=mysqli_num_rows($result2);
                                  for($i=1;$i<=$number_of_forms;$i++) {
                                  $res2=mysqli_fetch_array($result2);
                            ?>
                                    <li class="" id="li-section-1"><a href="#section-1"
                                            class="nav-link theme-color-default" style="font-weight: 700;">
                                          <?php echo $res2['productCatagory']?></a></li>
                                            <?php }?>
                                </ul>
                            </div>
                            <div style="height: 10px;"></div>
                                   <table class="table " style="width: 100%;">
                                <tbody>
                                    <section id="section-1" style="color: white; margin-top: -49px;">.</section>
                                    <div style="height: 25px;"></div>
                                    <?php 
                                     $query="select productCatagory,id from form where email='$email'"; 
                                     $result3=mysqli_query($conn,$query);
                                    $number_of_forms=mysqli_num_rows($result2);
                                    echo $number_of_forms ;
                                  for($i=1;$i<=$number_of_forms;$i++) {  
                                       
                                  $res3=mysqli_fetch_array($result3);
                                 
                                    ?>
                                    <tr>
                                        <td colspan="3" style="padding: 6px 0px;"><strong style="font-size: 17px;"><?php echo $res3['productCatagory']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="padding: 6px 0px;">
                                            <div style="display: flex; flex-direction: row;">
                                                <div style="flex: 1 1 0%; margin-top: -4px;">
                                                    <div id="a4297e20-8abb-4f8d-ac0b-f618c97342d7"
                                                        style="display: block; visibility: hidden; position: absolute; margin-top: -50px; width: 1px;">
                                                    </div><a
                                                        href="#product/a4297e20-8abb-4f8d-ac0b-f618c97342d7">
                                                         <?php
                                                         $formID=$res3['id']; 
                                                            $query="select id,name,price,promo,productlimit from product where formID='$formID'"; 
                                                            $result4=mysqli_query($conn,$query);
                                                            $number_of_products=mysqli_num_rows($result4);
                                                          for($j=1;$j<=$number_of_products;$j++) {
                                                          $res4=mysqli_fetch_array($result4);
                                                          ?> 
                                                        <strong
                                                            style="font-size: 15px; color: black;">
                                                            <?php echo $res4['name'] ?>
                                                        </strong></a><br>
                                                    <div
                                                        style="display: flex; justify-content: space-between; flex-direction: row; margin-top: 12px;">
                                                        <div><span style="font-size: 12px; color: gray;">LIMIT:
                                                                <?php echo $res4['productlimit']?></span>
                                                            <div style="margin-bottom: -5px;"></div><span
                                                                style="text-align: left; font-size: 15px; font-weight: 600;">RM : <?php echo $res4['price'] ?></span>
                                                             <div style="margin-bottom: -5px;"></div><del style="font-size: 12px; color: grey;">RM : <?php echo $res4['promo'] ?></del>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div width="120px"
                                                            style="display: flex; justify-content: flex-end; flex-direction: row; padding: 6px;">
                                                            
                                                            <button name="decqty" class="btn float-right text-white disabled theme-bg-default"
                                                                style="height: 40px;cursor:pointer;" > <a  style="color:white;"href="/vr1/admin/addToCart.php?id=<?php echo $res4['id'] ?>&userID=<?php echo $userID ?>">Add To Cart </a> </button>
                                                                
                                                               </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                            
                            <?php  }?>  
          <form method ="POST" action="/vr1/admin/page.php?id=<?php echo $userID ?>">              
            <section id="user-details">
                <hr>
                <div name="refCustomerDetails"></div>
                <h4 style="font-size: 14px; color: grey;"><strong>2. CUSTOMER DETAILS</strong></h4>
                <hr>
              
                <div class="form-group"><label class="control-label">
                        <h6 style="color: black; font-weight: bold;">Name</h6>
                    </label><span style="color: red; font-size: 14px;">*</span>
                    <input class="form-control  undefined" name="my_id"
                            autocapitalize="on" autocorrect="off" type="text" value="">
                </div>
                <div class="form-group"><label for="phone_no_office" class="control-label">
                        <h6 style="color: black; font-weight: bold;">Notes</h6>
                    </label><span style="color: red; font-size: 17px;">*</span><textarea class="form-control "
                        name="customer_notes" type="text" rows="4" placeholder="Saiz Baju" style="margin-top: -10px;"></textarea>
                </div>
               

            </section>
            <button name="cartGo">
                            <div class="container-fluid"
                                style="position: fixed; bottom: 0px; left: 0px; right: 0px; width: 100%; background: white; height: 65px; border-top: 1px solid rgb(232, 232, 232); box-shadow: rgba(0, 0, 0, 0.13) 0px -6px 28px 0px; overflow: hidden; z-index: 500;">
                                <div class="container form-group">
                                    <div class="row">
                                        <div class="col-lg-8 mx-auto"><a
                                                class="btn btn-lg btn-block disabled theme-bg-default"
                                                style="color: white; margin-top: 7px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <div><i class="fas fa-shopping-cart"></i>
                                                        <div style="position: absolute; bottom: -15px; width: 38px;">
                                                            <p class="theme-color-default"
                                                                style="padding-left: 1px; padding-bottom: 9px; padding-right: 10px; font-size: 13px; text-align: center;">
                                                                </p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="display: flex; justify-content: center; align-items: center;">
                                                        <span style="font-size: 16px; name">Proceed To Cart<i
                                                                class="fas fa-angle-right mr-1"
                                                                style="margin-left: 3px; margin-bottom: -15px;"></i></span>
                                                    </div>
                                                    <div>
                                                        <div
                                                            style="position: absolute; top: 20px; width: 110px; margin-left: -100px;">
                                                            <p class="d-none d-md-none d-md-block"
                                                                style="font-size: 16px; text-align: right; margin-right: 6px;">
                                                                Items In Cart  <?php $arr=$_SESSION['arr'];
                                                                echo sizeof($arr)?></p>
                                                            <p class="d-block d-md-none d-md-none"
                                                                style="font-weight: bold; font-size: 12px; text-align: right; margin-top: 3px;">Items In Cart
                                                                </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a></div>
                                    </div></button>
                                    </form>        
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