<?php 
    include("connection.php");
    $query = "SELECT * FROM Standards";
    $Standards = mysqli_query($conn,$query);

?>
<html>
    <head>
        <style>
            .waverj
            {
                padding: 10% 0;
            }
        </style>
    </head>
    <body>
        <h2>Select the Standard</h2>
        <form action="standardsub.php" method="post">
            <div class="waverj">
                <div class="from-group">
                    <select id="Standard" name="Standard" class="form-control mt-5">
                        <?php
                            while($result = mysqli_fetch_assoc($Standards))
                            {
                                echo "<option value='".$result['Sno']."'>".$result['Standard']."</option>";
                            }
                        ?>
                    </select>
                </div><br>
                <div class="from-group text-center">
                        <button class="btn btn-primary" name="submitbtn" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </body>
</html>

<?php 
    if(isset($_POST['submitbtn'])){
        echo $_POST['Standard'];
    }
?>