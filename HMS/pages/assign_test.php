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
  <h3>Assign Test to Patient</h3>
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

    <select name="nurse_id" class="form-control mb-2" required>
      <option value="">Select Nurse</option>
      <?php
        $nurses = mysqli_query($conn, "SELECT NurseID, FirstName, LastName FROM Nurse");
        while ($n = mysqli_fetch_assoc($nurses)) {
          echo "<option value='{$n['NurseID']}'>{$n['FirstName']} {$n['LastName']}</option>";
        }
      ?>
    </select>

    <input type="text" name="test_type" class="form-control mb-2" placeholder="Test Type" required>
    <input type="date" name="test_date" class="form-control mb-2" required>

    <button type="submit" name="submit" class="btn btn-info">Assign Test</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $pid = $_POST['patient_id'];
    $nid = $_POST['nurse_id'];
    $type = $_POST['test_type'];
    $date = $_POST['test_date'];

    $sql = "INSERT INTO Test (PatientID, NurseID, TestType, Date)
            VALUES ('$pid', '$nid', '$type', '$date')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success mt-3'>✅ Test assigned successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
