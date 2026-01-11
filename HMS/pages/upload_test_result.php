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
  <h3>Upload Test Result</h3>
  <form method="POST" action="">
    <select name="test_id" class="form-control mb-2" required>
      <option value="">Select Test</option>
      <?php
        $tests = mysqli_query($conn, "SELECT TestID, TestType, Date FROM Test");
        while ($t = mysqli_fetch_assoc($tests)) {
          echo "<option value='{$t['TestID']}'>{$t['TestType']} ({$t['Date']})</option>";
        }
      ?>
    </select>

    <textarea name="details" class="form-control mb-2" placeholder="Result Details" required></textarea>

    <select name="status" class="form-control mb-2" required>
      <option value="">Select Status</option>
      <option value="Positive">Positive</option>
      <option value="Negative">Negative</option>
      <option value="Pending">Pending</option>
    </select>

    <button type="submit" name="submit" class="btn btn-success">Upload Result</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $test_id = $_POST['test_id'];
    $details = $_POST['details'];
    $status = $_POST['status'];

    $sql = "INSERT INTO TestResults (TestID, Details, Status)
            VALUES ('$test_id', '$details', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success mt-3'>✅ Result uploaded successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
