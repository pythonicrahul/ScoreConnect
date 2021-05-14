<?php
    include("connection.php");
 ?>
<div>
    <h2> Add A Teacher </h2>
    <form action="addteacher.php" method="POST" >
        <div class="form-group">
            <label for="name">Name : </label>
            <input type="text" name="name" id="name" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="email">Email : </label>
            <input type="text" name="email" id="email" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="phone">Phone : </label>
            <input type="text" name="phone" id="phone" class="form-control"/>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn btn-success" name="submit"> Add Teacher</button>
        </div>
    </form>

</div>
<?php
    if(isset($_POST['submit']))
    {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = "teachpass";

    if($name!="" && $email!="" && $phone!="")
    {
        $query ="INSERT INTO teachers (Name,Email,Password,Phone) VALUES('$name','$email','$password','$phone')";
        $data = mysqli_query($conn,$query);
        if($data){
            header('location:cards.html');
        }else{
            $error = "Server error";
            echo "<script type ='text/javascript'> alert('$error'); </script>";
        }

    }
    else{
        $error = "All fields are mandatory";
        echo "<script type ='text/javascript'> alert('$error'); </script>";
    }
    }
?>