<!DOCTYPE html>
<html>

<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include("connect.php");

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM billing WHERE Billing_ID = $id_to_delete";

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
    <title>Billing Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/billing.jpg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
            <a href="input_billing.php" class="btn btn-primary">Register Billing</a>
        <?php endif; ?>
        <h2 class="text-center mb-4">All Billing's List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Billing ID</th>
                        <th>Billing Date</th>
                        <th>Patient ID</th>

                        <th>Medication ID</th>
                        <th>Medicine Bill</th>
                        <th>Test Bill</th>
                        <th>Doctor Bill</th>
                        <th>Total Bill</th>

                        <th>Actions</th> <!-- Add a new column for actions --> 
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM billing ORDER BY Billing_ID";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>".$row["Billing_ID"]."</td>
                                <td>".$row["Billing_Date"]."</td>
                                <td>".$row["Patient_ID"]."</td>
                                <td>".$row["Medication_ID"]."</td>
                                <td>".$row["Medicine_Bill"]."</td>
                                
                                <td>".$row["Test_Bill"]."</td>
                                <td>".$row["Doctor_Bill"]."</td>
                                <td>".$row["Total_Bill"]."</td>
                             
                                <td>";
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                                echo "<a href='edit_billing.php?id=".$row["Billing_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
                            }
                            echo "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfGmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
