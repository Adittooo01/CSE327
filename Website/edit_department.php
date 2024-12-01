<!DOCTYPE html>
<html>
<?php
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin"){
    $message = "Require Admin Access";
    echo "<script>
    alert('$message');
    window.location.href='login.php';
    </script>";
    exit;
} 
include("connect.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM department WHERE Department_ID = $id";
    $result = mysqli_query($conn, $sql);
    $department = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $Department_Name = mysqli_real_escape_string($conn, $_POST['Department_Name']);
    $Number_of_Doctors = mysqli_real_escape_string($conn, $_POST['Number_of_Doctors']);
    $Number_of_Nurses = mysqli_real_escape_string($conn, $_POST['Number_of_Nurses']);
   
  

    $sql = "UPDATE department SET 
       
        Department_Name = '$Department_Name',
        Number_of_Doctors = '$Number_of_Doctors',
        Number_of_Nurses = '$Number_of_Nurses'
        WHERE Department_ID = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: department.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Department Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/department.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container text-center w-50 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Department Info</h2>
        <form action="edit_department.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo $department['Department_ID']; ?>">
            <div class="mb-3">
                <label for="Department_Name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="Department_Name" name="Department_Name" value="<?php echo $department['Department_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for=" Number_of_Doctors" class="form-label"> Number of Doctors</label>
                <input type="number" class="form-control" id=" Number_of_Doctors" name=" Number_of_Doctors" value="<?php echo $department['Number_of_Doctors']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Number_of_Nurses" class="form-label">Number of Nurses</label>
                <input type="number" class="form-control" id="Number_of_Nurses" name="Number_of_Nurses" value="<?php echo $department['Number_of_Nurses']; ?>" required>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <br>
        <form action="department.php?id=<?php echo htmlspecialchars($department['Department_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($department['Department_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
            
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
