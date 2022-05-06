<?php
session_start();
if($_SESSION['gotocart'])
{
    $key=$_GET['id'];
    $arr=$_SESSION['arr'];
    unset($arr[$key]);
    $_SESSION['arr']=$arr;
    header("location: Cart.php");
    exit;
}
 ?>