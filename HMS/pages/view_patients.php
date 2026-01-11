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

// Delete logic — with dependent cleanup (if needed)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Optional: manually remove dependencies if not using ON DELETE CASCADE
    mysqli_query($conn, "DELETE FROM Bill WHERE PatientID = $id");
    mysqli_query($conn, "DELETE FROM Appointment WHERE PatientID = $id");
    mysqli_query($conn, "DELETE FROM Room WHERE PatientID = $id");
    mysqli_query($conn, "DELETE FROM Test WHERE PatientID = $id"); // If applicable

    // Now delete patient
    mysqli_query($conn, "DELETE FROM Patient WHERE PatientID = $id");
    echo "<script>window.location.href='view_patients.php';</script>";
}
?>

<div class="container mt-5">
  <h3>🧑‍⚕️ All Registered Patients</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Patient ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>City</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM Patient ORDER BY PatientID DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['PatientID']}</td>
                    <td>{$row['FirstName']} {$row['LastName']}</td>
                    <td>{$row['Contact']}</td>
                    <td>{$row['City']}</td>
                    <td>
                      <a href='view_patients.php?delete={$row['PatientID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this patient?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>No patients found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
