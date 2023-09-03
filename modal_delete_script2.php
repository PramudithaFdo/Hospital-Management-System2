<?php

require('db.php');

$query    = "DELETE FROM users WHERE id = '" . $_POST['id'] . "';";
$result   = mysqli_query($con, $query);
