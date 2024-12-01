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
    $sql = "DELETE FROM ward WHERE Ward_Number = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: ward.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Ward Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/ward.jpg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
            <a href="input_ward.php" class="btn btn-primary">Register Ward</a>
        <?php endif; ?>
        <h2 class="text-center mb-4">All Ward's List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Ward Number</th>
                        <th>Ward Type</th>
                        <th>Available Ward</th>
                        <th>Bed ID</th>
                        <th>Patient_ID</th>
                        <th>Admission_ID</th>
                       
                        <th>Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM ward ORDER BY Ward_Number";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>".$row["Ward_Number"]."</td>
                                <td>".$row["Ward_Type"]."</td>
                                <td>".$row["Available_Wards"]."</td>
                                <td>".$row["Bed_ID"]."</td>
                                <td>".$row["Patient_ID"]."</td>
                                <td>".$row["Admission_ID"]."</td>
                               
                                <td>";
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                                echo "<a href='edit_ward.php?id=".$row["Ward_Number"]."' class='btn btn-primary btn-sm'>Edit</a>";
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
