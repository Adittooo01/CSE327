<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin") {
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
    $sql = "SELECT * FROM ambulance WHERE ambulance_id = $id";
    $result = mysqli_query($conn, $sql);
    $ambulance = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $vehicle_model = mysqli_real_escape_string($conn, $_POST['vehicle_model']);
    $ambulance_type = mysqli_real_escape_string($conn, $_POST['ambulance_type']);
   
   

    $sql = "UPDATE ambulance SET 
    vehicle_model = '$vehicle_model',
        ambulance_type = '$ambulance_type'
        
       
        WHERE ambulance_id = $id_to_update";

    if (mysqli_query($conn, $sql)) {
        header('Location: ambulance.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
include("header.php");
?>

<head>
    <title>Edit Ambulance Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-image: url(img/ambulance.jpg);background-size: cover;background-repeat: no-repeat;">

    <div class="container p-5 my-5 bg-white border opacity-75">
        <h2 class="text-center mb-4">Edit ambulance Info</h2>
        <?php if ($ambulance): ?>
            <form action="edit_ambulance.php?id=<?php echo htmlspecialchars($ambulance['ambulance_id']); ?>" method="POST">
                <input type="hidden" name="id_to_update" value="<?php echo $ambulance['ambulance_id']; ?>">
                <div class="mb-3">
                    <label for="vehicle_model" class="form-label">Vehicle Model</label>
                    <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" value="<?php echo $ambulance['vehicle_model']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for=" ambulance_type" class="form-label">Ambulance Typee</label>
                    <input type="text" class="form-control" id=" ambulance_type" name=" ambulance_type" value="<?php echo $ambulance[' ambulance_type']; ?>" required>
                </div>
                
                
                
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action="ambulance.php?id=<?php echo htmlspecialchars($ambulance['ambulance_id']); ?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($ambulance['ambulance_id']); ?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
        <?php else: ?>
            <p>No Ambulance record found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYC0j1A6rHgTTT7Jc0K0JA2Q8ujG5fGiiZh6E5F/n0KhD6L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6vrKNv7OQAdhv24lWZ6O1AqP2aJ/jSkpzT9HfmgJ7A91t6Gevu" crossorigin="anonymous"></script>
</body>
</html>
