<?php
session_start();
include 'db/conn.php';
$productID=$_GET['id'];
$userID=$_GET['userID'];
$query="select name, price from product where id='$productID'";
$result=mysqli_query($conn,$query);

if(!$result)
{
    header("location:page.php?id=$userID");
    exit;
}
$res=mysqli_fetch_array($result);
$oneproduct=array();
array_push($oneproduct,$res['name']);
array_push($oneproduct,$res['price']);

array_push($_SESSION['arr'],$oneproduct);
header("location:page.php?id=$userID");
exit;

?>

