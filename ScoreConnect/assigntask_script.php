<?php 
include("connection.php");
    if(isset($_POST['taskbtn'])){
        $task = $_POST['task'];
        $teacher_sno = $_POST['teacher'];

        $query = "INSERT INTO `task` (`Sno`, `Task`, `Teacher_sno`, `Date`) VALUES (NULL, '$task', '$teacher_sno', CURDATE());";   
        $inser_q = mysqli_query($conn,$query);
        if($inser_q){
            header("location:dashboard.html");
        }
        else{
            echo "False";
        }
    }
?>