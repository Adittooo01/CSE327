<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin") {
    $message = "Require Admin Access";
    echo "<script>
    alert('$message');
    window.location.href='login.php';
    </script>";
    exit;
} 
include("connect.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM prescription WHERE Prescription_ID = $id";
    $result = mysqli_query($conn, $sql);
    $prescription = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $prescription_date = mysqli_real_escape_string($conn, $_POST['Prescription_Date']);
    $doctor_id = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $medication_id = mysqli_real_escape_string($conn, $_POST['Medication_ID']);

    $sql = "UPDATE prescription SET 
        Prescription_Date = '$prescription_date',
        Doctor_ID = '$doctor_id',
        Patient_ID = '$patient_id', 
        Medication_ID = '$medication_id'
        WHERE Prescription_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: prescription.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Prescription Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/prescription.jpg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Prescription Info</h2>
        <?php if ($prescription): ?>
            <form action="edit_prescription.php?id=<?php echo htmlspecialchars($prescription['Prescription_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo $prescription['Prescription_ID']; ?>">
                <div class="mb-3">
                    <label for="Prescription_Date" class="form-label">Prescription Date</label>
                    <input type="date" class="form-control" id="Prescription_Date" name="Prescription_Date" value="<?php echo $prescription['Prescription_Date']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Doctor_ID" class="form-label">Doctor ID</label>
                    <input type="number" class="form-control" id="Doctor_ID" name="Doctor_ID" value="<?php echo $prescription['Doctor_ID']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo $prescription['Patient_ID']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Medication_ID" class="form-label">Medication ID</label>
                    <input type="number" class="form-control" id="Medication_ID" name="Medication_ID" value="<?php echo $prescription['Medication_ID']; ?>" required>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="prescription.php?id=<?php echo htmlspecialchars($prescription['Prescription_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($prescription['Prescription_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No prescription record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
