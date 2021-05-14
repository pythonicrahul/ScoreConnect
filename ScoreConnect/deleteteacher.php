<?php
    include 'connection.php';
    $var = $_GET['Sno'];
    $query = "DELETE FROM teachers WHERE Sno=$var";
    $data = mysqli_query($conn, $query);
    header("Location: dashboard.html");
?>