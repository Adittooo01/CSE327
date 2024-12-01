<!DOCTYPE html>
<html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// session_start(); // Ensure session is started

// Check for admin or doctor access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ($_SESSION["user_type"] != "Admin" && $_SESSION["user_type"] != "Doctor")) {
    $message = "Require Admin or Doctor Access";
    echo "<script>
    alert('$message');
    window.location.href='login.php';
    </script>";
    exit;
}

include("connect.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the admission record if ID is provided
$admission = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM admission WHERE Admission_ID = $id";
    $result = mysqli_query($conn, $sql);
    $admission = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $admission_date = mysqli_real_escape_string($conn, $_POST['Admission_Date']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $doctor_id = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
    $ward_number = mysqli_real_escape_string($conn, $_POST['Ward_Number']);
    $room_number = mysqli_real_escape_string($conn, $_POST['Room_Number']);
    $bed_number = mysqli_real_escape_string($conn, $_POST['Bed_Number']);

    $sql = "UPDATE admission SET 
        Admission_Date = '$admission_date',
        Patient_ID = '$patient_id', 
        Doctor_ID = '$doctor_id',
        Ward_Number = '$ward_number',
        Room_Number = '$room_number',
        Bed_Number = '$bed_number'
        WHERE Admission_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: admission.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Admission Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/admission.webp); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Admission Info</h2>
        <?php if ($admission): ?>
            <form action="edit_admission.php?id=<?php echo htmlspecialchars($admission['Admission_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($admission['Admission_ID']); ?>">
                <div class="mb-3">
                    <label for="Admission_Date" class="form-label">Admission Date</label>
                    <input type="date" class="form-control" id="Admission_Date" name="Admission_Date" value="<?php echo htmlspecialchars($admission['Admission_Date']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo htmlspecialchars($admission['Patient_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor ID</label>
                    <input type="number" class="form-control" id="Doctor_ID" name="Doctor_ID" value="<?php echo htmlspecialchars($admission['Doctor_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Ward_Number" class="form-label">Ward Number</label>
                    <input type="number" class="form-control" id="Ward_Number" name="Ward_Number" value="<?php echo htmlspecialchars($admission['Ward_Number']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Room_Number" class="form-label">Room Number</label>
                    <input type="number" class="form-control" id="Room_Number" name="Room_Number" value="<?php echo htmlspecialchars($admission['Room_Number']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Bed_Number" class="form-label">Bed Number</label>
                    <input type="number" class="form-control" id="Bed_Number" name="Bed_Number" value="<?php echo htmlspecialchars($admission['Bed_Number']); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="admission.php?id=<?php echo htmlspecialchars($admission['Admission_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($admission['Admission_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No admission record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
