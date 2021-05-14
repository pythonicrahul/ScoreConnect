<?php

    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['section_sno'])){
            $db = new DbOperation;
            $Students = $db->getStudentsBySectionSno($_POST['section_sno']);
            $response = $Students;
        }
        else{
            $response['Error'] = true;
            $response['Message'] = "All fields are mandatory";
        }

    }
    else
    {
        $response['Error'] = true;
        $response['Message'] = "Only App can be used to access the database";
    }    
    echo json_encode($response);
 ?>