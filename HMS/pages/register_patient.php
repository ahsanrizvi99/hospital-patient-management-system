<?php include('../includes/db.php'); ?>
<?php include('../includes/header.php'); ?>

<div class="container mt-5">
  <h3>Register a New Patient</h3>
  <form method="POST" action="">
    <input type="text" name="fname" class="form-control mb-2" placeholder="First Name" required>
    <input type="text" name="lname" class="form-control mb-2" placeholder="Last Name" required>
    <input type="text" name="contact" class="form-control mb-2" placeholder="Contact Number" required>
    <input type="text" name="street" class="form-control mb-2" placeholder="Street">
    <input type="text" name="city" class="form-control mb-2" placeholder="City">
    <input type="text" name="state" class="form-control mb-2" placeholder="State">
    <input type="text" name="zip" class="form-control mb-2" placeholder="Zip Code">
    <button type="submit" name="submit" class="btn btn-primary">Register Patient</button>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    $sql = "INSERT INTO Patient (FirstName, LastName, Contact, Street, City, State, ZipCode)
            VALUES ('$fname', '$lname', '$contact', '$street', '$city', '$state', '$zip')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success mt-3 text-center'>✅ Patient registered successfully!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3 text-center'>❌ Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
