<?php
$servername = "localhost";
$username = "id17787563_orderla";
$password = "dqN6!(XfL)/^dDJy";
$database = "id17787563_dbuser";

//Create a Connection
$conn = mysqli_connect($servername, $username, $password,$database);
if(!$conn){
    die("Sorry we failed to connect: ".mysqli_connect_error());
}

?>