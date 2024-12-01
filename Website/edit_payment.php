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

// Fetch the admission record if ID is provided
$payment = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM payment WHERE Payment_ID = $id";
    $result = mysqli_query($conn, $sql);
    $payment = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $Billing_ID = mysqli_real_escape_string($conn, $_POST['Billing_ID']);
    $Total_Bill = mysqli_real_escape_string($conn, $_POST['Total_Bill']);
    $Installment_ID = mysqli_real_escape_string($conn, $_POST['Installment_ID']);
    $Installment_Numbers = mysqli_real_escape_string($conn, $_POST['Installment_Numbers']);
    $Payment_Per_Installment = mysqli_real_escape_string($conn, $_POST['Payment_Per_Installment']);
    $Paid_Amount = mysqli_real_escape_string($conn, $_POST['Paid_Amount']);
    $Payment_Date = mysqli_real_escape_string($conn, $_POST['Payment_Date']);


    $sql = "UPDATE payment SET 
        Billing_ID = '$Billing_ID',
        Total_Bill = '$Total_Bill', 
        Installment_ID = '$Installment_ID',
        Installment_Numbers = '$Installment_Numbers',
        Payment_Per_Installment = '$Payment_Per_Installment',
        Paid_Amount = '$Paid_Amount',
        Payment_Date = '$Payment_Date'
        WHERE Payment_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: payment.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Payment Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/payment.jpeg); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Payment Info</h2>
        <?php if ($payment): ?>
        

            <form action= "edit_payment.php?id=<?php echo htmlspecialchars($payment['Payment_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($payment['Payment_ID']); ?>">
                <div class="mb-3">
                    <label for="Billing_ID" class="form-label">Billing ID</label>
                    <input type="number" class="form-control" id="Billing_ID" name="Billing_ID" value="<?php echo htmlspecialchars($payment['Billing_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Total_Bill" class="form-label">Total Bill</label>
                    <input type="number" class="form-control" id="Total_Bill" name="Total_Bill" value="<?php echo htmlspecialchars($payment['Total_Bill']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Installment_ID" class="form-label">Installment ID</label>
                    <input type="number" class="form-control" id="Installment_ID" name="Installment_ID" value="<?php echo htmlspecialchars($payment['Installment_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Installment_Numbers" class="form-label">Installment Numbers</label>
                    <input type="number" class="form-control" id="Installment_Numbers" name="Installment_Numbers" value="<?php echo htmlspecialchars($payment['Installment_Numbers']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Payment_Per_Installment" class="form-label">Payment Per Installment</label>
                    <input type="number" class="form-control" id="Payment_Per_Installment" name="Payment_Per_Installment" value="<?php echo htmlspecialchars($payment['Payment_Per_Installment']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Paid_Amount" class="form-label">Paid Amount</label>
                    <input type="number" class="form-control" id="Paid_Amount" name="Paid_Amount" value="<?php echo htmlspecialchars($payment['Paid_Amount']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Payment_Date" class="form-label">Payment Date</label>
                    <input type="date" class="form-control" id="Payment_Date" name="Payment_Date" value="<?php echo htmlspecialchars($payment['Payment_Date']); ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="payment.php?id=<?php echo htmlspecialchars($payment['Payment_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($payment['Payment_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No payment record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
