<?php include('../includes/db.php'); ?>
<?php include('../includes/header.php'); ?>

<div class="container mt-5">
  <h3>📅 Book an Appointment</h3>

  <?php
  if (isset($_POST['submit'])) {
      $pid = $_POST['patient_id'];
      $did = $_POST['doctor_id'];
      $date = $_POST['date'];
      $time = $_POST['time'];

      // Check for doctor clash
      $check = mysqli_query($conn, "SELECT * FROM Appointment WHERE DoctorID = '$did' AND Date = '$date' AND Time = '$time'");

      if (mysqli_num_rows($check) > 0) {
          echo "<div class='alert alert-danger mt-3'> This doctor already has an appointment at that time.</div>";
      } else {
          $sql = "INSERT INTO Appointment (Date, Time, PatientID, DoctorID)
                  VALUES ('$date', '$time', '$pid', '$did')";

          if (mysqli_query($conn, $sql)) {
              echo "<div class='alert alert-success mt-3'> Appointment booked successfully!</div>";
          } else {
              echo "<div class='alert alert-danger mt-3'> Error: " . mysqli_error($conn) . "</div>";
          }
      }
  }
  ?>

  <form method="POST" action="">
    <select name="patient_id" class="form-control mb-2" required>
      <option value="">👤 Select Patient</option>
      <?php
        $patients = mysqli_query($conn, "SELECT PatientID, FirstName, LastName FROM Patient");
        while ($p = mysqli_fetch_assoc($patients)) {
          echo "<option value='{$p['PatientID']}'>{$p['FirstName']} {$p['LastName']}</option>";
        }
      ?>
    </select>

    <select name="doctor_id" class="form-control mb-2" required>
      <option value="">👨‍⚕️ Select Doctor</option>
      <?php
        $doctors = mysqli_query($conn, "SELECT DoctorID, FirstName, LastName FROM Doctor");
        while ($d = mysqli_fetch_assoc($doctors)) {
          echo "<option value='{$d['DoctorID']}'>{$d['FirstName']} {$d['LastName']}</option>";
        }
      ?>
    </select>

    <input type="date" name="date" class="form-control mb-2" required>
    <input type="time" name="time" class="form-control mb-2" required>

    <button type="submit" name="submit" class="btn btn-success">📅 Book Appointment</button>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
