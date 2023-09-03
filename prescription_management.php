<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Hospital Management System</title>
  <link rel="stylesheet" href="css/style.css" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body style="background-image: url('img/admin_form_bg.jpg'); background-repeat: no-repeat;">

  <?php
  //include auth_session.php file on all user panel pages
  include("auth_session.php");  //need to uncomment 
  require('db.php');
  // SQL query to select data from database
  $sql = "SELECT * FROM prescriptions where d_id = '" . $_SESSION['id'] . "' ORDER BY id";
  $result = mysqli_query($con, $sql) or die($mysqli->error());
  ?>

  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

            <li>
              <a href="dashboard_doctor.php" class="nav-link px-0 align-middle">
                <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
              <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                <li>
                  <a href="prescription_management.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Prescription Management</span></a>
                </li>
                <li>
                  <a href="appointment_history_doctor.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Appointments</span></a>
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
        <h2>Patient Prescription Management</h2>

        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-6">
              <select class="form-select" id="app_no" name="app_no">
                <option value="">---- Select Appointment ----</option>
                <?php
                $query2 = "SELECT id, app_no, p_email FROM appointments where d_id = '" . $_SESSION['id'] . "' and approve = '1' and done = '0' and cancel ='0' and d_cancel ='0'";
                $result2 = $con->query($query2);
                if ($result2->num_rows > 0) {
                  while ($optionData = $result2->fetch_assoc()) {
                    $app_no = $optionData['app_no'];
                    $p_name = $optionData['p_email'];
                ?>
                    <option value="<?php echo $app_no; ?>"><?php echo $app_no; ?> - <?php echo $p_name; ?> </option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-6">
              <input class="form-control" type="file" id="file" name="file" onchange="preview()">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-12">
            <textarea type="text" class="form-control" id="comments" name="comments"> </textarea>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-6">
              <img id="frame" src="" class="img-fluid" />
            </div>
          </div>
          <br>
          <button type="submit" name="submit" value="Upload" class="btn btn-primary">Submit</button>
        </form>

        <br>
        <input class="form-control" id="myInput" type="text" placeholder="Search...">
        <br>
        <table class="table table-bordered table-striped" id="myTable">
          <thead>
            <tr>
              <th>Appointment No.</th>
              <th>Prescription</th>
              <th>Comment</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // LOOP TILL END OF DATA
            while ($rows = $result->fetch_assoc()) {
              $imageURL = 'uploads/' . $rows["upload_path"];
            ?>
              <tr>
                <!-- FETCHING DATA FROM EACH
                ROW OF EVERY COLUMN -->
                <td><?php echo $rows['app_id']; ?></td>
                <td>
                  <img src="<?php echo $imageURL; ?>" class="profile-photo" width="50" height="50" alt="photo" />
                </td>
                <td><?php echo $rows['comments']; ?></td>
                <td>
                  <a href="<?php echo $imageURL; ?>" download>
                    <button type="button" class="btn btn-danger"><i class="bi bi-cloud-arrow-down"></i></button></a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script>
    function preview() {
      frame.src = URL.createObjectURL(event.target.files[0]);
    }

    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

</body>

</html>