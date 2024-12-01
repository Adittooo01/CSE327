<!DOCTYPE html>
<html>
<head>
    <title>Discharge Summary Info Page</title>
</head>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

   
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
    
        $discharge_summary_ID = $_POST['Discharge_Summary_ID'];
        $patient_id = $_POST['Patient_ID'];
        $discharge_date = $_POST['Discharge_Date'];
        $reason_for_discharge = $_POST['Reason_For_Discharge'];
        $summary_of_treatment = $_POST['Summary_of_Treatment'];
        $progress_during_hospital_stay = $_POST['Progress_During_Hospital_Stay'];
       
      
    
        $sql = "INSERT INTO discharge_summary (Discharge_Summary_ID, Patient_ID, Discharge_Date, Reason_For_Discharge, Summary_of_Treatment, Progress_During_Hospital_Stay) 
        VALUES ('$discharge_summary_ID', '$patient_id', '$discharge_date', '$reason_for_discharge', '$summary_of_treatment', '$progress_during_hospital_stay')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: patient.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>


<body style="background-image: url(img/patient.webp);background-size: cover;background-repeat: no-repeat;">

<!-- <body style="background-image: url(img/admission.webp);background-size: cover;background-repeat: no-repeat;"> -->
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Discharge Summary </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_dischargesummary.php">
            <div class="mb-3">
                    <label for="Discharge_Summary_ID" class="form-label">Discharge Summary ID</label>
                    <input type="number" class="form-control" name="Discharge_Summary_ID">
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID">
                </div>
                <div class="mb-3">
                    <label for="Discharge_Date" class="form-label">Discharge Date</label>
                    <input type="date" class="form-control" name="Discharge_Date">
                </div>
                <div class="mb-3">
                    <label for="Reason_For_Discharge" class="form-label">Reason For Discharge</label>
                    <input type="text" class="form-control" name="Reason_For_Discharge">
                </div>
                <div class="mb-3">
                    <label for="Summary_of_Treatment" class="form-label">Summary of Treatment</label>
                    <input type="text" class="form-control" name="Summary_of_Treatment">
                </div>
                <div class="mb-3">
                    <label for="Progress_During_Hospital_Stay" class="form-label">Progress During Hospital_Stay</label>
                    <input type="text" class="form-control" name="Progress_During_Hospital_Stay">
                </div>
                
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>


