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

// Delete test result
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM TestResults WHERE ResultID = $id");
    echo "<script>window.location.href='view_test_results.php';</script>";
}
?>

<div class="container mt-5">
  <h3>🧪 All Test Results</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Result ID</th>
        <th>Test ID</th>
        <th>Status</th>
        <th>Details</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM TestResults ORDER BY ResultID DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['ResultID']}</td>
                    <td>{$row['TestID']}</td>
                    <td>{$row['Status']}</td>
                    <td>{$row['Details']}</td>
                    <td>
                      <a href='view_test_results.php?delete={$row['ResultID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this result?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>No test results found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
