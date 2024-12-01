<!DOCTYPE html>
<html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check for admin access
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin") {
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

// Fetch the billing record if ID is provided
$billing = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM billing WHERE Billing_ID = $id";
    $result = mysqli_query($conn, $sql);
    $billing = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $billing_date = mysqli_real_escape_string($conn, $_POST['Billing_Date']);
    $patient_id = mysqli_real_escape_string($conn, $_POST['Patient_ID']);
    $medication_id = mysqli_real_escape_string($conn, $_POST['Medication_ID']);
    $medicine_bill = mysqli_real_escape_string($conn, $_POST['Medicine_Bill']);
    $test_bill = mysqli_real_escape_string($conn, $_POST['Test_Bill']);
    $doctor_bill = mysqli_real_escape_string($conn, $_POST['Doctor_Bill']);
    $total_bill = mysqli_real_escape_string($conn, $_POST['Total_Bill']);

    $sql = "UPDATE billing SET 
        Billing_Date = '$billing_date',
        Patient_ID = '$patient_id', 
        Medication_ID = '$medication_id',
        Medicine_Bill = '$medicine_bill',
        Test_Bill = '$test_bill',
        Doctor_Bill = '$doctor_bill',
        Total_Bill = '$total_bill'
        WHERE Billing_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: billing.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Billing Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/billing.jpg); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Billing Info</h2>
        <?php if ($billing): ?>
            <form action="edit_billing.php?id=<?php echo htmlspecialchars($billing['Billing_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($billing['Billing_ID']); ?>">
                <div class="mb-3">
                    <label for="Billing_Date" class="form-label">Billing Date</label>
                    <input type="date" class="form-control" id="Billing_Date" name="Billing_Date" value="<?php echo htmlspecialchars($billing['Billing_Date']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Patient_ID" class="form-label">Patient ID</label>
                    <input type="number" class="form-control" id="Patient_ID" name="Patient_ID" value="<?php echo htmlspecialchars($billing['Patient_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Medication_ID" class="form-label">Medication ID</label>
                    <input type="number" class="form-control" id="Medication_ID" name="Medication_ID" value="<?php echo htmlspecialchars($billing['Medication_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Medicine_Bill" class="form-label">Medicine Bill</label>
                    <input type="number" class="form-control" id="Medicine_Bill" name="Medicine_Bill" value="<?php echo htmlspecialchars($billing['Medicine_Bill']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Test_Bill" class="form-label">Test Bill</label>
                    <input type="number" class="form-control" id="Test_Bill" name="Test_Bill" value="<?php echo htmlspecialchars($billing['Test_Bill']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Doctor_Bill" class="form-label">Doctor Bill</label>
                    <input type="number" class="form-control" id="Doctor_Bill" name="Doctor_Bill" value="<?php echo htmlspecialchars($billing['Doctor_Bill']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Total_Bill" class="form-label">Total Bill</label>
                    <input type="number" class="form-control" id="Total_Bill" name="Total_Bill" value="<?php echo htmlspecialchars($billing['Total_Bill']); ?>" required>
                </div>
               
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="billing.php?id=<?php echo htmlspecialchars($billing['Billing_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($billing['Billing_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No billing record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
