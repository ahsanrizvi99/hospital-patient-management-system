<?php include('includes/header.php'); ?>

<!-- ✅ Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
  body {
    background: url('assets/img/hospital-bg.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
  }

  .hero-container {
    background-color: rgba(255, 255, 255, 0.5); /* ✅ translucent white */
    padding: 60px 30px;
    border-radius: 15px;
    text-align: center;
    max-width: 750px;
    margin: 100px auto;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    color: #222;
  }

  h2 {
    font-weight: 600;
    margin-bottom: 30px;
    color: #222;
  }

  .hero-btn {
    margin: 10px;
    font-size: 18px;
    font-weight: 500;
    padding: 14px 28px;
    border-radius: 8px;
    transition: 0.3s ease;
  }

  .hero-btn:hover {
    transform: scale(1.05);
  }

  @media (max-width: 768px) {
    .hero-btn {
      width: 100%;
      margin-bottom: 10px;
    }
  }
</style>

<!-- 🏥 Welcome Section -->
<div class="hero-container">
  <h2>🏥 Welcome to the Hospital Management System</h2>

  <div class="d-flex flex-wrap justify-content-center">
  <a href="pages/register_patient.php" class="btn btn-primary hero-btn">📝 Register Patient</a>
  <a href="pages/add_appointment.php" class="btn btn-info hero-btn">📅 Book Appointment</a>
  <a href="admin/login.php" class="btn btn-warning hero-btn text-dark">🔐 Admin Login</a>
</div>
</div>

<?php include('includes/footer.php'); ?>
