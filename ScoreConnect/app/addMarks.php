<?php
    //Registering the user by giving post request
    require_once 'include/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(
            isset($_POST['sec_sno']) and 
            isset($_POST['rollno']) and
            isset($_POST['exam_sno']) and
            isset($_POST['subject_sno']) and
            isset($_POST['marks'])
          ){
            $db = new DbOperation;
            $result = $db->addMarks($_POST['sec_sno'], $_POST['rollno'], $_POST['exam_sno'], $_POST['subject_sno'], $_POST['marks']);
            if($result){
                $response['error'] = false;
                $response['Message'] = "Successfully added Marks :)";
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