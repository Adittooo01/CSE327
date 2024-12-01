<!DOCTYPE html>
<html>

<?php

include("connect.php");

// Handle deletion of a nurse
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM nurse WHERE Nurse_ID = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: nurse.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");

// Handle search
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}
?>

<head>
    <title>Nurse Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/nurse.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
            <a href="input_nurse.php" class="btn btn-primary">Register Nurse</a>
        <?php endif; ?>
        <h2 class="text-center mb-4">All Nurse's List</h2>

        <!-- Search form -->
        <form class="d-flex mb-4" method="GET" action="nurse.php">
            <input class="form-control me-2" type="search" placeholder="Search by nurse name" aria-label="Search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Nurse ID</th>
                        <th>Nurse Name</th>
                        <th>Department ID</th>
                        <th>Nurse Contact Number</th>
                        <th>Shift ID</th>
                        <th>Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Adjust SQL query based on search term
                    if ($searchTerm) {
                        $sql = "SELECT * FROM nurse WHERE Nurse_Name LIKE '%$searchTerm%' ORDER BY Nurse_ID";
                    } else {
                        $sql = "SELECT * FROM nurse ORDER BY Nurse_ID";
                    }
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>".$row["Nurse_ID"]."</td>
                                <td>".$row["Nurse_Name"]."</td>
                                <td>".$row["Department_ID"]."</td>
                                <td>".$row["Nurse_Contact_Number"]."</td>
                                <td>".$row["Shift_ID"]."</td>
                                <td>";
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                                echo "<a href='edit_nurse.php?id=".$row["Nurse_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
                            }
                            echo "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
