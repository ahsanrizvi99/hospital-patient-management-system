<?php
session_start();
include('../includes/db.php');
include('../includes/header.php');
?>

<div class="container mt-5">
  <h3>Admin Login</h3>
  <form method="POST" action="">
    <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
    <button type="submit" name="login" class="btn btn-dark">Login</button>
  </form>
</div>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM Admin WHERE LoginCredentials = '$password' AND Name = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "<div class='alert alert-danger mt-3 text-center'>❌ Invalid credentials!</div>";
    }
}
?>

<?php include('../includes/footer.php'); ?>
