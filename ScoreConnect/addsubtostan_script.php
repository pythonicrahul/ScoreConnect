<?php
include("connection.php");
if(isset($_POST['submitbtn'])){
  $Standard_sno = $_POST['sno_imp'];
  $subject_sno = $_POST['Subject'];

  $query = "SELECT * FROM Standards Where Sno='$Standard_sno'";
  $Standard_q = mysqli_query($conn,$query);
  $Standard = mysqli_fetch_assoc($Standard_q);

  $subjects = $Standard['Subjects'];
  $subjects = $subjects . ',' . $subject_sno;
  $query_update = "UPDATE standards set subjects='$subjects' where Sno=$Standard_sno";
  $data = mysqli_query($conn,$query_update);
  if($data){

  }
  else{
    echo "Error";
  }
}
?>
