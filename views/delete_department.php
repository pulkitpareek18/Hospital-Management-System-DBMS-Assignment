<?php
require_once '../includes/helpers.php';
require_once '../models/Department.php';

if (isset($_GET['id'])) {
    Department::delete($_GET['id']);
}

// Redirect back to departments list
header('Location: view_departments.php');
exit;
?>