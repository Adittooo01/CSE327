<!DOCTYPE html>
<html>
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
include("connect.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM medication WHERE Medication_ID = $id";
    $result = mysqli_query($conn, $sql);
    $medication = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $Medication_Name = mysqli_real_escape_string($conn, $_POST['Medication_Name']);
    $Instruction_For_Usage = mysqli_real_escape_string($conn, $_POST['Instruction_For_Usage']);
    $Medicine_Bill = mysqli_real_escape_string($conn, $_POST['Medicine_Bill']);
    $Doctor_ID = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
    $Patient_ID = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
   
    $sql = "UPDATE medication SET 
        Medication_Name = '$Medication_Name',
        Instruction_For_Usage = '$Instruction_For_Usage',
        Medicine_Bill = '$Medicine_Bill',
        Doctor_ID = '$Doctor_ID',
        Patient_ID = '$Patient_ID'
        WHERE Medication_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: medication.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit medication Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/medicine.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container text-center w-25 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Medication Info</h2>
        <form action="edit_medication.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo $medication['Medication_ID']; ?>">
            <div class="mb-3">
                <label for="Medication_Name" class="form-label">Medication Name</label>
                <input type="text" class="form-control" id="Medication_Name" name="Medication_Name" value="<?php echo $medication['Medication_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Instruction_For_Usage" class="form-label">Instruction For Usagee</label>
                <input type="text" class="form-control" id="Instruction_For_Usage" name="Instruction_For_Usage" value="<?php echo $medication['Instruction_For_Usage']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Medicine_Bill" class="form-label"> Medicine Bill</label>
                <input type="number" class="form-control" id=" Medicine_Bill" name=" Medicine_Bill" value="<?php echo $medication['Medicine_Bill']; ?>" required>
            </div>
            <div class="mb-3">
                <label for=" Doctor_ID" class="form-label"> Doctor ID</label>
                <input type="number" class="form-control" id="Doctor_ID" name="Doctor_ID" value="<?php echo $medication['Doctor_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for=" Patient_ID" class="form-label"> Patient ID</label>
                <input type="number" class="form-control" id=" Patient_ID" name=" Patient_ID" value="<?php echo $medication['Patient_ID']; ?>" required>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <br> <!-- Line break here -->
        <form action="medication.php?id=<?php echo htmlspecialchars($medication['Medication_ID']); ?>" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($medication['Medication_ID']); ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
