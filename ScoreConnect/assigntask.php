<?php 
    include("connection.php");
?>
<html>
    <head>      
        <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet">      
        
    </head>
    <body>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2> Assign Task To Teachers </h2>
        </div>
        <div class="">
        
            <form action="assigntask_script.php" method="post">
                <div class="form-group">
                    <textarea name="task" rows="10" class="form-control"> </textarea> 
                </div>
                <div class="form-group">
                    <select class="form-control" name="teacher" >
                        <option selected disabled> Select Teachers </option>
                        <option value=0 > All Teachers </option>
                        <?php 
                            $query = "SELECT * FROM teachers";
                            $teacher_q = mysqli_query($conn,$query);
                            while($result = mysqli_fetch_assoc($teacher_q)){
                                echo "<option value=".$result['Sno']."> ".$result['Name']." </option>";
                            }

                        ?>
                    </select>
                </div>

                <div class="form-group text-center ">
                    <button class="btn btn-success w-100" name="taskbtn" type="submit"> Assign Task </button>
                </div>
            </form>

        </div>
    </body>
</html>
