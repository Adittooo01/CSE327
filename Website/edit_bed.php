<!DOCTYPE html>
<html>
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

// session_start(); // Ensure session is started

// Check for admin or doctor access
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ($_SESSION["user_type"] != "Admin" && $_SESSION["user_type"] != "Doctor")) {
//     $message = "Require Admin or Doctor Access";
//     echo "<script>
//     alert('$message');
//     window.location.href='login.php';
//     </script>";
//     exit;
// }

include("connect.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the bed record if ID is provided
$bed = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM bed WHERE Bed_Number = $id";
    $result = mysqli_query($conn, $sql);
    $bed = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $bed_type = mysqli_real_escape_string($conn, $_POST['Bed_Type']);
    $available_beds = mysqli_real_escape_string($conn, $_POST['Available_Beds']);
    $ward_number = mysqli_real_escape_string($conn, $_POST['Ward_Number']);
    $room_number = mysqli_real_escape_string($conn, $_POST['Room_Number']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $admission_id = mysqli_real_escape_string($conn, $_POST['Admission_ID']);

    $sql = "UPDATE bed SET 
        -- Bed_Number = '$bed_number',
        Bed_Type = '$bed_type',
        Available_Beds= '$available_beds',
        
        Ward_Number = '$ward_number',
        Room_Number = '$room_number',
        Patient_ID = '$patient_id', 
        Admission_ID = '$admission_id'
        
        WHERE Bed_Number = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: bed.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Bed Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/bed.webp); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Bed Info</h2>
        <?php if ($bed): ?>
            <form action="edit_bed.php?id=<?php echo htmlspecialchars($bed['Bed_Number']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($bed['Bed_Number']); ?>">
                <div class="mb-3">
                    <label for="Bed_Type" class="form-label">Bed Type</label>
                    <input type="text" class="form-control" id="Bed_Type" name="Bed_Type" value="<?php echo htmlspecialchars($bed['Bed_Type']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Available_Beds" class="form-label">Available Beds</label>
                    <input type="number" class="form-control" id="Available_Beds" name="Available_Beds" value="<?php echo htmlspecialchars($bed['Available_Beds']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Ward_Number" class="form-label">Ward Number</label>
                    <input type="number" class="form-control" id="Ward_Number" name="Ward_Number" value="<?php echo htmlspecialchars($bed['Ward_Number']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Room_Number" class="form-label">Room Number</label>
                    <input type="number" class="form-control" id="Room_Number" name="Room_Number" value="<?php echo htmlspecialchars($bed['Room_Number']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo htmlspecialchars($bed['Patient_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Admission_ID" class="form-label">Admission ID</label>
                    <input type="number" class="form-control" id="Admission_ID" name="Admission_ID" value="<?php echo htmlspecialchars($bed['Admission_ID']); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="bed.php?id=<?php echo htmlspecialchars($bed['Bed_Number']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($bed['Bed_Number']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No bed record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>