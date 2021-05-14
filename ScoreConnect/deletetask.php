<?php
include("connection.php");
$query = "delete from task
where datediff(now(), task.Date) > 3;";
$task = mysqli_query($conn,$query);
if($task){
    echo "True";
}
else{
    echo "False";
}
 ?>