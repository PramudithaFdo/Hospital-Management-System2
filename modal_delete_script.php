<?php

require('db.php');

$query    = "DELETE FROM doctors WHERE id = '" . $_POST['id'] . "';";
$result   = mysqli_query($con, $query);
