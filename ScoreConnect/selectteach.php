<?php 
  include("connection.php");
  $query_section = "SELECT * FROM SECTION" ;
  $Sectiom_q = mysqli_query($conn,$query_section);

?>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Select Standard And Section</h1>
    </div>
      <div class="row">
        <div>
        <table class="table text-center text-dark mt-3">
          <thead>
            <tr>
                <th>Sno</th>
                <th>Standard</th>
                <th>Section</th>
                <th>View Asigned Teachers</th>
                <th>Asign All Subjects to Teachers</th>
                <th>Change Subject Teacher</th>

            </tr>
          </thead>
          <tbody>
            <?php
                while($result = mysqli_fetch_assoc($Sectiom_q))
                {
                  $stan_sno = $result["Standard"];
                  $query_stan = "SELECT * FROM Standards WHERE Sno='$stan_sno'";
                  $name_q = mysqli_query($conn,$query_stan);
                  $name = mysqli_fetch_assoc($name_q);
                  echo '<tr>
                        <td>'.$result["Sno"].'</td>  
                        <td>'.$name["Standard"].'</td>  
                        <b><td>'.$result["Section"].'</td></b>  
                        <td><a href="viewteach.php?Sno='.$result["Sno"].'"><button class="btn btn-info">-></button></a></td>
                        <td><a href="assignteach.php?Sno='.$result["Sno"].'"><button class="btn btn-primary">-></button></a></td>
                        <td><a href="changeteach.php?Sno='.$result["Sno"].'"><button class="btn btn-warning">-></button></a></td>
                        </tr>';
                }
            ?>
          </tbody>
        </table>
        </div>
      
      </div>  
    </div>
    
</div>