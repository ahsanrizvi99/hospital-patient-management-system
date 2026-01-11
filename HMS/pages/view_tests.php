<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin'])) {
    header("Location: ../admin/login.php");
    exit();
}

include('../includes/db.php');
include('../includes/header.php');

// ✅ Delete logic with dependency cleanup
if (isset($_GET['delete'])) {
    $testID = $_GET['delete'];

    // Delete associated test result (if exists)
    mysqli_query($conn, "DELETE FROM TestResults WHERE TestID = $testID");

    // Delete the test
    mysqli_query($conn, "DELETE FROM Test WHERE TestID = $testID");

    echo "<script>window.location.href='view_tests.php';</script>";
}
?>

<div class="container mt-5">
  <h3>🧪 All Assigned Tests</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Test ID</th>
        <th>Patient ID</th>
        <th>Nurse ID</th>
        <th>Test Type</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM Test ORDER BY Date DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['TestID']}</td>
                    <td>{$row['PatientID']}</td>
                    <td>{$row['NurseID']}</td>
                    <td>{$row['TestType']}</td>
                    <td>{$row['Date']}</td>
                    <td>
                      <a href='view_tests.php?delete={$row['TestID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this test?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>No tests found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
