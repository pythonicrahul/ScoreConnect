<?php

    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['sec_sno']) and isset($_POST['exam_sno']) and isset($_POST['subject_sno'])){
            $db = new DbOperation;
            $task = $db->checkAllMarks($_POST['sec_sno'], $_POST['exam_sno'], $_POST['subject_sno']);
            if($task){
                $response['Message'] = "Data has been submitted Sucessfully";
            }
            else{
                $response['Message'] = "Enter Marks of all Student to submit Data";
            }
        }
        else{
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