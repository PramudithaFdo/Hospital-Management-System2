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
  $sql = "SELECT * FROM appointments where p_email = '" . $_SESSION['email'] . "' ORDER BY id";
  $result = mysqli_query($con, $sql) or die($mysqli->error());
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
        <h2>Appointment History</h2>
        <br>
        <input class="form-control" id="myInput" type="text" placeholder="Search...">
        <br>
        <table class="table table-bordered table-striped" id="myTable">
          <thead>
            <tr>
              <th>Appointment No.</th>
              <th>Doctor Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time (From - To)</th>
              <th>Reason</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // LOOP TILL END OF DATA
            while ($rows = $result->fetch_assoc()) {
            ?>
              <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['app_no']; ?></td>
                <td><?php echo $rows['d_name']; ?></td>
                <td><?php echo $rows['avl_date']; ?></td>
                <td><?php echo $rows['avl_time']; ?></td>
                <td><?php echo $rows['reason']; ?></td>
                <?php if ($rows['done'] == 1) : ?>
                  <td>Done</td>
                <?php elseif ($rows['cancel'] == 1) : ?>
                  <td>Cancelled</td>
                <?php elseif ($rows['d_cancel'] == 1) : ?>
                  <td>Doctor not Available</td>
                <?php elseif ($rows['approve'] == 1) : ?>
                  <td>Approved</td>
                <?php else : ?>
                  <td><button type="button" title="Cancel Appointment" class="btn btn-danger" onclick="cancelRow(<?php echo $rows['id']; ?>)"><i class="bi bi-calendar2-x"></i></button></td>
                <?php endif; ?>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {

      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    function cancelRow(id) {
      $.ajax({
        method: 'POST',
        url: 'modal_cancel_script.php',
        data: {
          'id': id,
          'ajax': true
        },
        success: function(data) {
          location.reload();
        }
      });
    };
  </script>

</body>

</html>