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

// Delete room assignment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Room WHERE RoomID = '$id'");
    echo "<script>window.location.href='view_rooms.php';</script>";
}
?>

<div class="container mt-5">
  <h3>🛏️ All Room Assignments</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Room ID</th>
        <th>Patient ID</th>
        <th>Room Type</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM Room ORDER BY RoomID DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['RoomID']}</td>
                    <td>{$row['PatientID']}</td>
                    <td>{$row['RoomType']}</td>
                    <td>
                      <a href='view_rooms.php?delete={$row['RoomID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this room assignment?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='4' class='text-center'>No room assignments found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
