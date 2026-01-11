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
?>

<!-- Style for translucent box and headings -->
<style>
  .hero-container {
    background-color: rgba(255, 255, 255, 0.5);
    padding: 60px 30px;
    border-radius: 15px;
    text-align: center;
    max-width: 900px;
    margin: 100px auto;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
    color: #222;
  }

  h3 {
    color: #222;
    font-weight: 600;
  }

  h4.section-heading {
    color: #222;
    font-weight: 700;
    margin-top: 40px;
    margin-bottom: 20px;
    text-align: left;
  }

  @media (max-width: 768px) {
    .hero-container {
      padding: 30px 15px;
    }
  }
</style>

<div class="hero-container">
  <h3 class="mb-4">👋 Welcome, <strong><?php echo $_SESSION['admin']; ?></strong>!</h3>

  <!-- People Management -->
  <h4 class="section-heading">👥 People Management</h4>
  <div class="row mb-4">
    <div class="col-md-3 mb-2"><a href="../pages/register_patient.php" class="btn btn-primary w-100 text-white">➕ Register Patient</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_patients.php" class="btn btn-primary w-100 text-white">👁️ View Patients</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/register_doctor.php" class="btn btn-success w-100 text-white">➕ Register Doctor</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_doctors.php" class="btn btn-success w-100 text-white">👁️ View Doctors</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/register_nurse.php" class="btn btn-warning w-100 text-dark">➕ Register Nurse</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_nurses.php" class="btn btn-warning w-100 text-dark">👁️ View Nurses</a></div>
  </div>

  <!-- Appointments & Tests -->
  <h4 class="section-heading">📅 Appointments & Tests</h4>
  <div class="row mb-4">
    <div class="col-md-3 mb-2"><a href="../pages/add_appointment.php" class="btn btn-info w-100 text-white">📅 Book Appointment</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_appointments.php" class="btn btn-info w-100 text-white">👁️ View Appointments</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/assign_test.php" class="btn btn-secondary w-100 text-white">🧪 Assign Test</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/upload_test_result.php" class="btn btn-secondary w-100 text-white">📤 Upload Result</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_tests.php" class="btn btn-secondary w-100 text-white">👁️ View Tests</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_test_results.php" class="btn btn-secondary w-100 text-white">👁️ View Test Results</a></div>
  </div>

  <!-- Billing & Rooms -->
  <h4 class="section-heading">🏦 Billing & Rooms</h4>
  <div class="row mb-4">
    <div class="col-md-3 mb-2"><a href="../pages/generate_bill.php" class="btn btn-dark w-100 text-white">💳 Generate Bill</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_bills.php" class="btn btn-dark w-100 text-white">👁️ View Bills</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/assign_room.php" class="btn btn-danger w-100 text-white">🛏️ Assign Room</a></div>
    <div class="col-md-3 mb-2"><a href="../pages/view_rooms.php" class="btn btn-danger w-100 text-white">👁️ View Rooms</a></div>
  </div>

  <!-- System Management -->
  <h4 class="section-heading">⚙️ System Management</h4>
  <div class="row mb-2 justify-content-center">
    <div class="col-md-3 mb-2"><a href="manage_departments.php" class="btn btn-secondary w-100 text-white">🏢 Manage Departments</a></div>
    <div class="col-md-3 mb-2"><a href="logout.php" class="btn btn-danger w-100 text-white">🚪 Logout</a></div>
  </div>
</div>

<?php include('../includes/footer.php'); ?>
