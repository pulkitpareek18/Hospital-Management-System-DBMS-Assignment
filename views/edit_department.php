<?php
require_once '../includes/helpers.php';
require_once '../models/Department.php';

$activePage = 'departments';
$basePath = getBasePath();
$pageTitle = 'Edit Department';

$department = null;
$message = '';

if (isset($_GET['id'])) {
    $department = Department::getById($_GET['id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Department::update($_POST['id'], $_POST['name']);
    $message = showAlert("Department updated successfully!");
    $department = Department::getById($_POST['id']); // Refresh data
}

if (!$department) {
    header('Location: view_departments.php');
    exit;
}

ob_start();
?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-indigo-600 mb-6">Edit Department</h1>
    
    <?= $message ?>
    
    <form method="post" class="space-y-4">
        <input type="hidden" name="id" value="<?= $department['id'] ?>">
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($department['name']) ?>" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-500 text-white py-2 px-6 rounded-md hover:bg-indigo-600 transition duration-300">
                Update Department
            </button>
            <a href="view_departments.php" class="bg-gray-300 text-gray-700 py-2 px-6 rounded-md hover:bg-gray-400 transition duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>