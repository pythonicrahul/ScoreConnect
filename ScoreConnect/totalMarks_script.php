<?php
include("connection.php");

if(isset($_POST['pri-btn'])){
        
        $mark1 = $_POST['firstunit'];
        $mark2 = $_POST['secondunit'];
        $mark3 = $_POST['firstterm'];
        $mark4 = $_POST['thirdunit'];
        $mark5 = $_POST['fourthunit'];
        $mark6 = $_POST['secondterm'];

        $query = "INSERT INTO totalMarks (Sno, division_sno, exams_sno, totalMark) VALUES ( null,'1','1','$mark1'),( null,'1','2','$mark2'),( null,'1','3','$mark3'),( null,'1','4','$mark4'),( null,'1','5','$mark5'),( null,'1','6','$mark6') ";

        $result = mysqli_query($conn,$query);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }
 ?>

<?php
include("connection.php");

    if(isset($_POST['sec-btn'])){
        
        $mark1 = $_POST['firstunit'];
        $mark2 = $_POST['secondunit'];
        $mark3 = $_POST['firstterm'];
        $mark4 = $_POST['thirdunit'];
        $mark5 = $_POST['fourthunit'];
        $mark6 = $_POST['secondterm'];

        $query = "INSERT INTO totalMarks (Sno, division_sno, exams_sno, totalMark) VALUES ( null,'2','1','$mark1'),( null,'2','2','$mark2'),( null,'2','3','$mark3'),( null,'2','4','$mark4'),( null,'2','5','$mark5'),( null,'2','6','$mark6') ";

        $result = mysqli_query($conn,$query);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }
 ?>

<?php
include("connection.php");

    if(isset($_POST['high-btn'])){
        
        $mark1 = $_POST['firstunit'];
        $mark2 = $_POST['secondunit'];
        $mark3 = $_POST['firstterm'];
        $mark4 = $_POST['thirdunit'];
        $mark5 = $_POST['fourthunit'];
        $mark6 = $_POST['secondterm'];

        $query = "INSERT INTO totalMarks (Sno, division_sno, exams_sno, totalMark) VALUES ( null,'3','1','$mark1'),( null,'3','2','$mark2'),( null,'3','3','$mark3'),( null,'3','4','$mark4'),( null,'3','5','$mark5'),( null,'3','6','$mark6') ";

        $result = mysqli_query($conn,$query);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }
 ?>