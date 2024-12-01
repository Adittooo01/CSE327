<!DOCTYPE html>
<html>
<head>
    <title>Admission Info Page</title>
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

    if(isset($_POST['submit'])){
        include "connect.php";
    
        $Admission_ID = $_POST['Admission_ID'];
        $Admission_Date = $_POST['Admission_Date'];
        $Patient_ID = $_POST['Patient_ID'];
        $Doctor_ID = $_POST['Doctor_ID'];
        $Ward_Number = $_POST['Ward_Number'];
        $Room_Number = $_POST['Room_Number'];
        $Bed_Number = $_POST['Bed_Number'];
      
    
        $sql = "INSERT INTO admission (Admission_ID, Admission_Date, Patient_ID, Doctor_ID, Ward_Number, Room_Number, Bed_Number) 
        VALUES ('$Admission_ID', '$Admission_Date', '$Patient_ID', '$Doctor_ID', '$Ward_Number', '$Room_Number', '$Bed_Number')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: admission.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>




<body style="background-image: url(img/admission.webp);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Admission </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_admission.php">
            <div class="mb-3">
                    <label for="Admission_ID" class="form-label">Admission ID</label>
                    <input type="number" class="form-control" name="Admission_ID">
                </div>
                <div class="mb-3">
                    <label for="Admission_Date" class="form-label">Admission Date</label>
                    <input type="date" class="form-control" name="Admission_Date">
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID">
                </div>
                <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor ID</label>
                    <input type="number" class="form-control" name="Doctor_ID">
                </div>
                <div class="mb-3">
                    <label for="Ward_Number" class="form-label">Ward Number</label>
                    <input type="number" class="form-control" name="Ward_Number">
                </div>
                <div class="mb-3">
                    <label for="Room_Number" class="form-label">Room Number</label>
                    <input type="number" class="form-control" name="Room_Number">
                </div>
                <div class="mb-3">
                    <label for="Bed_Number" class="form-label">Bed Number</label>
                    <input type="number" class="form-control" name="Bed_Number">
                </div>
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>