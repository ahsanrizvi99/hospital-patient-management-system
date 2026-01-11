<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include('../includes/db.php'); ?>
<?php include('../includes/header.php'); ?>

<div class="container mt-5">
  <h3>Generate Patient Bill</h3>
  <form method="POST" action="">
    <select name="patient_id" class="form-control mb-2" required>
      <option value="">Select Patient</option>
      <?php
        $patients = mysqli_query($conn, "SELECT PatientID, FirstName, LastName FROM Patient");
        while ($p = mysqli_fetch_assoc($patients)) {
          echo "<option value='{$p['PatientID']}'>{$p['FirstName']} {$p['LastName']}</option>";
        }
      ?>
    </select>

    <input type="number" name="total_amount" class="form-control mb-2" placeholder="Total Amount (BDT)" required>

    <select name="status" class="form-control mb-2" required>
      <option value="Paid">Paid</option>
      <option value="Unpaid">Unpaid</option>
    </select>

    <button type="submit" name="submit" class="btn btn-primary">Generate Bill</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $pid = $_POST['patient_id'];
    $amount = $_POST['total_amount'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Bill (PatientID, TotalAmount, PaymentStatus)
            VALUES ('$pid', '$amount', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success mt-3'>✅ Bill generated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
