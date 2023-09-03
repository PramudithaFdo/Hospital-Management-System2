<?php

require('db.php');

$query    = "UPDATE doctors SET name = '" . $_POST['m_name'] . "', specialization = '" . $_POST['m_specialization'] . "', 
time_from = '" . $_POST['m_avl_time_from'] . "', time_to = '" . $_POST['m_avl_time_to'] . "', 
available_date = '" . $_POST['m_avl_dates'] . "' 
WHERE name = '" . $_POST['m_name'] . "';";
$result   = mysqli_query($con, $query);
header("Location: doctor_management.php");
