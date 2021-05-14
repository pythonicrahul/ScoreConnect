<?php
    include("connection.php");
    $query = "SELECT * FROM section";
    $query_setion = mysqli_query($conn,$query);

?>

<div class="">
    <form action="addstudent.php" method="post">
        <br><br>
        <div class="form-group">
            <select name="section" class="form-control">
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
        <div class="form-group">
            <button class="btn btn-warning" type="submit">Submit</button>
        </div>

    </form>
</div>

