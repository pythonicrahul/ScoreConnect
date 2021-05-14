<?php 
    include("connection.php");
?>
<html>
    <head>      
        <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet">      
        <style>
            .input:focus {
                color:white;
            }
            .dec { 
                    background: url(images/virtual_board.png) no-repeat center center fixed; 
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                    font-family: 'Comic Neue', cursive;
                    color:white;
                 }          
        </style>  
    </head>
    <body>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2> Virtul Notice Board</h2>
        </div>
        <div class="">
        
            <form action="virtualnotice_script.php" method="post">
                <div class="form-group">
                    <textarea name="notice" rows="15" class="form-control dec input"> </textarea> 
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Enter your position" name="writer" class="form-control"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" name="putbtn" type="submit"> Write </button>
                </div>
            </form>
        </div>
    </body>
</html>
