<!DOCTYPE html>
<html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// session_start(); // Ensure session is started

// Check for admin or doctor access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ($_SESSION["user_type"] != "Admin")) {
    $message = "Require Admin Access";
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

// Fetch the ward record if ID is provided
$ward = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM ward WHERE Ward_Number = $id";
    $result = mysqli_query($conn, $sql);
    $ward = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $ward_type = mysqli_real_escape_string($conn, $_POST['Ward_Type']);
    $available_wards = mysqli_real_escape_string($conn, $_POST['Available_Wards']);
    $bed_id = mysqli_real_escape_string($conn, $_POST['Bed_ID']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $admission_id = mysqli_real_escape_string($conn, $_POST['Admission_ID']);
   
    $sql = "UPDATE ward SET 
        Ward_Type = '$ward_type',
        Available_Wards= '$available_wards', 
        Bed_ID = '$bed_id',
        Patient_ID = '$patient_id',
        Admission_ID = '$admission_id'
        

        WHERE Ward_Number= $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: ward.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Ward Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/ward.jpg); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Ward Info</h2>
        <?php if ($ward): ?>
            <form action="edit_ward.php?id=<?php echo htmlspecialchars($ward['Ward_Number']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($ward['Ward_Number']); ?>">
                <div class="mb-3">
                    <label for="Ward_Type" class="form-label">Ward Type</label>
                    <input type="text" class="form-control" id="Ward_Type" name="Ward_Type" value="<?php echo htmlspecialchars($ward['Ward_Type']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Available_Wards" class="form-label">Available Wards</label>
                    <input type="number" class="form-control" id="Available_Wards" name="Available_Wards" value="<?php echo htmlspecialchars($ward['Available_Wards']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Bed_ID" class="form-label">Bed ID</label>
                    <input type="number" class="form-control" id="Bed_ID" name="Bed_ID" value="<?php echo htmlspecialchars($ward['Bed_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient_ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo htmlspecialchars($ward['Patient_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Admission_ID" class="form-label">Admission_ID</label>
                    <input type="number" class="form-control" id="Admission_ID" name="Admission_ID" value="<?php echo htmlspecialchars($ward['Admission_ID']); ?>" required>
                </div>
               
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="ward.php?id=<?php echo htmlspecialchars($ward['Ward_Number']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($ward['Ward_Number']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No ward record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>