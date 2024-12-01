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
    $sql = "SELECT * FROM shift WHERE Shift_ID = $id";
    $result = mysqli_query($conn, $sql);
    $shift = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    // $Shift_ID = mysqli_real_escape_string($conn, $_POST['Shift_ID']);
    $Shift_Name = mysqli_real_escape_string($conn, $_POST['Shift_Name']);
    $html_Time = mysqli_real_escape_string($conn,$_POST['Shift_Time']);
    $Shift_Time = date('H:i:s', strtotime($html_Time));
   
    $Nurse_ID = mysqli_real_escape_string($conn, $_POST['Nurse_ID']);
    
    $sql = "UPDATE shift SET 
        -- Shift_ID = '$Shift_ID',
        Shift_Name = '$Shift_Name', 
        Shift_Time = '$Shift_Time',
        Nurse_ID = '$Nurse_ID'
        
        WHERE Shift_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: shift.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Shift Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/shiftnew.webp);background-size: cover;background-repeat: no-repeat;">

    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Shift Info</h2>
        <form action="edit_shift.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo $shift['Shift_ID']; ?>">
            <div class="mb-3">
                <label for="Shift_Name" class="form-label">Shift Name</label>
                <input type="text" class="form-control" id="Shift_Name" name="Shift_Name" value="<?php echo $shift['Shift_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Shift_Time" class="form-label">Shift Time</label>
                <input type="time" class="form-control" id="Shift_Time" name="Shift_Time" value="<?php echo $shift['Shift_Time']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Nurse_ID" class="form-label">Nurse ID</label>
                <input type="number" class="form-control" id="Nurse_ID" name="Nurse_ID" value="<?php echo $shift['Nurse_ID']; ?>" required>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <br>
        <form action="shift.php?id=<?php echo htmlspecialchars($shift['Shift_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($shift['Shift_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
