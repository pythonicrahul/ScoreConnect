<?php
include("connection.php");
if(isset($_POST['putbtn'])){

    $notice = $_POST['notice'];
    $writer = $_POST['writer'];
    // $query = "INSERT INTO notice (Notice,Writer) VALUES('$notice','$writer') ";
    $query = "INSERT INTO `notice` (`Sno`, `Notice`, `TIME`, `Writer`) VALUES (NULL, '$notice', CURRENT_TIMESTAMP, '$writer')";
    $insert_q = mysqli_query($conn,$query);
    header("location:add.php");

}
 ?>