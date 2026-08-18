<?php
session_start();
include 'db_connect.php';

// Security check
if (!isset($_SESSION['admin_id'])) {
    die("Access Denied");
}

$type = $_GET['type'] ?? 'registration';
$table = ($type == 'registration') ? 'registrations' : 'projectdetails';
$filename = "XPERT_" . ucfirst($type) . "_Report_" . date('Y-m-d') . ".csv";

// Headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

if ($type == 'registration') {
    fputcsv($output, array('ID', 'Full Name', 'Email', 'Phone', 'Course Name', 'Date Registered', 'Status'));
    $query = "SELECT id, full_name, email, phone_number, course_name, registered_at, status FROM registrations ORDER BY id DESC";
} else {
    fputcsv($output, array('ID', 'Client Name', 'Business Email', 'Interested In', 'Budget', 'Message', 'Status'));
    $query = "SELECT id, full_name, business_email, interest_in, estimated_budget, message, status FROM projectdetails ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
