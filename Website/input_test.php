<!DOCTYPE html>
<html>
<head>
    <title>Test Info Page</title>
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
    
        $Test_ID = $_POST['Test_ID'];
        $Test_Name = $_POST['Test_Name'];
        $Test_Bill = $_POST['Test_Bill'];
       
        $Patient_ID = $_POST['Patient_ID'];
       
        
      
    
        $sql = "INSERT INTO test (Test_ID, Test_Name, Test_Bill, Patient_ID) 
        VALUES ('$Test_ID', '$Test_Name', '$Test_Bill', '$Patient_ID')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: test.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>


<body style="background-image: url(img/test.jpg);background-size: cover;background-repeat: no-repeat;">

<body style="background-image: url(img/test.jpg);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Test </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_test.php">
            <div class="mb-3">
                    <label for="Test_ID" class="form-label">Test ID</label>
                    <input type="number" class="form-control" name="Test_ID">
                </div>
                <div class="mb-3">
                    <label for="Test_Name" class="form-label">Test Name</label>
                    <input type="text" class="form-control" name="Test_Name">
                </div>
                <div class="mb-3">
                    <label for="Test_Bill" class="form-label">Test_Bill</label>
                    <input type="number" class="form-control" name="Test_Bill">
                </div>
                
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient_ID</label>
                    <input type="number" class="form-control" name="Patient_ID">
                </div>
                
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>