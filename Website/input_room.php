<!DOCTYPE html>
<html>
<head>
    <title>Room Info Page</title>
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
    
        $Room_Number = $_POST['Room_Number'];
        $Room_Type = $_POST['Room_Type'];
        $Available_Rooms = $_POST['Available_Rooms'];
        $Bed_ID = $_POST['Bed_ID'];
        $Patient_ID = $_POST['Patient_ID'];
        $Admission_ID = $_POST['Admission_ID'];
        
      
    
        $sql = "INSERT INTO room (Room_Number, Room_Type, Available_Rooms, Bed_ID, Patient_ID, Admission_ID) 
        VALUES ('$Room_Number', '$Room_Type', '$Available_Rooms', '$Bed_ID', '$Patient_ID', '$Admission_ID')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: room.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>


<body style="background-image: url(img/room.jpg);background-size: cover;background-repeat: no-repeat;">

<body style="background-image: url(img/room.jpg);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Room </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_room.php">
            <div class="mb-3">
                    <label for="Room_Number" class="form-label">Room_Number</label>
                    <input type="number" class="form-control" name="Room_Number">
                </div>
                <div class="mb-3">
                    <label for="Room_Type" class="form-label">Room_Type</label>
                    <input type="text" class="form-control" name="Room_Type">
                </div>
                <div class="mb-3">
                    <label for="Available_Rooms" class="form-label">Available_Rooms</label>
                    <input type="number" class="form-control" name="Available_Rooms">
                </div>
                <div class="mb-3">
                    <label for="Bed_ID" class="form-label">Bed_ID</label>
                    <input type="number" class="form-control" name="Bed_ID">
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient_ID</label>
                    <input type="number" class="form-control" name="Patient_ID">
                </div>
                <div class="mb-3">
                    <label for="Admission_ID" class="form-label">Admission_ID</label>
                    <input type="number" class="form-control" name="Admission_ID">
                </div>
                
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>