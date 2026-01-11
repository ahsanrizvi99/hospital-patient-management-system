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
  <h3>Register a New Doctor</h3>
  <form method="POST" action="">
    <input type="text" name="fname" class="form-control mb-2" placeholder="First Name" required>
    <input type="text" name="lname" class="form-control mb-2" placeholder="Last Name" required>
    <input type="text" name="street" class="form-control mb-2" placeholder="Street">
    <input type="text" name="city" class="form-control mb-2" placeholder="City">
    <input type="text" name="state" class="form-control mb-2" placeholder="State">
    <input type="text" name="zip" class="form-control mb-2" placeholder="Zip Code">
    
    <select name="department_id" class="form-control mb-2" required>
      <option value="">Select Department</option>
      <?php
        $departments = mysqli_query($conn, "SELECT DepartmentID, Name FROM Department");
        while ($d = mysqli_fetch_assoc($departments)) {
          echo "<option value='{$d['DepartmentID']}'>{$d['Name']}</option>";
        }
      ?>
    </select>

    <button type="submit" name="submit" class="btn btn-primary">Register Doctor</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $dept = $_POST['department_id'];

    $sql = "INSERT INTO Doctor (FirstName, LastName, Street, City, State, ZipCode, DepartmentID)
            VALUES ('$fname', '$lname', '$street', '$city', '$state', '$zip', '$dept')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success mt-3'>✅ Doctor registered successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
