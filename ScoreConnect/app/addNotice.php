<?php
    //Registering the user by giving post request
    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['notice']) and isset($_POST['teacher_sno'])){
            $db = new DbOperation;
            $result = $db->addNotice($_POST['notice'],$_POST['teacher_sno']);

            if($result){
                $response['error'] = false;
                $response['Message'] = "Successfully added Notice :)";
            }
            else{
                $response['error'] = true;
                $response['Message'] = "Contact at rjsoft4186@gmail.com";   
            }
        }
        else{
            $response['error'] = true;
            $response['Message'] = "All fields are mandatory";
        }

    }
    else
    {
        $response['error'] = true;
        $response['Message'] = "Only App can be used to access the database";
    }    
	
	echo json_encode($response);
 ?>