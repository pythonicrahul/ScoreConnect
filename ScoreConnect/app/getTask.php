<?php

    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['teacher_sno'])){
            $db = new DbOperation;
            $task = $db->getTaskByTeacherSno($_POST['teacher_sno']);
            $response = $task;
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