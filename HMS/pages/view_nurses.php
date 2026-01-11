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

// Delete nurse
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Nurse WHERE NurseID = $id");
    echo "<script>window.location.href='view_nurses.php';</script>";
}
?>

<div class="container mt-5">
  <h3>👩‍⚕️ All Registered Nurses</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nurse ID</th>
        <th>Name</th>
        <th>City</th>
        <th>Department ID</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM Nurse ORDER BY NurseID DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['NurseID']}</td>
                    <td>{$row['FirstName']} {$row['LastName']}</td>
                    <td>{$row['City']}</td>
                    <td>{$row['DepartmentID']}</td>
                    <td>
                      <a href='view_nurses.php?delete={$row['NurseID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this nurse?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>No nurses found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
