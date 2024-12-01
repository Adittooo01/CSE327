<!DOCTYPE html>
<html>

<?php

session_start(); // Ensure the session is started

include("connect.php");

// Handle the delete request
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM department WHERE Department_ID = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: department.php');
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
    <title>Department Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/department.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <div class="container mt-5 text-end">
            <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
                <a href="input_department.php" class="btn btn-primary">Register Department</a>
            <?php endif; ?>
        </div>
        <h2 class="text-center mb-4">All Department's List</h2>
        <form class="d-flex justify-content-center mb-4" method="GET" action="">
            <input class="form-control w-50" type="text" name="search" placeholder="Search by Department Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-info ms-2" type="submit">Search</button>
        </form>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        <th>Number of Doctors</th>
                        <th>Number of Nurses</th>
                        <th>Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>

                <tbody>
                    <?php
                     if ($searchTerm) {
                        $sql = "SELECT * FROM department WHERE Department_Name LIKE '%$searchTerm%' ORDER BY Department_ID";
                    } else {
                        $sql = "SELECT * FROM department ORDER BY Department_ID";
                    }
                   
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>".$row["Department_ID"]."</td>
                                    <td>".$row["Department_Name"]."</td>
                                    <td>".$row["Number_of_Doctors"]."</td>
                                    <td>".$row["Number_of_Nurses"]."</td>
                                    <td>";
                            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                                echo "<a href='edit_department.php?id=".$row["Department_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
                            }
                            echo "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
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
