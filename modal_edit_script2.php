<?php

require('db.php');

$query    = "UPDATE users SET email = '" . $_POST['email'] . "', nic = '" . $_POST['nic'] . "', 
blood_group = '" . $_POST['blood_group'] . "', gender = '" . $_POST['gender'] . "', 
address = '" . $_POST['address'] . "', date_of_birth = '" . $_POST['dob'] . "' 
WHERE username = '" . $_POST['telNo'] . "';";
$result   = mysqli_query($con, $query);
header("Location: user_management.php");
