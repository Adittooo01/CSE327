<!DOCTYPE html>
<html>

<?php
session_start(); 

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// Include the connect.php file to establish a database connection
include "connect.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle the delete request
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM discharge_summary WHERE Discharge_Summary_ID = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        // Redirect to index.php after successful deletion
        header('Location: dischargesummary.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch discharge summary details if id is set
$dischargesummary = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT d.*, p.Patient_ID, p.Patient_Name
        FROM discharge_summary d
        LEFT JOIN patient p ON d.Patient_ID = p.Patient_ID
        WHERE Discharge_Summary_ID = $id";

    $result = mysqli_query($conn, $sql);
    $dischargesummary = mysqli_fetch_assoc($result);
}
include("header.php");
?>

<head>
    <title>Discharge Summary Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/patient.webp);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-75 border-info card h-100 border border-5">
    
        <?php if ($dischargesummary): ?>
        <h3 class="text-center"><?php echo htmlspecialchars($dischargesummary["Patient_Name"]); ?>'s Discharge Summary Details</h3>
        <div class="justify-content-center w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <!-- <h4>General Info</h4> -->
            <p>Discharge Summary ID: <?php echo htmlspecialchars($dischargesummary["Discharge_Summary_ID"]); ?></p>
            <p>Patient ID: <?php echo htmlspecialchars($dischargesummary["Patient_ID"]); ?></p>
            <p>Discharge Date: <?php echo htmlspecialchars($dischargesummary["Discharge_Date"]); ?></p>
            <p>Reason For Discharge: <?php echo htmlspecialchars($dischargesummary["Reason_For_Discharge"]); ?></p>
            <p>Summary of Treatment: <?php echo htmlspecialchars($dischargesummary["Summary_of_Treatment"]); ?></p>
            <p>Progress During Hospital Stay: <?php echo htmlspecialchars($dischargesummary["Progress_During_Hospital_Stay"]); ?></p>
        </div>

        <div class="container mt-2 text-center">
            <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
                <a href="edit_dischargesummary.php?id=<?php echo htmlspecialchars($dischargesummary['Discharge_Summary_ID']); ?>" class="btn btn-primary">Edit Discharge Summary</a>
                <!-- <a href="input_dischargesummary.php" class="btn btn-primary">Register Discharge Summary</a> -->
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p class="text-center">No discharge summary found.</p>
       
        <?php endif; ?>
    </div>
</body>
</html>
