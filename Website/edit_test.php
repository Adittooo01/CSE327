<!DOCTYPE html>
<html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// session_start(); // Ensure session is started

// Check for admin or doctor access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin" ) {
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

// Fetch the test record if ID is provided
$test = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM test WHERE Test_ID = $id";
    $result = mysqli_query($conn, $sql);
    $test = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $test_name = mysqli_real_escape_string($conn, $_POST['Test_Name']);
    $test_bill = mysqli_real_escape_string($conn, $_POST['Test_Bill']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
   
    $sql = "UPDATE test SET 
        Test_Name = '$test_name',
        Test_Bill= '$test_bill', 
        Patient_ID = '$patient_id'
    
    

        WHERE Test_ID= $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: test.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Test Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/test.jpg); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Test Info</h2>
        <?php if ($test): ?>
            <form action="edit_test.php?id=<?php echo htmlspecialchars($test['Test_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($test['Test_ID']); ?>">
                <div class="mb-3">
                    <label for="Test_Name" class="form-label">Test Name</label>
                    <input type="text" class="form-control" id="Test_Name" name="Test_Name" value="<?php echo htmlspecialchars($test['Test_Name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Test_Bill" class="form-label">Test bill</label>
                    <input type="number" class="form-control" id="Test_Bill" name="Test_Bill" value="<?php echo htmlspecialchars($test['Test_Bill']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient_ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo htmlspecialchars($test['Patient_ID']); ?>" required>
                </div>
                
               
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="test.php?id=<?php echo htmlspecialchars($test['Test_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($test['Test_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No test record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>