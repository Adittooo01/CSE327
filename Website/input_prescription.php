<!DOCTYPE html>
<html>
<head>
    <title>Prescription Info Page</title>
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

    if (isset($_POST['submit'])) {
        include "connect.php";
    
        // Enable error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $Prescription_ID = mysqli_real_escape_string($conn, $_POST['Prescription_ID']);
        $Prescription_Date = mysqli_real_escape_string($conn, $_POST['Prescription_Date']);
        $Doctor_ID = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
        $Patient_ID= mysqli_real_escape_string($conn, $_POST['Patient_ID']);
        $Medication_ID = mysqli_real_escape_string($conn, $_POST['Medication_ID']);
    
        $sql = "INSERT INTO prescription (Prescription_ID, Prescription_Date, Doctor_ID, Patient_ID, Medication_ID) 
                VALUES (?, ?, ?, ?, ?)";
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "isiii", $Prescription_ID, $Prescription_Date, $Doctor_ID, $Patient_ID, $Medication_ID);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                header('Location: prescription.php');
                exit();
            } else {
                echo 'Query error: ' . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo 'Prepare statement error: ' . mysqli_error($conn);
        }
    
        // Close the connection
        mysqli_close($conn);
    }
    include("header.php");
?>

<body style="background-image: url(img/prescription.jpg);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-100 border-info card h-100 border border-5">
        <h3 class="text-center">Register New Prescription</h3>
        <div class="w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <form method="POST" action="input_prescription.php">
                <div class="mb-3">
                    <label for="Prescription_ID" class="form-label">Prescription ID</label>
                    <input type="number" class="form-control" name="Prescription_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Prescription_Date" class="form-label">Prescription Date</label>
                    <input type="date" class="form-control" name="Prescription_Date" required>
                </div>
                <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor ID</label>
                    <input type="number" class="form-control" name="Doctor_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Medication_ID" class="form-label">Medication ID</label>
                    <input type="number" class="form-control" name="Medication_ID" required>
                </div>
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
