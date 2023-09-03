<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-image: url('img/login_side.png'); background-repeat: no-repeat;">
    <?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE email='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die($mysqli->error());
        $row = $result->fetch_assoc();
        $rows = mysqli_num_rows($result);
        if ($rows == 1 && $row['id'] == 1) {
            $_SESSION['email'] = $username;
            // Redirect to admin dashboard page
            header("Location: dashboard_admin.php");
        } else if ($rows == 1 && $row['user_type'] == 3) {
            $_SESSION['email'] = $username;
            // Redirect to patient dashboard page
            header("Location: dashboard_patient.php");
        } else if ($rows == 1 && $row['user_type'] == 2) {
            $_SESSION['email'] = $username;
            $_SESSION['id'] = $row['id'];
            // Redirect to doctor dashboard page
            header("Location: dashboard_doctor.php");
        } else {
            echo "<div class='form_dashboard'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form_login" method="post" name="login">
            <img src="img/login.png" width="150" height="150" class="rounded mx-auto d-block">
            <h1 class="login-title">Login</h1>
            <input type="text" required class="form-control" name="username" placeholder="Username" autofocus="true" />
            <br>
            <input type="password" required class="form-control" name="password" placeholder="Password" />
            <br>
            <input type="submit" value="Login" name="submit" class="form-control" />
        </form>
    <?php
    }
    ?>
</body>

</html>