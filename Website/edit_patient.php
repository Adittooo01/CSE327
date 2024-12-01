<!DOCTYPE html>
<html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ($_SESSION["user_type"] != "Admin" && $_SESSION["user_type"] != "Doctor")) {
    $message = "Require Admin or Doctor Access";
    echo "<script>
        alert('$message');
        window.location.href='login.php';
    </script>";
    exit;
}
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin"){
//     $message = "Require Admin Access";
//     echo "<script>
//     alert('$message');
//     window.location.href='login.php';
//     </script>";
//     exit;
// } 
include("connect.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM patient WHERE Patient_ID = $id";
    $result = mysqli_query($conn, $sql);
    $patient = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $patient_name = mysqli_real_escape_string($conn, $_POST['Patient_Name']);
    $patient_age = mysqli_real_escape_string($conn, $_POST['Patient_Age']);
    $patient_gender = mysqli_real_escape_string($conn, $_POST['Patient_Gender']);
    $patient_contact_number = mysqli_real_escape_string($conn, $_POST['Patient_Contact_Number']);
    $doctor_id = mysqli_real_escape_string($conn, $_POST['Doctor_ID']);
    $medication_id = mysqli_real_escape_string($conn, $_POST['Medication_ID']);
    $admission_id = mysqli_real_escape_string($conn, $_POST['Admission_ID']);
    $ward_number = mysqli_real_escape_string($conn, $_POST['Ward_Number']);
    $room_number = mysqli_real_escape_string($conn, $_POST['Room_Number']);
    $bed_number = mysqli_real_escape_string($conn, $_POST['Bed_Number']);
    $billing_id = mysqli_real_escape_string($conn, $_POST['Billing_ID']);
    $bill_amount = mysqli_real_escape_string($conn, $_POST['Bill_Amount']);
    $billing_date = mysqli_real_escape_string($conn, $_POST['Billing_Date']);
    $installment_id = mysqli_real_escape_string($conn, $_POST['Installment_ID']);
    $installment_numbers = mysqli_real_escape_string($conn, $_POST['Installment_Numbers']);
    $payment_per_installment = mysqli_real_escape_string($conn, $_POST['Payment_Per_Installment']);
    $payment_id = mysqli_real_escape_string($conn, $_POST['Payment_ID']);
    $paid_amount = mysqli_real_escape_string($conn, $_POST['Paid_Amount']);
    $payment_date = mysqli_real_escape_string($conn, $_POST['Payment_Date']);

    $sql = "UPDATE patient SET 
        Patient_Name = '$patient_name', 
        Patient_Age = '$patient_age', 
        Patient_Gender = '$patient_gender',
        Patient_Contact_Number = '$patient_contact_number',
        Doctor_ID = '$doctor_id',
        Medication_ID = '$medication_id',
        Admission_ID = '$admission_id',
        Ward_Number = '$ward_number',
        Room_Number = '$room_number',
        Bed_Number = '$bed_number',
        Billing_ID = '$billing_id',
        Bill_Amount = '$bill_amount',
        Billing_Date = '$billing_date',
        Installment_ID = '$installment_id',
        Installment_Numbers = '$installment_numbers',
        Payment_Per_Installment = '$payment_per_installment',
        Payment_ID = '$payment_id',
        Paid_Amount = '$paid_amount',
        Payment_Date = '$payment_date'
        WHERE Patient_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: patient.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Patient Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/patientprofile.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container w-50 text-center p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Patient Info</h2>
        <form action="edit_patient.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo $patient['Patient_ID']; ?>">
            <div class="mb-3">
                <label for="Patient_Name" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="Patient_Name" name="Patient_Name" value="<?php echo $patient['Patient_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Patient_Age" class="form-label">Patient Age</label>
                <input type="number" class="form-control" id="Patient_Age" name="Patient_Age" value="<?php echo $patient['Patient_Age']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Patient_Gender" class="form-label">Patient Gender</label>
                <input type="text" class="form-control" id="Patient_Gender" name="Patient_Gender" value="<?php echo $patient['Patient_Gender']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Patient_Contact_Number" class="form-label">Patient Contact Number</label>
                <input type="number" class="form-control" id="Patient_Contact_Number" name="Patient_Contact_Number" value="<?php echo $patient['Patient_Contact_Number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Doctor_ID" class="form-label">Doctor ID</label>
                <input type="number" class="form-control" id="Doctor_ID" name="Doctor_ID" value="<?php echo $patient['Doctor_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Medication_ID" class="form-label">Medication ID</label>
                <input type="number" class="form-control" id="Medication_ID" name="Medication_ID" value="<?php echo $patient['Medication_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Admission_ID" class="form-label">Admission ID</label>
                <input type="number" class="form-control" id="Admission_ID" name="Admission_ID" value="<?php echo $patient['Admission_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Ward_Number" class="form-label">Ward Number</label>
                <input type="number" class="form-control" id="Ward_Number" name="Ward_Number" value="<?php echo $patient['Ward_Number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Room_Number" class="form-label">Room Number</label>
                <input type="number" class="form-control" id="Room_Number" name="Room_Number" value="<?php echo $patient['Room_Number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Bed_Number" class="form-label">Bed Number</label>
                <input type="number" class="form-control" id="Bed_Number" name="Bed_Number" value="<?php echo $patient['Bed_Number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Billing_ID" class="form-label">Billing ID</label>
                <input type="number" class="form-control" id="Billing_ID" name="Billing_ID" value="<?php echo $patient['Billing_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Bill_Amount" class="form-label">Bill Amount</label>
                <input type="number" class="form-control" id="Bill_Amount" name="Bill_Amount" value="<?php echo $patient['Bill_Amount']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Billing_Date" class="form-label">Billing Date</label>
                <input type="date" class="form-control" id="Billing_Date" name="Billing_Date" value="<?php echo $patient['Billing_Date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Installment_ID" class="form-label">Installment ID</label>
                <input type="number" class="form-control" id="Installment_ID" name="Installment_ID" value="<?php echo $patient['Installment_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Installment_Numbers" class="form-label">Installment Numbers</label>
                <input type="number" class="form-control" id="Installment_Numbers" name="Installment_Numbers" value="<?php echo $patient['Installment_Numbers']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Payment_Per_Installment" class="form-label">Payment Per Installment</label>
                <input type="number" class="form-control" id="Payment_Per_Installment" name="Payment_Per_Installment" value="<?php echo $patient['Payment_Per_Installment']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Payment_ID" class="form-label">Payment ID</label>
                <input type="number" class="form-control" id="Payment_ID" name="Payment_ID" value="<?php echo $patient['Payment_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Paid_Amount" class="form-label">Paid Amount</label>
                <input type="number" class="form-control" id="Paid_Amount" name="Paid_Amount" value="<?php echo $patient['Paid_Amount']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Payment_Date" class="form-label">Payment Date</label>
                <input type="date" class="form-control" id="Payment_Date" name="Payment_Date" value="<?php echo $patient['Payment_Date']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>

        <br>
        <form action="patient.php?id=<?php echo htmlspecialchars($patient['Patient_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($patient['Patient_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
