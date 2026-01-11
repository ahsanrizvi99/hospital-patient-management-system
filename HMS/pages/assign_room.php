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
  <h3>Assign Room to Patient</h3>
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

    <input type="text" name="room_id" class="form-control mb-2" placeholder="Room Number (e.g., 101, ICU-2)" required>

    <select name="room_type" class="form-control mb-2" required>
      <option value="">Select Room Type</option>
      <option value="General">General</option>
      <option value="Cabin">Cabin</option>
      <option value="ICU">ICU</option>
    </select>

    <button type="submit" name="submit" class="btn btn-primary">Assign Room</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $pid = $_POST['patient_id'];
    $room_id = $_POST['room_id'];
    $room_type = $_POST['room_type'];

    $sql = "INSERT INTO Room (RoomID, PatientID, RoomType)
            VALUES ('$room_id', '$pid', '$room_type')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success mt-3'>✅ Room assigned successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
