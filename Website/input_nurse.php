<!DOCTYPE html>
<html>
<head>
    <title>Nurse Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    include "connect.php";
    
    // Escape user input for security
    $Nurse_ID = mysqli_real_escape_string($conn, $_POST['Nurse_ID']);
    $Nurse_Name = mysqli_real_escape_string($conn, $_POST['Nurse_Name']);
    $Department_ID = mysqli_real_escape_string($conn, $_POST['Department_ID']);
    $Nurse_Contact_Number = mysqli_real_escape_string($conn, $_POST['Nurse_Contact_Number']);
    $Shift_ID = mysqli_real_escape_string($conn, $_POST['Shift_ID']);
    
    
   
    

    $sql = "INSERT INTO nurse (Nurse_ID, Nurse_Name, Department_ID, Nurse_Contact_Number, Shift_ID ) 
            VALUES ('$Nurse_ID', '$Nurse_Name', '$Department_ID', '$Nurse_Contact_Number', '$Shift_ID')";

    if (mysqli_query($conn, $sql)) {
        header('Location: nurse.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<body style="background-image: url(img/nurse.jpeg);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-100 border-info card h-100 border border-5">
        <h3 class="text-center">Register New Nurse</h3>
        <div class="w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <form method="POST" action="">
            <div class="mb-3">
                    <label for="Nurse_ID" class="form-label">Nurse ID</label>
                    <input type="number" class="form-control" name="Nurse_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Nurse_Name" class="form-label">Nurse Name</label>
                    <input type="text" class="form-control" name="Nurse_Name" required>
                </div>
                <div class="mb-3">
                    <label for="Department_ID" class="form-label">Department ID</label>
                    <input type="number" class="form-control" name="Department_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Nurse_Contact_Number" class="form-label">Nurse Contact Number</label>
                    <input type="number" class="form-control" name="Nurse_Contact_Number" required>
                </div>
                <div class="mb-3">
                    <label for="Shift_ID" class="form-label">Shift ID</label>
                    <input type="number" class="form-control" name="Shift_ID" required>
                <!-- </div> -->
                
                
                
               
               
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>