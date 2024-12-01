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
    $sql = "DELETE FROM patient WHERE Patient_ID = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: patient.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}
?>

<head>
    <title>Patient Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/patientprofile.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
            <a href="input_patient.php" class="btn btn-primary">Register Patient</a>
            
                <a href="input_dischargesummary.php" class="btn btn-primary">Register Discharge Summary</a>
        <?php endif; ?>
        <h2 class="text-center mb-4">All Patient's List</h2>
        <form class="d-flex justify-content-center mb-4" method="GET" action="">
            <input class="form-control w-50" type="text" name="search" placeholder="Search by Patient Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-info ms-2" type="submit">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Patient Age</th>
                        <th>Patient Gender</th>
                        <th>Patient Contact Number</th>
                        <th>Doctor ID</th>
                        <th>Prescription ID</th>
                        <th>Medication ID</th>
                        <th>Admission ID</th>
                        <th>Ward Number</th>
                        <th>Room Number</th>
                        <th>Bed Number</th>
                        <th>Billing ID</th>
                        <th>Bill Amount</th>
                        <th>Billing Date</th>
                        <th>Installment ID</th>
                        <th>Installment Numbers</th>
                        <th>Payment Per Installment</th>
                        <th>Payment ID</th>
                        <th>Paid Amount</th>
                        <th>Payment Date</th>
                        <th>Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($searchTerm) {
                        $sql = "SELECT p.*, d.Discharge_Summary_ID 
                        FROM patient p 
                        LEFT JOIN discharge_summary d 
                        ON p.Patient_ID = d.Patient_ID 
                        WHERE Patient_Name LIKE '%$searchTerm%' 
                        ORDER BY p.Patient_ID;";
                    } else {
                        $sql = "SELECT p.*, d.Discharge_Summary_ID  FROM patient p LEFT JOIN discharge_summary d 
                        ON p.Patient_ID = d.Patient_ID ORDER BY p.Patient_ID";
                    }
                    // $sql = "SELECT p.*, d.Discharge_Summary_ID 
                    // FROM patient p 
                    // LEFT JOIN discharge_summary d 
                    // ON p.Patient_ID = d.Patient_ID 
                    // ORDER BY p.Patient_ID; ";
                   
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>".$row["Patient_ID"]."</td>
                                <td>".$row["Patient_Name"]."</td>
                                <td>".$row["Patient_Age"]."</td>
                                <td>".$row["Patient_Gender"]."</td>
                                <td>".$row["Patient_Contact_Number"]."</td>
                                <td>".$row["Doctor_ID"]."</td>
                                <td>".$row["Prescription_ID"]."</td>
                                <td>".$row["Medication_ID"]."</td>
                                <td>".$row["Admission_ID"]."</td>
                                <td>".$row["Ward_Number"]."</td>
                                <td>".$row["Room_Number"]."</td>
                                <td>".$row["Bed_Number"]."</td>
                                <td>".$row["Billing_ID"]."</td>
                                <td>".$row["Bill_Amount"]."</td>
                                <td>".$row["Billing_Date"]."</td>
                                <td>".$row["Installment_ID"]."</td>
                                <td>".$row["Installment_Numbers"]."</td>
                                <td>".$row["Payment_Per_Installment"]."</td>
                                <td>".$row["Payment_ID"]."</td>
                                <td>".$row["Paid_Amount"]."</td>
                                <td>".$row["Payment_Date"]."</td>
                                <td>";
                                
                            
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                                echo "<a href='edit_patient.php?id=".$row["Patient_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
                                echo "<a href='dischargesummary.php?id=".$row["Discharge_Summary_ID"]."' class='btn btn-success btn-sm'>Discharge Summary</a>";
                            }
                            echo "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='21' class='text-center'>No records found</td></tr>";
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
