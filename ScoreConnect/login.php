<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js"></script>   
    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-storage.js"></script>
    <title>Blog App </title>
    <style>
        .dec { 
                background: url(images/login_page_background.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        
    </style>
  </head>
  <body >
    <div class="container-fluid dec">
        <br><br><br><br><br><br>
        <div class="container p-3">
            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                <div class="col-sm-4" style="background-color: white; padding-top: 20px; padding-bottom: 10px;">
                    <img src="images/login_page_main.jpg" class="img-fluid">
                </div>
                <div class="col-sm-4" style="background-color: white;padding-top: 20px; padding-bottom: 10px;">        
                    <form action="dashboard.html" method="post">
                        <h3 class="text-center">Login</h3>
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10">
                                    <input id="email" type="email" class="form-control" placeholder="Enter your email " />
                                </div>
                                <div class="col-sm-2">
                                    <i class="zmdi zmdi-email"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control" placeholder="Enter your password" />
                                </div>
                                <div class="col-sm-2">
                                    <i class="zmdi zmdi-lock"></i>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button id="btn-login" type="submit" class="btn w-100 btn-primary" type="button">Login <i class="zmdi zmdi-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <br><br><br><br>
    </div>
  </body>
</html>