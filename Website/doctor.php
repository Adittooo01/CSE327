<!DOCTYPE html>
<html>

<?php

include("header.php");

// Include the connect.php file to establish a database connection
include("connect.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}
?>

<head>
    <title>Doctor Info Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/doctorpage.jpeg); background-size: cover; background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <div class="container mt-5 text-end">
            <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin"): ?>
                <a href="input_doctor.php" class="btn btn-primary">Register Doctor</a>
            <?php endif; ?>
        </div>
        <h2 class="text-center">All Doctor's List</h2>
        <form class="d-flex justify-content-center mb-4" method="GET" action="">
            <input class="form-control w-50" type="text" name="search" placeholder="Search by Doctor Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-info ms-2" type="submit">Search</button>
        </form>
        <table class="table table-light table-striped table-responsive">
            <thead class="table-info">
                <tr>
                    <th>Doctor ID</th>
                    <th>Doctor Name</th>
                    <th>Department ID</th>
                    <th>Degree</th>
                    <th>Specialists</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 if ($searchTerm) {
                    $sql = "SELECT * FROM doctor WHERE Doctor_Name LIKE '%$searchTerm%' ORDER BY Doctor_ID";
                } else {
                    $sql = "SELECT * FROM doctor ORDER BY Doctor_ID";
                }
                // $sql = "SELECT * FROM doctor ORDER BY Doctor_ID";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".$row["Doctor_ID"]."</td>
                                <td>".$row["Doctor_Name"]."</td>
                                <td>".$row["Department_ID"]."</td>
                                <td>".$row["Degree"]."</td>
                                <td>".$row["Specialists"]."</td>
                                <td>
                                    <a href='doctorprofile.php?id=".$row["Doctor_ID"]."' class='btn btn-info btn-sm'>Doctor Profile</a>";

                        // Check if the user is an admin to display the edit button
                        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Admin") {
                            echo " <a href='edit_doctor.php?id=".$row["Doctor_ID"]."' class='btn btn-primary btn-sm'>Edit</a>";
                        }

                        echo "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No doctors found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
