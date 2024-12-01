<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the connect.php file to establish a database connection
include "connect.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check for admin or doctor access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ($_SESSION["user_type"] != "Admin" && $_SESSION["user_type"] != "Doctor")) {
    $message = "Require Admin or Doctor Access";
    echo "<script>
    alert('$message');
    window.location.href='login.php';
    </script>";
    exit;
}

// Handle the update request
if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $discharge_date = mysqli_real_escape_string($conn, $_POST['Discharge_Date']);
    $reason_for_discharge = mysqli_real_escape_string($conn, $_POST['Reason_For_Discharge']);
    $summary_of_treatment = mysqli_real_escape_string($conn, $_POST['Summary_of_Treatment']);
    $progress_during_hospital_stay = mysqli_real_escape_string($conn, $_POST['Progress_During_Hospital_Stay']);
   
    $sql = "UPDATE discharge_summary SET 
        Patient_ID = '$patient_id', 
        Discharge_Date = '$discharge_date',
        Reason_For_Discharge = '$reason_for_discharge',
        Summary_of_Treatment = '$summary_of_treatment',
        Progress_During_Hospital_Stay = '$progress_during_hospital_stay'
        WHERE Discharge_Summary_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: patient.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch the discharge summary record if ID is provided
$dischargesummary = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM discharge_summary WHERE Discharge_Summary_ID = $id";
    $result = mysqli_query($conn, $sql);
    $dischargesummary = mysqli_fetch_assoc($result);
}

include("header.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Discharge Summary Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body style="background-image: url(img/patient.webp); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Discharge Summary Info</h2>
        <?php if ($dischargesummary): ?>
            <form action="edit_dischargesummary.php?id=<?php echo htmlspecialchars($dischargesummary['Discharge_Summary_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($dischargesummary['Discharge_Summary_ID']); ?>">
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo htmlspecialchars($dischargesummary['Patient_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Discharge_Date" class="form-label">Discharge Date</label>
                    <input type="date" class="form-control" id="Discharge_Date" name="Discharge_Date" value="<?php echo htmlspecialchars($dischargesummary['Discharge_Date']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Reason_For_Discharge" class="form-label">Reason For Discharge</label>
                    <input type="text" class="form-control" id="Reason_For_Discharge" name="Reason_For_Discharge" value="<?php echo htmlspecialchars($dischargesummary['Reason_For_Discharge']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Summary_of_Treatment" class="form-label">Summary of Treatment</label>
                    <input type="text" class="form-control" id="Summary_of_Treatment" name="Summary_of_Treatment" value="<?php echo htmlspecialchars($dischargesummary['Summary_of_Treatment']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Progress_During_Hospital_Stay" class="form-label">Progress During Hospital Stay</label>
                    <input type="text" class="form-control" id="Progress_During_Hospital_Stay" name="Progress_During_Hospital_Stay" value="<?php echo htmlspecialchars($dischargesummary['Progress_During_Hospital_Stay']); ?>" required>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="dischargesummary.php?id=<?php echo htmlspecialchars($dischargesummary['Discharge_Summary_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($dischargesummary['Discharge_Summary_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No Discharge Summary record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfGmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
