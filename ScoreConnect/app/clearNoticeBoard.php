<?php
    //Registering the user by giving post request
    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['password_clear'])){
            $db = new DbOperation;
            $result = $db->clearNoticeBoard($_POST['password_clear']);
            if($result){
                $response['error'] = false;
                $response['Message'] = "Successfully added Notice :)";
            }
            else{
                $response['error'] = true;
                $response['Message'] = "Page Not Found";   
            }
        }
        else{
            $response['error'] = true;
            $response['Message'] = "Page Not Found";
        }
    }
    else
    {
        $response['error'] = true;
        $response['Message'] = "Page Not Found";
    }    
	
	echo json_encode($response);
 ?>