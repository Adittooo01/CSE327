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
include("connect.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM nurse WHERE Nurse_ID = $id";
    $result = mysqli_query($conn, $sql);
    $nurse = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $Nurse_Name = mysqli_real_escape_string($conn, $_POST['Nurse_Name']);
    $Department_ID = mysqli_real_escape_string($conn, $_POST['Department_ID']);
    $Nurse_Contact_Number = mysqli_real_escape_string($conn, $_POST['Nurse_Contact_Number']);
    $Shift_ID = mysqli_real_escape_string($conn, $_POST['Shift_ID']);

    $sql = "UPDATE nurse SET 
        Nurse_Name = '$Nurse_Name',
        Department_ID = '$Department_ID',
        Nurse_Contact_Number = '$Nurse_Contact_Number',
        Shift_ID= '$Shift_ID'
        WHERE Nurse_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: nurse.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Nurse Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/nurse.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Nurse Info</h2>
        <form action="edit_nurse.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo $nurse['Nurse_ID']; ?>">
            <div class="mb-3">
                <label for="Nurse_Name" class="form-label">Nurse Name</label>
                <input type="text" class="form-control" id="Nurse_Name" name="Nurse_Name" value="<?php echo $nurse['Nurse_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Department_ID" class="form-label">Department ID</label>
                <input type="number" class="form-control" id="Department_ID" name="Department_ID" value="<?php echo $nurse['Department_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Nurse_Contact_Number" class="form-label">Nurse Contact Number</label>
                <input type="number" class="form-control" id="Nurse_Contact_Number" name="Nurse_Contact_Number" value="<?php echo $nurse['Nurse_Contact_Number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Shift_ID" class="form-label">Shift ID</label>
                <input type="number" class="form-control" id="Shift_ID" name="Shift_ID" value="<?php echo $nurse['Shift_ID']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <br>
        <form action="nurse.php?id=<?php echo htmlspecialchars($nurse['Nurse_ID']); ?>" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($nurse['Nurse_ID']); ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
