<!DOCTYPE html>
<html>
<head>
    <title>Payment Info Page</title>
</head>

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

    if(isset($_POST['submit'])){
        include "connect.php";
    
        $Payment_ID = $_POST['Payment_ID'];
        $Billing_ID = $_POST['Billing_ID'];
        $Total_Bill = $_POST['Total_Bill'];
        $Installment_ID = $_POST['Installment_ID'];
        $Installment_Numbers = $_POST['Installment_Numbers'];
        $Payment_Per_Installment = $_POST['Payment_Per_Installment'];
        $Paid_Amount = $_POST['Paid_Amount'];
        $Payment_Date = $_POST['Payment_Date'];
      
    
        $sql = "INSERT INTO payment (Payment_ID, Billing_ID, Total_Bill, Installment_ID, Installment_Numbers, Payment_Per_Installment, Paid_Amount, Payment_Date) 
        VALUES ('$Payment_ID', '$Billing_ID', '$Total_Bill', '$Installment_ID', '$Installment_Numbers', '$Payment_Per_Installment', '$Paid_Amount',  '$Payment_Date')";
    
        if(mysqli_query($conn, $sql)){
            // flush(); // Flush the buffer
            // ob_flush();
            header('Location: payment.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    
    }
    include("header.php");
?>




<body style="background-image: url(img/payment.jpeg);background-size: cover;background-repeat: no-repeat;">
    
    <div class="container p-5 my-5 bg-light opacity-100 border-info  card h-100 border border-5">
    <h3 class="text-center"> Register New Payment </h3>
        <div class="w-50 mx-auto p-3 border text-center border-info  card h-100 border border-2">

            <form method="POST" action="input_payment.php">
            <div class="mb-3">
                    <label for="Payment_ID" class="form-label">Payment ID</label>
                    <input type="number" class="form-control" name="Payment_ID">
                </div>
                <div class="mb-3">
                    <label for="Billing_ID" class="form-label">Billing ID</label>
                    <input type="number" class="form-control" name="Billing_ID">
                </div>
                <div class="mb-3">
                    <label for="Total_Bill" class="form-label">Total Bill</label>
                    <input type="number" class="form-control" name="Total_Bill">
                </div>
                <div class="mb-3">
                    <label for="Installment_ID" class="form-label">Installment ID</label>
                    <input type="number" class="form-control" name="Installment_ID">
                </div>
                <div class="mb-3">
                    <label for="Installment_Numbers" class="form-label">Installment Numbers</label>
                    <input type="number" class="form-control" name="Installment_Numbers">
                </div>
                <div class="mb-3">
                    <label for="Payment_Per_Installment" class="form-label">Payment Per Installment</label>
                    <input type="number" class="form-control" name="Payment_Per_Installment">
                </div>
                <div class="mb-3">
                    <label for="Paid_Amount" class="form-label">Paid Amount</label>
                    <input type="number" class="form-control" name="Paid_Amount">
                </div>
                <div class="mb-3">
                    <label for="Payment_Date" class="form-label">Payment Date</label>
                    <input type="date" class="form-control" name="Payment_Date">
                </div>
                
                
                <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>
</html>