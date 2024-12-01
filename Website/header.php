
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
        <a class="navbar-brand text-black" href="index.php">
                <img src="img/icon.png" width="30" height="30">  Hospital Management System   <img src="img/icon.png" width="30" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link text-black" href="doctor.php">Doctor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="department.php">Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="nurse.php">Nurse</a>
                    </li>
                    
                
                    <?php if (isset($_SESSION["loggedin"]) &&  ($_SESSION["user_type"] == "Admin" || $_SESSION["user_type"] == "Doctor" || $_SESSION["user_type"] == "Nurse")): ?>

                        <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </li> -->
                   
                        <li class="nav-item">
                        <a class="nav-link text-black" href="patient.php">Patient</a>
                    </li>
                   
                    
                    <li class="nav-item">
                        <a class="nav-link text-black" href="shift.php">Shift</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="admission.php">Admission</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-black" href="prescription.php">Prescription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="medication.php">Medication</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-black" href="test.php">Test</a>
                    </li>
                        
                        
                    <li class="nav-item">
                        <a class="nav-link text-black" href="billing.php">Bill</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="installment.php">Installment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="payment.php">Payments</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link text-black" href="bed.php">Bed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="ward.php">Ward</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="room.php">Room</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link text-black" href="ambulance.php">Ambulance</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-black" href="sql.php">SQL</a>
                    </li> -->
                    <?php endif; ?>
                    <?php if(!isset($_SESSION["loggedin"])): ?> 
                        <li class="nav-item">
                            <a class="" href="login.php"><button type="button" class="btn btn-primary">Log In</button></a>
                        </li> 

                    <?php else: ?>
                        <?php if($_SESSION["user_type"] == "Admin"): ?> 
                            <li class="nav-item">
                                <a class="nav-link text-black" href="sql.php">SQL</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="" href="logout.php"><button type="button" class="btn btn-outline-danger"><strong>Log Out</strong></button></a>
                        </li> 
                    <?php endif; ?>
                    </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="doctorprofile.php">Doctor Profile</a>
                    </li>
                    
                </ul> -->
            </div>
        </div>
    </nav>
