<!DOCTYPE html>
<html>
<head>
    <title>Billing Info Page</title>
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
    
        $Billing_ID = $_POST['Billing_ID'];
        $Billing_Date = $_POST['Billing_Date'];
        $Patient_ID = $_POST['Patient_ID'];
        $Medication_ID = $_POST['Medication_ID'];
        $Medicine_Bill = $_POST['Medicine_Bill'];
        
        $Test_Bill = $_POST['Test_Bill'];
        $Doctor_Bill = $_POST['Doctor_Bill'];
        $Total_Bill = $_POST['Total_Bill'];
        
      
    
        $sql = "INSERT INTO billing (Billing_ID, Billing_Date, Patient_ID, Medication_ID, Medicine_Bill, Test_Bill, Doctor_Bill, Total_Bill) 
        VALUES ('$Billing_ID', '$Billing_Date', '$Patient_ID', '$Medication_ID', '$Medicine_Bill', '$Test_Bill', '$Doctor_Bill', '$Total_Bill')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: billing.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>


<body style="background-image: url(img/billing.jpg);background-size: cover;background-repeat: no-repeat;">

<body style="background-image: url(img/billing.jpg);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Bill </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_billing.php">
            <div class="mb-3">
                    <label for="Billing_ID" class="form-label">Billing ID</label>
                    <input type="number" class="form-control" name="Billing_ID">
                </div>
                <div class="mb-3">
                    <label for="Billing_Date" class="form-label">Billing Date</label>
                    <input type="date" class="form-control" name="Billing_Date">
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" name="Patient_ID">
                </div>
                <div class="mb-3">
                    <label for="Medication_ID" class="form-label">Medication ID</label>
                    <input type="number" class="form-control" name="Medication_ID">
                </div>
                <div class="mb-3">
                    <label for="Medicine_Bill" class="form-label">Medicine Bill</label>
                    <input type="number" class="form-control" name="Medicine_Bill">
                </div>
                
                <div class="mb-3">
                    <label for="Test_Bill" class="form-label">Test Bill</label>
                    <input type="number" class="form-control" name="Test_Bill">
                </div>

                <div class="mb-3">
                    <label for="Doctor_Bill" class="form-label">Doctor Bill</label>
                    <input type="number" class="form-control" name="Doctor_Bill">
                </div>

                <div class="mb-3">
                    <label for="Total_Bill" class="form-label">Total Bill</label>
                    <input type="number" class="form-control" name="Total_Bill">
                </div>
                
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>