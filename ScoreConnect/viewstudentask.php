<?php
include("connection.php");
$query = "SELECT * FROM section";
$query_setion = mysqli_query($conn,$query);

 ?>
<html>
    <head>
    </head>
    <body>
        <div class="">
            <form action="viewstudent.php" method="post">
                <br><br><br>
                <div class="form-group">
                    <label for="standard"> Standard with Section </label>
                    <select class="form-control" name="standard" id="standard" >        
                        <?php
                            while($result = mysqli_fetch_assoc($query_setion)){
                                $sno = $result["Standard"];
                                $query2 = "SELECT * FROM Standards WHERE Sno='$sno'";
                                $standard_q = mysqli_query($conn, $query2);
                                $standard = mysqli_fetch_assoc($standard_q);
                                echo "<option value='".$result['Sno']."'>".$standard['Standard'] . " ". "Section" .$result['Section']."</option>";
                            }
                        ?>   
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-info form-control" name="viewbtn"> View </button> 
                </div>
            </form>
        </div>
    </body>
</html>