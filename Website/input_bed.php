<!DOCTYPE html>
<html>
<head>
    <title>Bed Info Page</title>
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
    
        $Bed_Number = $_POST['Bed_Number'];
        $Bed_type = $_POST['Bed_Type'];
        $Available_Beds= $_POST['Available_Beds'];
        $Ward_Number = $_POST['Ward_Number'];
        $Room_Number = $_POST['Room_Number'];
        $Patient_ID = $_POST['Patient_ID'];
        $Admission_ID = $_POST['Admission_ID']; 
    
        $sql = "INSERT INTO bed (Bed_Number, Bed_Type, Available_Beds,Ward_Number, Room_Number, Patient_ID, Admission_ID) 
        VALUES ('$Bed_Number', '$Bed_Type', '$Available_Beds', '$Ward_Number', '$Room_Number', '$Patient_ID','$Admission_ID')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: bed.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>


<body style="background-image: url(img/bed.webp);background-size: cover;background-repeat: no-repeat;">

<body style="background-image: url(img/bed.webp);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Bed </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_bed.php">
            <div class="mb-3">
                    <label for="Bed_Number" class="form-label">Bed Number</label>
                    <input type="number" class="form-control" name="Bed_Number">
                </div>
                <div class="mb-3">
                    <label for="Bed_Type" class="form-label">Bed Type</label>
                    <input type="text" class="form-control" name="Bed_Type">
                </div>
                <div class="mb-3">
                    <label for="Available_Beds" class="form-label">Available Beds</label>
                    <input type="number" class="form-control" name="Available_Beds">
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
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID">
                </div>
                <div class="mb-3">
                    <label for="Admission_ID" class="form-label">Admission ID</label>
                    <input type="number" class="form-control" name="Admission_ID">
                </div>
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>