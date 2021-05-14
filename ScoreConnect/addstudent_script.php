<?php 
include("connection.php");
if(isset($_POST['addbtn'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $p_name=  $_POST['p_name'];
    $rollno = $_POST['rollno'];
    $password = $fname.$rollno;
    $sec_sno = $_POST['sec_sno'];

    $query = "INSERT INTO student (Section_sno,rollno,fname,mname,lname,gender,p_phone,p_password,p_name) VALUES ('$sec_sno','$rollno','$fname','$mname','$lname','$gender','$phone','$password','$p_name')";
    $insert_q = mysqli_query($conn,$query);
    if($insert_q){
        header("location: addstudentask.php");
    }else{
        echo "Error";
    }

}
?>
