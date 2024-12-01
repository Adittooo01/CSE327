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
$installment = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM installment WHERE Installment_ID = $id";
    $result = mysqli_query($conn, $sql);
    $installment = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $Installment_Numbers = mysqli_real_escape_string($conn, $_POST['Installment_Numbers']);
    $Payment_Per_Installment = mysqli_real_escape_string($conn, $_POST['Payment_Per_Installment']);
    $Billing_ID = mysqli_real_escape_string($conn, $_POST['Billing_ID']);
    $Total_Bill = mysqli_real_escape_string($conn, $_POST['Total_Bill']);
    $Payment_ID = mysqli_real_escape_string($conn, $_POST['Payment_ID']);
   


    $sql = "UPDATE installment SET 
    
        Installment_Numbers = '$Installment_Numbers',
        Payment_Per_Installment = '$Payment_Per_Installment',
        Billing_ID = '$Billing_ID',
        Total_Bill = '$Total_Bill', 
       
        Payment_ID = '$Payment_ID'
       
        WHERE Installment_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: installment.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Installment Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/installment.jpeg); background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Installment Info</h2>
        <?php if ($installment): ?>
        

            <form action= "edit_installment.php?id=<?php echo htmlspecialchars($installment['Installment_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($installment['Installment_ID']); ?>">
                
                <div class="mb-3">
                    <label for="Installment_Numbers" class="form-label">Installment Numbers</label>
                    <input type="number" class="form-control" id="Installment_Numbers" name="Installment_Numbers" value="<?php echo htmlspecialchars($installment['Installment_Numbers']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Payment_Per_Installment" class="form-label">Payment Per Installment</label>
                    <input type="number" class="form-control" id="Payment_Per_Installment" name="Payment_Per_Installment" value="<?php echo htmlspecialchars($installment['Payment_Per_Installment']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Billing_ID" class="form-label">Billing ID</label>
                    <input type="number" class="form-control" id="Billing_ID" name="Billing_ID" value="<?php echo htmlspecialchars($installment['Billing_ID']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Total_Bill" class="form-label">Total Bill</label>
                    <input type="number" class="form-control" id="Total_Bill" name="Total_Bill" value="<?php echo htmlspecialchars($installment['Total_Bill']); ?>" required>
                </div>
               
                <div class="mb-3">
                    <label for="Payment_ID" class="form-label">Payment ID</label>
                    <input type="number" class="form-control" id="Payment_ID" name="Payment_ID" value="<?php echo htmlspecialchars($installment['Payment_ID']); ?>" required>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="installment.php?id=<?php echo htmlspecialchars($installment['Installment_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($installment['Installment_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No installment record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
