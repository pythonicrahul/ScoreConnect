<?php
$servername ="localhost";
$dbname = "scoreconnect";
$username = "root";
$password = "";

$conn = mysqli_connect("$servername","$username","$password","$dbname");

if($conn){

}else{
  echo "Error server is not responding :( ";
}

 ?>
