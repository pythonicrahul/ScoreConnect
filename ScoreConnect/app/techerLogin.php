<?php
    //Registering the user by giving post request
    require_once 'include/DbOperation.php';
    

    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['email']) and isset($_POST['password'])){
            $db = new DbOperation;
            if($db->teacherLogin($_POST['email'], $_POST['password'])){
                $user = $db->getUserByEmail($_POST['email']);
                $response['error'] = false;
                $response['name'] = $user['Name'];
                $response['email'] = $user['Email'];
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