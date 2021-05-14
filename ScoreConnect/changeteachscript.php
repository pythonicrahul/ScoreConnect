<?php 
    include("connection.php");
    if(isset($_POST['changebtn'])){
        $subject_sno = $_POST['subject'];
        $teacher_sno = $_POST['teacher'];
        $sec_sno = $_POST['sec_sno'];
        $query_check = "SELECT * FROM teaches WHERE sno_sec='$sec_sno' AND Subject='$subject_sno'";
        $check_q = mysqli_query($conn,$query_check);
        $total = mysqli_num_rows($check_q);
        if($total == 1){
            $query_update = "UPDATE teaches SET Teacher=$teacher_sno WHERE sno_sec='$sec_sno' AND Subject='$subject_sno'"; 
            $update_q = mysqli_query($conn,$query_update);
            header("location:dashboard.html");
        }
        else{
            $query_insert = "INSERT INTO teaches (sno_sec,Subject,Teacher) VALUES('$sec_sno', '$subject_sno', '$teacher_sno')";
            $inser_q = mysqli_query($conn,$query_insert);
            header("location:dashboard.html");
        }
    }
?>

