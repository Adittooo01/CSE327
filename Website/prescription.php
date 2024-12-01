<!DOCTYPE html>
<html>

<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include("connect.php");

if (isset($_POST['delete']) && $_SESSION["user_type"] == "Admin") {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM prescription WHERE Prescription_ID = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: prescription.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Prescription Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/prescription.jpg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <?php if ($_SESSION["user_type"] == "Admin"): ?>
            <a href="input_prescription.php" class="btn btn-primary">Register Prescription</a>
        <?php endif; ?>
        <h2 class="text-center mb-4">All Prescription's List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Prescription ID</th>
                        <th>Prescription Date</th>
                        <th>Medication ID</th>
                        <th>Doctor ID</th>
                        <th>Patient ID</th>
                        <th>Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM prescription ORDER BY Prescription_ID";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>".$row["Prescription_ID"]."</td>
                            <td>".$row["Prescription_Date"]."</td>
                            <td>".$row["Medication_ID"]."</td>
                            <td>".$row["Doctor_ID"]."</td>
                            <td>".$row["Patient_ID"]."</td>
                            <td>";
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                                echo "<a href='edit_prescription.php?id=".$row["Prescription_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
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
<!-- if ($_SESSION["user_type"] == "Admin") {
                                echo "<form action='prescription.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='id_to_delete' value='".$row["Prescription_ID"]."'>
                                    <button type='submit' name='delete' class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                                
                                <a href='edit_prescription.php?id=".$row["Prescription_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
                            }
                            echo "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                    } -->
