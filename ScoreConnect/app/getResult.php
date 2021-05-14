<?php 
    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['sec_sno']) and isset($_POST['rollno']) and isset($_POST['exam_sno']) ){
            $db = new DbOperation;
            $response = $db->getMarksByRollnoAndSecSno($_POST['sec_sno'], $_POST['rollno'], $_POST['exam_sno']);
        }
        else{
            $response['error'] = true;
            $response['Message'] = "All parameter are required";
        }
    }
    else{
        
    }
    echo json_encode($response);
?>