<!DOCTYPE html>
<html>
<head>
    <title>Medication Info Page</title>
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
    $Medication_ID = mysqli_real_escape_string($conn, $_POST['Medication_ID']);
  
    $Medication_Name = mysqli_real_escape_string($conn, $_POST['Medication_Name']);
    $Instruction_For_Usage = mysqli_real_escape_string($conn, $_POST['Instruction_For_Usage']);
    $Medicine_Bill = mysqli_real_escape_string($conn, $_POST['Medicine_Bill']);
    $Doctor_ID = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
    $Patient_ID = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
   
    
    
   
    

    $sql = "INSERT INTO medication (Medication_ID, Medication_Name, Instruction_For_Usage, Medicine_Bill, Doctor_ID, Patient_ID ) 
            VALUES ('$Medication_ID', '$Medication_Name','$Instruction_For_Usage', '$Medicine_Bill', '$Doctor_ID',  '$Patient_ID')";

    if (mysqli_query($conn, $sql)) {
        header('Location: medication.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<body style="background-image: url(img/medicine.jpeg);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-100 border-info card h-100 border border-5">
        <h3 class="text-center">Register New Medication</h3>
        <div class="w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <form method="POST" action="">
           
            <div class="mb-3">
                    <label for="Medication_ID" class="form-label">Medication ID</label>
                    <input type="number" class="form-control" name="Medication_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Medication_Name" class="form-label">Medication Name</label>
                    <input type="text" class="form-control" name="Medication_Name" required>
                </div>
               
                
                <div class="mb-3">
                    <label for="Instruction_For_Usage" class="form-label">Instruction For Usage</label>
                    <input type="text" class="form-control" name="Instruction_For_Usage" required>
                </div>
                <div class="mb-3">
                    <label for="Medicine_Bill" class="form-label">Medicine Bill</label>
                    <input type="number" class="form-control" name="Medicine_Bill" required>
                    </div>
                    <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor ID</label>
                    <input type="number" class="form-control" name="Doctor_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID" required>
               
               
                
                
                
               
               
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
