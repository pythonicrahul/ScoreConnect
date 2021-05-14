<?php 
    include "connection.php";
    $query = "SELECT * FROM notice";
    $notie_q = mysqli_query($conn,$query);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <title>Blog App </title>
    <style>
        body{   
                background: url(images/virtual_board.png) no-repeat center center fixed; 
            }
        *{
            font-family:comic sans ms;
            color:white;
        }
    </style>
  </head>
  <body class="dec">
    <div class="container-fluid dec">
        <u><h1 class="text-center"> Virtual Notice Board </h1></u>
    </div>
    <br><br>
    <?php 

        while($result = mysqli_fetch_assoc($notie_q)){
            
            echo "<h4 class='text-center'>".$result['Notice']." </h4>";
            echo "<h5 class='text-right mr-1'>".$result['Writer']." </h5>";
            echo "<h5 class='text-right mr-1'>".$result['TIME']." </h5>";
            echo "<hr>";
            echo "<br>";
            
        }

    ?>
  </body>
</html>