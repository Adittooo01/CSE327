<!DOCTYPE html>
<html>

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
include("connect.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM doctor WHERE Doctor_ID = $id";
    $result = mysqli_query($conn, $sql);
    $doctor = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $doctor_name = mysqli_real_escape_string($conn, $_POST['Doctor_Name']);
    $department_id = mysqli_real_escape_string($conn, $_POST['Department_ID']);
    $degree = mysqli_real_escape_string($conn, $_POST['Degree']);
    $specialists = mysqli_real_escape_string($conn, $_POST['Specialists']);
    $contact_number = 1234567890;
    $consultation_fees = 123456;
    

    $sql = "UPDATE doctor SET 
        Doctor_Name = '$doctor_name', 
        Department_ID  = '$department_id', 
        Degree = '$degree',
        Specialists = '$specialists'
        WHERE Doctor_ID = $id_to_update";

        // UPDATE doctor_profile SET Doctor_Name = 'doctor_name', Department_ID = 102, 
        // Degree = 'degree', Institutes = 'institutes', Specialists = 'specialists', 
        // Doctor_Contact_Number = 1234567890, Doctor_Bill = 12345 WHERE Doctor_ID = 1001;

    // $sql2 =   "UPDATE doctor_profile SET 
    //     Doctor_Name = '$doctor_name', 
    //     Department_ID = '$department_ID', 
    //     Degree = '$degree',
    //     Institutes = '$institutes',
    //     Specialists = '$specialists',
    //     Doctor_Contact_Number = '$contact_number',
    //     Doctor_Bill = '$consultation_fees'
    //     WHERE Doctor_ID = $id_to_update";

    // if (mysqli_query($conn, $sql1)) {
    //     echo "Update query 1 executed successfully.<br>";
    // } else {
    //     echo "Error executing update query 1: " . mysqli_error($conn) . "<br>";
    // }

    // if (mysqli_query($conn, $sql2)) {
    //     echo "Update query 2 executed successfully.<br>";
    //           header('Location: doctor.php');
    // } else {
    //     echo "Error executing update query 2: " . mysqli_error($conn) . "<br>";
    // }

    if (mysqli_query($conn, $sql)) {
        header('Location: doctor.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Doctor Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/doctorpage.jpeg);background-size: cover;background-repeat: no-repeat;">

    <div class="container text-center w-25 p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit Doctor Info</h2>
        <form action="edit_doctor.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo $doctor['Doctor_ID']; ?>">
            <div class="mb-3">
                <label for="Doctor_Name" class="form-label">Doctor Name</label>
                <input type="text" class="form-control" id="Doctor_Name" name="Doctor_Name" value="<?php echo $doctor['Doctor_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Department_ID" class="form-label">Department ID</label>
                <input type="number" class="form-control" id="Department_ID" name="Department_ID" value="<?php echo $doctor['Department_ID']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Degree" class="form-label">Degree</label>
                <input type="text" class="form-control" id="Degree" name="Degree" value="<?php echo $doctor['Degree']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Specialists" class="form-label">Specialists</label>
                <input type="text" class="form-control" id="Specialists" name="Specialists" value="<?php echo $doctor['Specialists']; ?>" required>
              </div>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
        <br>
        <form action="doctorprofile.php?id=<?php echo htmlspecialchars($doctor['Doctor_ID']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($doctor['Doctor_ID']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
