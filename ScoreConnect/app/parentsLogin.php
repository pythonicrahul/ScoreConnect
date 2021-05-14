<?php

    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['phone']) and isset($_POST['password'])){
            $db = new DbOperation;
            if($db->parentLogin($_POST['phone'], $_POST['password'])){
                $user = $db->getStudentByParentNumber($_POST['phone']);
                $response['error'] = false;
                $response['student_name'] = $user['fname'];
                $response['parent_name'] = $user['p_name'];
                $response['sec_sno'] = $user['Section_sno'];
                $response['rollno'] = $user['rollno'];
                $response['Sno'] = $user['Sno'];
            }else{
                $response['error'] = true;
                $response['message'] = "Invalid Username and Password";   
            }
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