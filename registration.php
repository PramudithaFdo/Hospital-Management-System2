<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-image: url('img/admin_form_bg.jpg'); background-repeat: no-repeat;">
    <?php
    include("auth_session.php");  //need to uncomment 
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $name = stripslashes($_REQUEST['name']);
        $nic = stripslashes($_REQUEST['nic']);
        $blood_group = stripslashes($_REQUEST['blood_group']);
        $gender = stripslashes($_REQUEST['gender']);
        $address = stripslashes($_REQUEST['address']);
        $date_of_birth = stripslashes($_REQUEST['date_of_birth']);
        $user_type = stripslashes($_REQUEST['user_type']);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, name, nic, blood_group, gender, address, date_of_birth, 
        user_type, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$name', '$nic', '$blood_group', '$gender', 
                     '$address', '$date_of_birth', '$user_type', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            header("Location: registration.php");
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>


        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                            <li>
                                <a href="dashboard_admin.php" class="nav-link px-0 align-middle">
                                    <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="doctor_management.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Doctor Management</span></a>
                                    </li>
                                    <li>
                                        <a href="user_management.php" class="nav-link px-0"> <span class="d-none d-sm-inline">User Management</span></a>
                                    </li>
                                    <li>
                                        <a href="appointment_history_admin.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Appointment History</span></a>
                                    </li>
                                    <li>
                                        <a href="registration.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Register Users</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="img/user.png" width="30" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['email']; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <form class="form_register" action="" method="post">
                        <h1 class="login-title">Registration</h1>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="username" placeholder="Mobile No. (Username)" required />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-6">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="nic" placeholder="NIC" required>
                            </div>
                            <div class="col-6">
                                <select class="form-select" name="blood_group">
                                    <option value="A+">A+</option>
                                    <option value="A-">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-check col-6">
                                <input type="radio" class="form-check-input" id="gender1" name="gender" value="male">Male
                                <label class="form-check-label" for="radio1"></label>
                            </div>
                            <div class="form-check col-6">
                                <input type="radio" class="form-check-input" id="gender2" name="gender" value="female">Female
                                <label class="form-check-label" for="radio2"></label>
                            </div>
                        </div>
                        <br>
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                        <br>
                        <input type="date" class="form-control" name="date_of_birth" placeholder="DOB" required>
                        <br>
                        <select class="form-select" id="user_type" name="user_type" required>
                            <option value="">---- Select User Type ----</option>
                            <?php
                            $query2 = "SELECT id, user_type FROM user_type";
                            $result2 = $con->query($query2);
                            if ($result2->num_rows > 0) {
                                while ($optionData = $result2->fetch_assoc()) {
                                    $name = $optionData['user_type'];
                                    $id = $optionData['id'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?> </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" name="submit" value="Register" class="login-button">
                    </form>

                </div>
            </div>
        </div>

    <?php
    }
    ?>
</body>

</html>