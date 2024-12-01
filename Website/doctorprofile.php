<!DOCTYPE html>
<html>

<?php
//session_start();


// Include the connect.php file to establish a database connection
include "connect.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle the delete request
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM doctor WHERE Doctor_ID = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        // Redirect to index.php after successful deletion
        header('Location: doctor.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch doctor details if id is set
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "
        SELECT d.*, dp.Institutes, dp.doctor_Contact_Number, dp.Doctor_Bill, dt.Department_ID, dt.Department_name
        FROM doctor d
        LEFT JOIN department dt USING (Department_ID)
        LEFT JOIN doctor_profile dp USING (Doctor_ID)
        WHERE Doctor_ID = $id";

    $result = mysqli_query($conn, $sql);
    $doctor = mysqli_fetch_assoc($result);
}
include("header.php");
?>

<head>
    <title>Doctor Profile Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/doctorpage.jpeg);background-size: cover;background-repeat: no-repeat;">
    <div class="container p-5 my-5 bg-light opacity-75 border-info card h-100 border border-5">
    
        <h3 class="text-center">Dr. <?php echo htmlspecialchars($doctor["Doctor_Name"] ?? 'Not available'); ?>'s Details</h3>
        <div class="justify-content-center w-50 mx-auto p-3 border text-center border-info card h-100 border border-2">
            <h4>General Info</h4>
            <p>Doctor Name: <?php echo htmlspecialchars($doctor["Doctor_Name"] ?? 'Not available'); ?></p>
            <p>Department Name: <?php echo htmlspecialchars($doctor["Department_name"] ?? 'Not available'); ?></p>
            <p>Degree: <?php echo htmlspecialchars($doctor["Degree"] ?? 'Not available'); ?></p>
            <p>Institutes: <?php echo htmlspecialchars($doctor["Institutes"] ?? 'Not available'); ?></p>
            <p>Specialists: <?php echo htmlspecialchars($doctor["Specialists"] ?? 'Not available'); ?></p>
            <p>Contact Number: <?php echo htmlspecialchars($doctor["doctor_Contact_Number"] ?? 'Not available'); ?></p>
            <p>Consultation Fees: <?php echo htmlspecialchars($doctor["Doctor_Bill"] ?? 'Not available'); ?></p>
        </div>

        <?php if (isset($_SESSION["loggedin"]) && ($_SESSION["user_type"] == "Admin" || $_SESSION["user_type"] == "Doctor")): ?> 
                           

        <h4 class="text-center">Patient List</h4>
        <div class="table-responsive">
            <table class="table table-light table-striped">
                <thead class="table-info">
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Patient Age</th>
                        <th>Contact Number</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "
                        SELECT p.Patient_ID, p.Patient_Name, p.Patient_Age, p.Patient_Contact_Number, p.Payment_Date
                        FROM patient p
                        JOIN doctor d ON p.Doctor_ID = d.Doctor_ID
                        WHERE d.Doctor_ID = $id";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["Patient_ID"] ?? 'Not available') . "</td>
                                    <td>" . htmlspecialchars($row["Patient_Name"] ?? 'Not available') . "</td>
                                    <td>" . htmlspecialchars($row["Patient_Age"] ?? 'Not available') . "</td>
                                    <td>" . htmlspecialchars($row["Patient_Contact_Number"] ?? 'Not available') . "</td>
                                    <td>" . htmlspecialchars($row["Payment_Date"] ?? 'Not available') . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No patients found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <div class="container mt-2 text-center">
            <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
                <a href="edit_doctor.php?id=<?php echo htmlspecialchars($doctor['Doctor_ID'] ?? ''); ?>" class="btn btn-primary">Edit Doctor</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
