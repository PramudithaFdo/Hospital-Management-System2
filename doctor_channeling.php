<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Hospital Management System</title>
  <link rel="stylesheet" href="css/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body style="background-image: url('img/patient_form_bg.jpg'); background-repeat: no-repeat;">

  <?php
  //include auth_session.php file on all user panel pages
  include("auth_session.php");  //need to uncomment 
  require('db.php');
  // SQL query to select data from database
  $sql = "SELECT * FROM doctors ORDER BY id";
  $result = mysqli_query($con, $sql) or die($mysqli->error());
  if (isset($_REQUEST['app_no'])) {
    $app_no = stripslashes($_REQUEST['app_no']);
    $p_name = stripslashes($_REQUEST['p_name']);
    $d_id = stripslashes($_REQUEST['d_id']);
    $d_name = stripslashes($_REQUEST['hidden_doctor_name']);
    $avl_date = stripslashes($_REQUEST['avl_date']);
    $avl_time = stripslashes($_REQUEST['avl_time']);
    $reason = stripslashes($_REQUEST['reason']);
    $create_datetime = date("Y-m-d H:i:s");
    $query    = "INSERT into `appointments` (app_no, p_email, d_id, d_name, avl_date, avl_time, reason, create_datetime)
               VALUES ('$app_no', '$p_name', '$d_id', '$d_name', '$avl_date', '$avl_time', '$reason', '$create_datetime')";
    $result   = mysqli_query($con, $query);
    header("Location: doctor_channeling.php");
  } else {
  ?>

    <div class="container-fluid">
      <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
          <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

              <li>
                <a href="dashboard_patient.php" class="nav-link px-0 align-middle">
                  <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                  <li class="w-100">
                    <a href="doctor_availability.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Check Doctor Availability</span></a>
                  </li>
                  <li>
                    <a href="doctor_channeling.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Book Doctor Appointment</span></a>
                  </li>
                  <li>
                    <a href="appointment_history.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Appointment History</span></a>
                  </li>
                  <li>
                    <a href="prescription_management_patient.php" class="nav-link px-0"> <span class="d-none d-sm-inline">View Prescription</span></a>
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
        <div class="col py-3">
          <h2>Doctor Channeling</h2>

          <form action="">
            <div class="row">
              <div class="col-4">
                <input type="text" readonly class="form-control" id="app_no" name="app_no" placeholder="Appointment No.">
              </div>
              <div class="col-4">
                <input type="text" readonly class="form-control" name="p_name" value="<?php echo $_SESSION['email']; ?>">
              </div>
              <div class="col-4">
                <input type="hidden" id="hidden_doctor_name" name="hidden_doctor_name">
                <select class="form-select" id="d_id" name="d_id" onchange="loadDoctorDetail()">
                  <option value="">---- Select Doctor ----</option>
                  <?php
                  $query2 = "SELECT id, name, specialization FROM doctors";
                  $result2 = $con->query($query2);
                  if ($result2->num_rows > 0) {
                    while ($optionData = $result2->fetch_assoc()) {
                      $name = $optionData['name'];
                      $specialization = $optionData['specialization'];
                      $id = $optionData['id'];
                  ?>
                      <option value="<?php echo $id; ?>"><?php echo $name; ?> - <?php echo $specialization; ?> </option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-4">
                <input type="date" class="form-control" placeholder="Enter Available Date" id="avl_date" name="avl_date">
                <input type="hidden" id="hidden_week_id" name="hidden_week_id">
              </div>
              <div class="col-4">
                <input type="text" readonly class="form-control" placeholder="Available Time" id="avl_time" name="avl_time">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-12">
                <textarea type="text" class="form-control" placeholder="Enter Reason" id="reason" name="reason"> </textarea>
              </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>


  <?php
  }
  ?>
  <script>
    now = new Date();
    randomNum = '';
    randomNum += Math.round(Math.random() * 9);
    randomNum += Math.round(Math.random() * 9);
    randomNum += now.getTime();
    window.onload = function() {
      document.getElementById("app_no").value = randomNum;
    }

    function loadDoctorDetail() {

      var d_id = $("#d_id").val();
      var d_name = $("#d_id option:selected").text();
      $('#hidden_doctor_name').val(d_name);

      $.ajax({
        method: 'GET',
        url: 'script.php',
        data: {
          'd_id': d_id,
          'ajax': true
        },
        success: function(data) {
          if (data == 'Sunday') {
            $('#hidden_week_id').val(0);
          } else if (data == 'Monday') {
            $('#hidden_week_id').val(1);
          } else if (data == 'Tuesday') {
            $('#hidden_week_id').val(2);
          } else if (data == 'Wednesday') {
            $('#hidden_week_id').val(3);
          } else if (data == 'Thursday') {
            $('#hidden_week_id').val(4);
          } else if (data == 'Friday') {
            $('#hidden_week_id').val(5);
          } else if (data == 'Saturday') {
            $('#hidden_week_id').val(6);
          }
        }
      });

      $.ajax({
        method: 'get',
        url: 'script2.php',
        data: {
          'd_id': d_id,
          'ajax': true
        },
        success: function(data) {
          $('#avl_time').val(data);
        }
      });
    }

    const validate = dateString => {
      var hidden_week_id = $("#hidden_week_id").val();
      const day = (new Date(dateString)).getDay();
      if (day != hidden_week_id) {
        return false;
      }
      return true;
    }

    // Sets the value to '' in case of an invalid date
    document.getElementById('avl_date').onchange = evt => {
      if (!validate(evt.target.value)) {
        alert("Doctor not Available")
        evt.target.value = '';
      }
    }
  </script>

</body>

</html>