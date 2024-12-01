<!DOCTYPE html>
<html>
<head>
    <title>Patient Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin"){
    $message = "Require Admin Access";
    echo "<script>
    alert('$message');
    window.location.href='login.php';
    </script>";
    exit;
} 

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    include "connect.php";
    
    // Escape user input for security
    $Patient_ID = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $Patient_Name = mysqli_real_escape_string($conn, $_POST['Patient_Name']);
    $Patient_Age = mysqli_real_escape_string($conn, $_POST['Patient_Age']);
    $Patient_Gender = mysqli_real_escape_string($conn, $_POST['Patient_Gender']);
    $Patient_Contact_Number = mysqli_real_escape_string($conn, $_POST['Patient_Contact_Number']);
    $Doctor_ID = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
    $Admission_ID = mysqli_real_escape_string($conn, $_POST['Admission_ID']);

    $sql = "INSERT INTO patient (Patient_ID, Patient_Name, Patient_Age, Patient_Gender, Patient_Contact_Number,  Doctor_ID, Admission_ID) 
            VALUES ('$Patient_ID', '$Patient_Name', '$Patient_Age', '$Patient_Gender', '$Patient_Contact_Number', '$Doctor_ID', '$Admission_ID')";

    if (mysqli_query($conn, $sql)) {
        header('Location: patient.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<body style="background-image: url(img/patientprofile.jpeg);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-100 border-info card h-100 border border-5">
        <h3 class="text-center">Register New Patient</h3>
        <div class="w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_Name" class="form-label">Patient Name</label>
                    <input type="text" class="form-control" name="Patient_Name" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_Age" class="form-label">Patient Age</label>
                    <input type="number" class="form-control" name="Patient_Age" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_Gender" class="form-label">Patient Gender</label>
                    <input type="text" class="form-control" name="Patient_Gender" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_Contact_Number" class="form-label">Patient Contact Number</label>
                    <input type="number" class="form-control" name="Patient_Contact_Number" required>
                </div>
                <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor ID</label>
                    <input type="number" class="form-control" name="Doctor_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Admission_ID" class="form-label">Admission ID</label>
                    <input type="number" class="form-control" name="Admission_ID" required>
                </div>
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
