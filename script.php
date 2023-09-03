<?php

require('db.php');

    $query="SELECT available_date FROM doctors where id = '" . $_GET['d_id'] . "' ";
    $result = mysqli_query($con, $query) or die($mysqli->error());

    while($row = $result->fetch_assoc()) {
        echo  $row["available_date"];
      }
   
?>