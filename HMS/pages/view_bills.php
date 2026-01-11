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

// Delete bill
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Bill WHERE BillID = $id");
    echo "<script>window.location.href='view_bills.php';</script>";
}
?>

<div class="container mt-5">
  <h3>💳 All Generated Bills</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Bill ID</th>
        <th>Patient ID</th>
        <th>Total Amount</th>
        <th>Payment Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM Bill ORDER BY BillID DESC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['BillID']}</td>
                    <td>{$row['PatientID']}</td>
                    <td>{$row['TotalAmount']}</td>
                    <td>{$row['PaymentStatus']}</td>
                    <td>
                      <a href='view_bills.php?delete={$row['BillID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this bill?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>No bills found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
