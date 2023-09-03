<?php

require('db.php');

$query = "UPDATE appointments SET d_cancel = '1' where id = '" . $_POST['id'] . "';";
$result   = mysqli_query($con, $query);
