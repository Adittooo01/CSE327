<!DOCTYPE html>
<html>
<head>
    <title>Doctor Info Page</title>
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
    
        $Doctor_ID = $_POST['Doctor_ID'];
        $Doctor_Name = $_POST['Doctor_Name'];
        $Department_ID = $_POST['Department_ID'];
        $Degree = $_POST['Degree'];
        $Specialists = $_POST['Specialists'];
    
        $sql = "INSERT INTO doctor (Doctor_ID, Doctor_Name, Department_ID, Degree, Specialists) 
        VALUES ('$Doctor_ID', '$Doctor_Name', '$Department_ID', '$Degree', '$Specialists')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: doctor.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
   
?>


<body style="background-image: url(img/doctorpage.jpeg);background-size: cover;background-repeat: no-repeat;">

<body style="background-image: url(img/doctorpage.jpeg);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Doctor </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_doctor.php">
                <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor_ID</label>
                    <input type="number" class="form-control" name="Doctor_ID">
                </div>
                <div class="mb-3">
                    <label for="Doctor_Name" class="form-label">Doctor_Name</label>
                    <input type="text" class="form-control" name="Doctor_Name">
                </div>
                <div class="mb-3">
                    <label for="Department_ID" class="form-label">Department_ID</label>
                    <input type="number" class="form-control" name="Department_ID">
                </div>
                <div class="mb-3">
                    <label for="Degree" class="form-label">Degree</label>
                    <input type="text" class="form-control" name="Degree">
                </div>
                <div class="mb-3">
                    <label for="Specialists" class="form-label">Specialists</label>
                    <input type="text" class="form-control" name="Specialists">
                </div>
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>