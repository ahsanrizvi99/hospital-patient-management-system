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

// Handle add
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    if (!empty($name)) {
        mysqli_query($conn, "INSERT INTO Department (Name) VALUES ('$name')");
        echo "<script>window.location.href='manage_departments.php';</script>";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Department WHERE DepartmentID = $id");
    echo "<script>window.location.href='manage_departments.php';</script>";
}
?>

<div class="container mt-5">
  <h3>🏢 Manage Departments</h3>

  <form method="POST" class="mb-4">
    <div class="input-group">
      <input type="text" name="name" class="form-control" placeholder="Enter Department Name" required>
      <button type="submit" name="add" class="btn btn-success">➕ Add Department</button>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Department ID</th>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $departments = mysqli_query($conn, "SELECT * FROM Department");
        if (mysqli_num_rows($departments) > 0) {
          while ($row = mysqli_fetch_assoc($departments)) {
            echo "<tr>
                    <td>{$row['DepartmentID']}</td>
                    <td>{$row['Name']}</td>
                    <td>
                      <a href='manage_departments.php?delete={$row['DepartmentID']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this department?\")'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='3' class='text-center'>No departments found.</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
