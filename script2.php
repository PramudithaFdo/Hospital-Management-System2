<?php

require('db.php');

    $query="SELECT time_from, time_to FROM doctors where id = '" . $_GET['d_id'] . "' ";
    $result = mysqli_query($con, $query) or die($mysqli->error());
    
    while($row = $result->fetch_assoc()) {
      echo "From : " . $row["time_from"]. " - To : " . $row["time_to"]. "";
      }
   
?>