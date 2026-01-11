<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
include('../includes/header.php');

// Delete appointment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Appointment WHERE AppointmentID = $id");
    echo "<script>window.location.href='view_appointments.php';</script>";
}
?>

<div class="container mt-5">
  <h3>📅 All Appointments</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Time</th>
        <th>Patient ID</th>
        <th>Doctor ID</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM Appointment ORDER BY Date DESC, Time DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['AppointmentID']}</td>
                    <td>{$row['Date']}</td>
                    <td>{$row['Time']}</td>
                    <td>{$row['PatientID']}</td>
                    <td>{$row['DoctorID']}</td>
                    <td>
                      <a href='view_appointments.php?delete={$row['AppointmentID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this appointment?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>No appointments found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
