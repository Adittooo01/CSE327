<!DOCTYPE html>
<html>
<head>
    <title>Installment Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
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

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $Installment_ID = mysqli_real_escape_string($conn, $_POST['Installment_ID']);
    $Installment_Numbers = mysqli_real_escape_string($conn, $_POST['Installment_Numbers']);
    $Payment_Per_Installment = mysqli_real_escape_string($conn, $_POST['Payment_Per_Installment']);
    $Billing_ID = mysqli_real_escape_string($conn, $_POST['Billing_ID']);
    $Total_Bill = mysqli_real_escape_string($conn, $_POST['Total_Bill']);
    $Payment_ID = mysqli_real_escape_string($conn, $_POST['Payment_ID']);

    $sql = "INSERT INTO installment (Installment_ID, Installment_Numbers, Payment_Per_Installment, Billing_ID, Total_Bill, Payment_ID) 
            VALUES ('$Installment_ID', '$Installment_Numbers', '$Payment_Per_Installment', '$Billing_ID', '$Total_Bill', '$Payment_ID')";

    if (mysqli_query($conn, $sql)) {
        header('Location: installment.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

include("header.php");
?>
<body style="background-image: url(img/installment.jpeg); background-size: cover; background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-100 border-info card h-100 border border-5">
        <h3 class="text-center">Register New Installment</h3>
        <div class="w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <form method="POST" action="input_installment.php">
                <div class="mb-3">
                    <label for="Installment_ID" class="form-label">Installment ID</label>
                    <input type="number" class="form-control" name="Installment_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Installment_Numbers" class="form-label">Installment Numbers</label>
                    <input type="number" class="form-control" name="Installment_Numbers" required>
                </div>
                <div class="mb-3">
                    <label for="Payment_Per_Installment" class="form-label">Payment Per Installment</label>
                    <input type="number" class="form-control" name="Payment_Per_Installment" required>
                </div>
                <div class="mb-3">
                    <label for="Billing_ID" class="form-label">Billing ID</label>
                    <input type="number" class="form-control" name="Billing_ID" required>
                </div>
                <div class="mb-3">
                    <label for="Total_Bill" class="form-label">Total Bill</label>
                    <input type="number" class="form-control" name="Total_Bill" required>
                </div>
                <div class="mb-3">
                    <label for="Payment_ID" class="form-label">Payment ID</label>
                    <input type="number" class="form-control" name="Payment_ID" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
