<!DOCTYPE html>
<html>
<head>
    <title>Ambulance Info Page</title>
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

        $ambulance_id = mysqli_real_escape_string($conn, $_POST['ambulance_id']);
       
        $vehicle_model = mysqli_real_escape_string($conn, $_POST['vehicle_model']);
        $ambulance_type = mysqli_real_escape_string($conn, $_POST['ambulance_type']);
        
        $sql = "INSERT INTO ambulance (ambulance_id, vehicle_model, ambulance_type) 
                VALUES (?, ?, ?)";
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "iss", $ambulance_id, $vehicle_model, $ambulance_type);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                header('Location: ambulance.php');
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

<body style="background-image: url(img/ambulance.jpg);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-100 border-info card h-100 border border-5">
        <h3 class="text-center">Register New Ambulance</h3>
        <div class="w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <form method="POST" action="input_ambulance.php">
                <div class="mb-3">
                    <label for="ambulance_id" class="form-label">Ambulance ID</label>
                    <input type="number" class="form-control" name="ambulance_id" required>
                </div>
                <div class="mb-3">
                    <label for="vehicle_model" class="form-label">Vehicle Model</label>
                    <input type="text" class="form-control" name="vehicle_model" required>
                </div>
                <div class="mb-3">
                    <label for="ambulance_type" class="form-label">Ambulance Type</label>
                    <input type="text" class="form-control" name="ambulance_type" required>
                </div>
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
