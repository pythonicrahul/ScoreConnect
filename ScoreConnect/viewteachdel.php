<?php 
include("connection.php");
$teach_sno = $_GET['Sno'];
$query = "DELETE FROM teaches WHERE Sno=$teach_sno";
$data = mysqli_query($conn, $query);
header("Location: dashboard.html");
?>