<?php
session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['usertype'])) {
    header('Location: ../views/login.php');
    exit;
}

$usertype = $_SESSION['usertype'];
$username = $_SESSION['user'];

$roleName = [
    'a' => 'Admin',
    'd' => 'Doctor',
    'p' => 'Patient'
];

require_once '../models/User.php';
$user = new User();

$search = $_GET['search'] ?? '';
if (!empty($search)) {
    $patient_admissions = $user->searchPatientAdmissions($search);
} else {
    $patient_admissions = $user->getAllAdmissions();
}
?>