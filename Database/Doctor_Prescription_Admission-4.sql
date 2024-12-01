-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2024 at 08:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Doctor_Prescription_Admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `Admission_ID` int(10) NOT NULL,
  `Admission_Date` date DEFAULT NULL,
  `Patient_ID` int(10) NOT NULL,
  `Doctor_ID` int(10) NOT NULL,
  `Room_Number` int(10) DEFAULT NULL,
  `Ward_Number` int(10) DEFAULT NULL,
  `Bed_Number` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`Admission_ID`, `Admission_Date`, `Patient_ID`, `Doctor_ID`, `Room_Number`, `Ward_Number`, `Bed_Number`) VALUES
(71, '2024-05-15', 21, 11, 91, 81, 102),
(72, '2024-05-02', 22, 12, 92, 82, 102),
(73, '2024-05-06', 23, 13, 93, 83, 103),
(2001, '2024-04-24', 3001, 1001, 2, 90, 5),
(2002, '2024-05-01', 3002, 1002, 5, 4, 1),
(2003, '2024-05-15', 3003, 1004, NULL, 5, 9),
(2004, '2024-05-16', 3004, 1004, NULL, 5, 10),
(2005, '2024-05-03', 3005, 1002, 3, 8, 6),
(2006, '2024-05-08', 3006, 1003, 4, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ambulance`
--

CREATE TABLE `ambulance` (
  `ambulance_id` int(11) NOT NULL,
  `vehicle_model` varchar(11) NOT NULL,
  `ambulance_type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance`
--

INSERT INTO `ambulance` (`ambulance_id`, `vehicle_model`, `ambulance_type`) VALUES
(100005, 'BMW', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_booking`
--

CREATE TABLE `appointment_booking` (
  `Appointment_ID` int(11) NOT NULL,
  `Doctor_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assists`
--

CREATE TABLE `assists` (
  `Nurse_ID` int(10) NOT NULL,
  `Doctor_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `Bed_Number` int(10) NOT NULL,
  `Bed_Type` varchar(50) NOT NULL,
  `Available_Beds` int(255) NOT NULL,
  `Ward_Number` int(10) DEFAULT NULL,
  `Room_Number` int(10) NOT NULL,
  `Patient_ID` int(10) DEFAULT NULL,
  `Admission_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`Bed_Number`, `Bed_Type`, `Available_Beds`, `Ward_Number`, `Room_Number`, `Patient_ID`, `Admission_ID`) VALUES
(101, 'Single', 4, 81, 91, 21, 71),
(102, 'Double', 8, 82, 92, 22, 72),
(103, 'Single', 4, 83, 93, 23, 73);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `Billing_ID` int(10) NOT NULL,
  `Billing_Date` date NOT NULL,
  `Patient_ID` int(10) DEFAULT NULL,
  `Medication_ID` int(10) NOT NULL,
  `Medicine_Bill` int(255) NOT NULL,
  `Test_Bill` int(255) NOT NULL,
  `Doctor_Bill` int(255) NOT NULL,
  `Total_Bill` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`Billing_ID`, `Billing_Date`, `Patient_ID`, `Medication_ID`, `Medicine_Bill`, `Test_Bill`, `Doctor_Bill`, `Total_Bill`) VALUES
(111, '2024-05-01', 21, 61, 1000, 800, 250, 2050),
(112, '2024-05-01', 22, 62, 800, 800, 200, 1800),
(113, '2024-05-15', 23, 63, 900, 600, 200, 1600);

-- --------------------------------------------------------

--
-- Table structure for table `completes`
--

CREATE TABLE `completes` (
  `Patient_ID` int(10) NOT NULL,
  `Payment_ID` int(10) NOT NULL,
  `Billing_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `Ward_Number` int(10) NOT NULL,
  `Room_Number` int(10) NOT NULL,
  `Bed_Number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Department_ID` int(10) NOT NULL,
  `Department_Name` varchar(20) NOT NULL,
  `Number_of_Doctors` int(255) DEFAULT NULL,
  `Number_of_Nurses` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Department_ID`, `Department_Name`, `Number_of_Doctors`, `Number_of_Nurses`) VALUES
(1, 'Cardiology', 50, 37),
(2, 'Gynecology', 90, 40),
(103, 'Cardiology', 200, 150),
(104, 'Cardiology', 200, 150),
(105, 'Cardiology', 50, 20);

-- --------------------------------------------------------

--
-- Table structure for table `discharge_summary`
--

CREATE TABLE `discharge_summary` (
  `Discharge_Summary_ID` int(10) NOT NULL,
  `Patient_ID` int(10) DEFAULT NULL,
  `Discharge_Date` date DEFAULT NULL,
  `Reason_For_Discharge` varchar(255) DEFAULT NULL,
  `Summary_of_Treatment` text DEFAULT NULL,
  `Progress_During_Hospital_Stay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discharge_summary`
--

INSERT INTO `discharge_summary` (`Discharge_Summary_ID`, `Patient_ID`, `Discharge_Date`, `Reason_For_Discharge`, `Summary_of_Treatment`, `Progress_During_Hospital_Stay`) VALUES
(70, 3002, '2024-05-01', 'well hjhj', 'icu hghg', 'very good'),
(151, 21, '2024-05-02', 'Improved', 'Fever', 'Good'),
(152, 22, '2024-05-04', 'Improved', 'Fever', 'Good'),
(153, 23, '2024-05-10', 'Improved', 'Fever', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `Doctor_ID` int(10) NOT NULL,
  `Doctor_Name` varchar(20) NOT NULL,
  `Department_ID` int(10) DEFAULT NULL,
  `Degree` text DEFAULT NULL,
  `Specialists` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`Doctor_ID`, `Doctor_Name`, `Department_ID`, `Degree`, `Specialists`) VALUES
(11, 'Alamgir Kabir', 1, 'HSC MBBS FCPS ', 'Cardiologist'),
(12, 'Nasrin Akter', 2, 'HSC MBBS FCPS ', 'Gynecologist');

--
-- Triggers `doctor`
--
DELIMITER $$
CREATE TRIGGER `after_doctor_insert` AFTER INSERT ON `doctor` FOR EACH ROW BEGIN
    INSERT INTO doctor_profile (
        Doctor_ID, 
        Doctor_Name, 
        Department_ID, 
        Degree, 
        Specialists, 
        Doctor_Contact_Number, 
        Doctor_Bill
    ) VALUES (
        NEW.Doctor_ID, 
        NEW.Doctor_Name, 
        NEW.Department_ID, 
        NEW.Degree, 
        NEW.Specialists, 
        1234567890, -- Replace with actual default value if needed
        123456 -- Replace with actual default value if needed
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_doctorprofile_update` AFTER UPDATE ON `doctor` FOR EACH ROW BEGIN
    -- Update the doctor table
    UPDATE doctor_profile
    SET Doctor_Name = NEW.Doctor_Name,
        Department_ID = NEW.Department_ID,
        Degree = NEW.Degree,
        Specialists = NEW.Specialists
    WHERE Doctor_ID = NEW.Doctor_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_profile`
--

CREATE TABLE `doctor_profile` (
  `Doctor_ID` int(10) NOT NULL,
  `Doctor_Name` varchar(20) NOT NULL,
  `Department_ID` int(10) DEFAULT NULL,
  `Degree` text DEFAULT NULL,
  `Institutes` text DEFAULT NULL,
  `Specialists` text DEFAULT NULL,
  `Doctor_Contact_Number` int(11) DEFAULT NULL,
  `Doctor_Bill` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_profile`
--

INSERT INTO `doctor_profile` (`Doctor_ID`, `Doctor_Name`, `Department_ID`, `Degree`, `Institutes`, `Specialists`, `Doctor_Contact_Number`, `Doctor_Bill`) VALUES
(11, 'Alamgir Kabir', 1, 'HSC MBBS FCPS ', NULL, 'Cardiologist', 1234567890, 123456),
(12, 'Nasrin Akter', 2, 'HSC MBBS FCPS ', NULL, 'Gynecologist', 1234567890, 123456);

-- --------------------------------------------------------

--
-- Table structure for table `equipped`
--

CREATE TABLE `equipped` (
  `Admission_ID` int(10) NOT NULL,
  `Room_Number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `Installment_ID` int(10) DEFAULT NULL,
  `Installment_Numbers` int(10) NOT NULL,
  `Payment_Per_Installment` int(255) NOT NULL,
  `Billing_ID` int(10) DEFAULT NULL,
  `Total_Bill` int(255) DEFAULT NULL,
  `Payment_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`Installment_ID`, `Installment_Numbers`, `Payment_Per_Installment`, `Billing_ID`, `Total_Bill`, `Payment_ID`) VALUES
(121, 2, 2000, 111, 5000, 131),
(122, 2, 1000, 112, 3000, 132),
(123, 4, 2000, 113, 10000, 133);

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `Medication_ID` int(10) NOT NULL,
  `Medication_Name` varchar(20) NOT NULL,
  `Instruction_For_Usage` text NOT NULL,
  `Medicine_Bill` int(255) NOT NULL,
  `Doctor_ID` int(10) DEFAULT NULL,
  `Patient_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`Medication_ID`, `Medication_Name`, `Instruction_For_Usage`, `Medicine_Bill`, `Doctor_ID`, `Patient_ID`) VALUES
(5001, 'Napa', 'After Dinner ', 25, 1001, 3001),
(5002, 'huu', 'hdhd', 89, 1002, 3003),
(61, 'Napa', 'After Dinner', 60, 11, 21),
(62, 'Alatrol', 'After Lunch', 40, 12, 22),
(63, 'Acifix', 'Before Dinner', 80, 13, 23),
(6162, 'Napa, Alatrol', 'After Dinner', 400, 11, 21);

-- --------------------------------------------------------

--
-- Table structure for table `med_bill`
--

CREATE TABLE `med_bill` (
  `Medication_ID` int(10) NOT NULL,
  `Billing_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `Nurse_ID` int(10) NOT NULL,
  `Nurse_Name` varchar(20) NOT NULL,
  `Department_ID` int(10) DEFAULT NULL,
  `Nurse_Contact_Number` int(11) DEFAULT NULL,
  `Shift_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`Nurse_ID`, `Nurse_Name`, `Department_ID`, `Nurse_Contact_Number`, `Shift_ID`) VALUES
(31, 'Rahima', 1, 1817653349, 41),
(32, 'Farida', 2, 1918765545, 42);

-- --------------------------------------------------------

--
-- Table structure for table `nur_assigned_to_patie`
--

CREATE TABLE `nur_assigned_to_patie` (
  `Nurse_ID` int(10) NOT NULL,
  `Patient_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `n_s_room`
--

CREATE TABLE `n_s_room` (
  `Nurse_ID` int(10) NOT NULL,
  `Shift_ID` int(10) NOT NULL,
  `Room_Number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `n_s_ward`
--

CREATE TABLE `n_s_ward` (
  `Nurse_ID` int(10) NOT NULL,
  `Shift_ID` int(10) NOT NULL,
  `Ward_Number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Patient_ID` int(10) NOT NULL,
  `Patient_Name` varchar(20) NOT NULL,
  `Patient_Age` int(10) DEFAULT NULL,
  `Patient_Gender` varchar(20) DEFAULT NULL,
  `Patient_Contact_Number` int(11) DEFAULT NULL,
  `Prescription_ID` int(10) DEFAULT NULL,
  `Doctor_ID` int(10) NOT NULL,
  `Medication_ID` int(10) DEFAULT NULL,
  `Admission_ID` int(10) DEFAULT NULL,
  `Ward_Number` int(10) DEFAULT NULL,
  `Room_Number` int(10) DEFAULT NULL,
  `Bed_Number` int(10) DEFAULT NULL,
  `Billing_ID` int(10) DEFAULT NULL,
  `Bill_Amount` int(255) DEFAULT NULL,
  `Billing_Date` date DEFAULT NULL,
  `Installment_ID` int(10) DEFAULT NULL,
  `Installment_Numbers` int(10) DEFAULT NULL,
  `Payment_Per_Installment` int(255) DEFAULT NULL,
  `Payment_ID` int(10) DEFAULT NULL,
  `Paid_Amount` int(255) DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`Patient_ID`, `Patient_Name`, `Patient_Age`, `Patient_Gender`, `Patient_Contact_Number`, `Prescription_ID`, `Doctor_ID`, `Medication_ID`, `Admission_ID`, `Ward_Number`, `Room_Number`, `Bed_Number`, `Billing_ID`, `Bill_Amount`, `Billing_Date`, `Installment_ID`, `Installment_Numbers`, `Payment_Per_Installment`, `Payment_ID`, `Paid_Amount`, `Payment_Date`) VALUES
(21, 'Rokib', 54, 'Male', 1918765567, NULL, 11, NULL, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Nila', 33, 'Female', 1918178898, NULL, 12, NULL, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Kabir', 66, 'Male', 1918767789, NULL, 13, NULL, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3001, 'hjhkkk', 87, 'Female', 1314356678, NULL, 101, 89, 2001, 8, 8, 5, 67, 66, '2024-05-01', 99, 2, 78, 45, 99, '2024-05-08'),
(3002, 'Nadia Alam', 39, 'Female', 1712154456, 4002, 1002, 5002, 2002, 8, 4, 1, 6002, 6500, '2024-05-09', 7002, 3, 2000, 8002, 500, '2024-05-09'),
(3003, 'Rofiq Hossain', 50, 'Male', 1630383865, 4003, 1003, 5003, 2003, 5, NULL, 9, 6003, 8500, '2024-05-04', 7003, 2, 4000, 8003, 500, '2024-05-06'),
(3004, 'Sadman Haq', 45, 'Male', 1712163356, 4004, 1004, 5004, 2004, 5, NULL, 10, 6004, 10500, '2024-04-10', 7004, 2, 5000, 8004, 500, '2024-04-15'),
(3005, 'Rokib', 87, 'Male', 1817653345, NULL, 1002, NULL, 2005, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3006, 'Nasrin', 67, 'Female', 1817625567, NULL, 1006, NULL, 2006, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3007, 'hdh', 78, 'Female', 1712187789, NULL, 102, NULL, 2006, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(10) NOT NULL,
  `Billing_ID` int(10) DEFAULT NULL,
  `Total_Bill` int(255) DEFAULT NULL,
  `Installment_ID` int(10) NOT NULL,
  `Installment_Numbers` int(10) NOT NULL,
  `Payment_Per_Installment` int(255) NOT NULL,
  `Paid_Amount` int(255) DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Billing_ID`, `Total_Bill`, `Installment_ID`, `Installment_Numbers`, `Payment_Per_Installment`, `Paid_Amount`, `Payment_Date`) VALUES
(131, 111, 5000, 121, 2, 2000, 1000, '2024-05-07'),
(132, 112, 3000, 122, 2, 1000, 1000, '2024-05-11'),
(133, 113, 10000, 123, 4, 2000, 2000, '2024-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `prescribes`
--

CREATE TABLE `prescribes` (
  `Doctor_ID` int(10) NOT NULL,
  `Prescription_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `Prescription_ID` int(10) NOT NULL,
  `Prescription_Date` date NOT NULL,
  `Doctor_ID` int(10) NOT NULL,
  `Patient_ID` int(10) NOT NULL,
  `Medication_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`Prescription_ID`, `Prescription_Date`, `Doctor_ID`, `Patient_ID`, `Medication_ID`) VALUES
(51, '2024-05-09', 11, 21, 61),
(52, '2024-05-07', 12, 22, 62),
(53, '2024-05-03', 13, 23, 63),
(4001, '2024-05-02', 1002, 3002, 5002),
(4002, '2024-05-01', 1002, 3002, 5002);

-- --------------------------------------------------------

--
-- Table structure for table `pres_is_assigned_med`
--

CREATE TABLE `pres_is_assigned_med` (
  `Medication_ID` int(10) NOT NULL,
  `Prescription_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_Number` int(10) NOT NULL,
  `Room_Type` varchar(50) NOT NULL,
  `Available_Rooms` int(255) NOT NULL,
  `Bed_ID` int(10) DEFAULT NULL,
  `Patient_ID` int(10) DEFAULT NULL,
  `Admission_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_Number`, `Room_Type`, `Available_Rooms`, `Bed_ID`, `Patient_ID`, `Admission_ID`) VALUES
(91, 'Single', 4, 101, 21, 71),
(92, 'Double', 6, 102, 22, 72),
(93, 'Single', 7, 103, 23, 73);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `Shift_ID` int(10) NOT NULL,
  `Shift_Name` text NOT NULL,
  `Shift_Time` time NOT NULL,
  `Nurse_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`Shift_ID`, `Shift_Name`, `Shift_Time`, `Nurse_ID`) VALUES
(41, 'Night', '03:22:00', 31),
(42, 'Day', '00:22:00', 32),
(43, 'Night', '03:23:00', 33);

-- --------------------------------------------------------

--
-- Table structure for table `suggests`
--

CREATE TABLE `suggests` (
  `Medication_ID` int(10) NOT NULL,
  `Patient_ID` int(10) NOT NULL,
  `Doctor_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `Test_ID` int(10) NOT NULL,
  `Test_Name` varchar(20) NOT NULL,
  `Test_Bill` int(255) NOT NULL,
  `Patient_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`Test_ID`, `Test_Name`, `Test_Bill`, `Patient_ID`) VALUES
(141, 'Blood ', 700, 21),
(142, 'X-Ray', 800, 22),
(143, 'Thyroid', 900, 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('Admin','Doctor','Nurse','Patient') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `created_at`) VALUES
(1, 'sumaita', '$2y$10$wAz9VkyTO6mz4VNJhTGzt.hsu0PYZd4VhRUN0ji9Jn1YU9.IL7TV.', 'Admin', '2024-05-27 01:02:47'),
(2, 'tahsin', '$2y$10$evBxa0mRyqwuT.0IaKFXh.pY8oxljzu86RlYVci9Gi2QddLkBsrYy', 'Doctor', '2024-05-27 01:03:22'),
(3, 'faruqui', '$2y$10$9LWB0gQSn8ALnXYdpqYnjuPnij9LFEkf/Ux64qh97sBnrt5QNR8YK', 'Nurse', '2024-05-27 16:48:52'),
(4, 'jasia', '$2y$10$Vhe8zSTS27efZRnn9xDoLOTW5ChbTlJuPvz4L.NU9j4b6BMmNqE6.', 'Doctor', '2024-05-27 16:50:47'),
(5, 'lila', '$2y$10$tcR.rAvRbxItVDAW89KfSeq0FGqk..GcDDc5sFY2revBI/TWWt6Oy', 'Patient', '2024-05-27 16:54:18'),
(6, 'kazijasia', '$2y$10$Ah0/LMgAxnh/.9qui4pVveCZkr3KWA0Ydlx8GP9vk9TgKG3zPetPa', 'Admin', '2024-05-29 10:25:16'),
(7, 'Tushar', '$2y$10$9u7lwIFqh5aWOuZ3HOOTeOsT7xqdnn9anVTN5tkE205wXRDbWjrWu', 'Admin', '2024-05-29 11:37:59'),
(8, 'suchitra', '$2y$10$6Rl//mM15XIRWjGUoI.thuS.W2.jISvL9AhvioozjKOOeZt4MMpRq', 'Admin', '2024-09-06 14:10:36'),
(9, 'amit', '$2y$10$pGxpm88fyQxRhSEsxrRcGeKBCSSqu9RWtAnyaGbbE7KXWOllwQMoG', 'Doctor', '2024-09-06 14:12:59'),
(10, 'hemel', '$2y$10$nOA3l2K03tDSAJksdoGrDec8u79ma7hwl544AncVGuvtcWwdOviSi', 'Patient', '2024-09-06 14:13:52'),
(11, 'Atiq', '$2y$10$Ioog8zaGXvQuR13tnxo1LuXOCeUdtTqq1tn2f5T4sl6h9QVLmsPq.', 'Admin', '2024-09-28 23:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `Ward_Number` int(10) NOT NULL,
  `Ward_Type` varchar(50) NOT NULL,
  `Available_Wards` int(255) NOT NULL,
  `Bed_ID` int(10) DEFAULT NULL,
  `Patient_ID` int(10) DEFAULT NULL,
  `Admission_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`Ward_Number`, `Ward_Type`, `Available_Wards`, `Bed_ID`, `Patient_ID`, `Admission_ID`) VALUES
(81, 'Ten Bed', 3, 101, 21, 71),
(82, 'Four Bed', 3, 102, 22, 72),
(83, 'Two Bed', 5, 103, 23, 73);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`Admission_ID`);

--
-- Indexes for table `ambulance`
--
ALTER TABLE `ambulance`
  ADD PRIMARY KEY (`ambulance_id`);

--
-- Indexes for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `appointment_booking_ibfk1` (`Doctor_ID`),
  ADD KEY `appointment_booking_ibfk2` (`Patient_ID`);

--
-- Indexes for table `assists`
--
ALTER TABLE `assists`
  ADD PRIMARY KEY (`Nurse_ID`,`Doctor_ID`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`Bed_Number`),
  ADD KEY `Admission_ID` (`Admission_ID`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`Billing_ID`);

--
-- Indexes for table `completes`
--
ALTER TABLE `completes`
  ADD PRIMARY KEY (`Patient_ID`,`Payment_ID`,`Billing_ID`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`Ward_Number`,`Room_Number`,`Bed_Number`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Department_ID`);

--
-- Indexes for table `discharge_summary`
--
ALTER TABLE `discharge_summary`
  ADD PRIMARY KEY (`Discharge_Summary_ID`),
  ADD KEY `Patient_ID` (`Patient_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`Doctor_ID`),
  ADD KEY `doctor_ibfk_1` (`Department_ID`);

--
-- Indexes for table `doctor_profile`
--
ALTER TABLE `doctor_profile`
  ADD KEY `doctor_profile_ibfk_1` (`Doctor_ID`);

--
-- Indexes for table `equipped`
--
ALTER TABLE `equipped`
  ADD PRIMARY KEY (`Admission_ID`,`Room_Number`);

--
-- Indexes for table `med_bill`
--
ALTER TABLE `med_bill`
  ADD PRIMARY KEY (`Medication_ID`,`Billing_ID`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`Nurse_ID`),
  ADD KEY `nurse_ibfk_1` (`Department_ID`),
  ADD KEY `nurse_ibfk_2` (`Shift_ID`);

--
-- Indexes for table `nur_assigned_to_patie`
--
ALTER TABLE `nur_assigned_to_patie`
  ADD PRIMARY KEY (`Nurse_ID`,`Patient_ID`);

--
-- Indexes for table `n_s_room`
--
ALTER TABLE `n_s_room`
  ADD PRIMARY KEY (`Nurse_ID`,`Shift_ID`,`Room_Number`);

--
-- Indexes for table `n_s_ward`
--
ALTER TABLE `n_s_ward`
  ADD PRIMARY KEY (`Nurse_ID`,`Shift_ID`,`Ward_Number`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Patient_ID`),
  ADD KEY `Admission_ID` (`Admission_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `prescribes`
--
ALTER TABLE `prescribes`
  ADD PRIMARY KEY (`Doctor_ID`,`Prescription_ID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`Prescription_ID`);

--
-- Indexes for table `pres_is_assigned_med`
--
ALTER TABLE `pres_is_assigned_med`
  ADD PRIMARY KEY (`Medication_ID`,`Prescription_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_Number`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`Shift_ID`);

--
-- Indexes for table `suggests`
--
ALTER TABLE `suggests`
  ADD PRIMARY KEY (`Medication_ID`,`Patient_ID`,`Doctor_ID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD KEY `test_ibfk_1` (`Patient_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`Ward_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  ADD CONSTRAINT `appointment_booking_ibfk1` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_booking_ibfk2` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bed`
--
ALTER TABLE `bed`
  ADD CONSTRAINT `bed_ibfk_1` FOREIGN KEY (`Admission_ID`) REFERENCES `admission` (`Admission_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discharge_summary`
--
ALTER TABLE `discharge_summary`
  ADD CONSTRAINT `discharge_summary_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`Department_ID`) REFERENCES `department` (`Department_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_profile`
--
ALTER TABLE `doctor_profile`
  ADD CONSTRAINT `doctor_profile_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nurse`
--
ALTER TABLE `nurse`
  ADD CONSTRAINT `nurse_ibfk_1` FOREIGN KEY (`Department_ID`) REFERENCES `department` (`Department_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nurse_ibfk_2` FOREIGN KEY (`Shift_ID`) REFERENCES `shift` (`Shift_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`Admission_ID`) REFERENCES `admission` (`Admission_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
