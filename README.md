# 🏥 Hospital Management System (HMS)

**A comprehensive web-based application for managing hospital operations, patients, and staff workflows.**

![PHP](https://img.shields.io/badge/PHP-Core-777BB4?logo=php\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql\&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-Frontend-7952B3?logo=bootstrap\&logoColor=white)
![Status](https://img.shields.io/badge/Status-Active-success)

---

## 👥 Authors

- **Ahsan Rizvi**
- **Umme Hani Roshni**

*Department of Electrical and Computer Engineering, North South University*

---

## 📖 About

The **Hospital Management System (HMS)** is a full-stack web application designed to automate and simplify hospital administrative operations.
It provides a centralized platform where administrators can efficiently manage:

* Patients
* Doctors and Nurses
* Appointments
* Rooms and Wards
* Lab Tests and Results
* Billing and Payments

This system replaces manual, paper-based processes with a secure and organized digital workflow.

---

## 🚀 Features

* 🧑‍💼 **Admin Dashboard** – Centralized control for managing hospital activities
* 📅 **Appointment Scheduling** – Book patient appointments with doctors
* 🧾 **Patient Records** – Register and manage patient information
* 👨‍⚕️ **Staff Management** – Add and manage doctors and nurses
* 🏥 **Room & Ward Allocation** – Assign patients to rooms or wards
* 🧪 **Lab Tests** – Prescribe tests and upload/view reports
* 💳 **Billing System** – Generate invoices and track payments

---

## 📸 Screenshots

<div align="center"> <img src="https://raw.githubusercontent.com/ahsanrizvi99/hospital-patient-management-system/main/UI%20Screenshots/Screenshot%202025-04-14%20043523.png" alt="Dashboard Preview" width="800"> <p><em>Admin Dashboard Overview</em></p> </div>

---

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3, Bootstrap
* **Backend:** PHP (Native)
* **Database:** MySQL
* **Server:** Apache (XAMPP / WAMP / MAMP)

---

## ⚙️ Installation & Setup

Follow the steps below to run the project locally.

### 1️⃣ Prerequisites

Install any one of the following:

* ✅ XAMPP (Recommended)
* ✅ WAMP
* ✅ MAMP

These provide Apache, MySQL, and PHP.

---

### 2️⃣ Clone the Repository

Navigate to your server root directory:

#### For XAMPP:

```bash
cd C:\xampp\htdocs
```

Then clone:

```bash
git clone https://github.com/ahsanrizvi99/hospital-patient-management-system.git
```

---

### 3️⃣ Database Setup

1. Open phpMyAdmin:
   👉 [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

2. Create a new database named:

```text
hospital_db
```

3. Import the database file:

* Locate `hospital_db.sql` inside the project repository
* Click **Import**
* Choose the file
* Click **Go**

---

### 4️⃣ Configure Database Connection

Open the file:

```text
HMS/includes/db.php
```

Default configuration for XAMPP:

```php
$host = "localhost";
$user = "root";
$pass = "";        // Default password is empty
$db   = "hospital_db";
```

If your MySQL server uses a password, update the `$pass` value accordingly.

---

### 5️⃣ Run the Application

Start **Apache** and **MySQL** from XAMPP, then open:

```text
http://localhost/hospital-patient-management-system/HMS/
```

---

## 📂 Project Structure

```text
/HMS
 ├── /admin        # Admin dashboard and authentication
 ├── /assets       # Images, CSS, and JS files
 ├── /includes     # Database connection, header, footer
 ├── /pages        # Appointments, billing, registration, etc.
 └── index.php     # Landing page
```

---

## 🤝 Contributing

Contributions are welcome and appreciated!

1. Fork the repository
2. Create a new branch:

```bash
git checkout -b feature/NewFeature
```

3. Commit your changes:

```bash
git commit -m "Add new feature"
```

4. Push to GitHub:

```bash
git push origin feature/NewFeature
```

5. Open a Pull Request 🚀

---

## 📄 License

This project is licensed under the **MIT License**.
You are free to use, modify, and distribute this project with proper attribution.

