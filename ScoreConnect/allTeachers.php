<?php
    include("connection.php");
    $query1 = ("SELECT * FROM Teachers");
    $Teachers = mysqli_query($conn,$query1);
?>
<html>
    <head>
        <title>Hello Bhai</title>
    </head>
    <body>
            <a onclick="switchView('addteacher.php')"><button class="btn  btn-success">Add Teachers</button></a>
            <br>
            <table class="table text-dark mt-3">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($result = mysqli_fetch_assoc($Teachers))
                        {
                                echo '<tr>
                                    <td>'.$result["Sno"].'</td>  
                                    <td>'.$result["Name"].'</td>  
                                    <td>'.$result["Email"].'</td>  
                                    <td>'.$result["Phone"].'</td>  
                                    <td><a href="deleteteacher.php?Sno='.$result["Sno"].'"><button class="btn btn-danger">Delete</button></a></td>
                                    </tr>
                                ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>

</html>