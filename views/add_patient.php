<?php
require_once '../includes/helpers.php';
require_once '../models/Patient.php';

$activePage = 'patients';
$basePath = getBasePath();
$pageTitle = 'Add Patient';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientId = Patient::add($_POST['name'], $_POST['age'], $_POST['gender'], $_POST['contact']);
    if ($patientId) {
        $message = showAlert("Patient added successfully!");
    } else {
        $message = showAlert("Error adding patient.", "error");
    }
}

ob_start();
?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Add New Patient</h1>
    
    <?= $message ?>
    
    <form method="post" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Patient Name</label>
            <input type="text" id="name" name="name" placeholder="Full Name" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                <input type="number" id="age" name="age" placeholder="Age" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select id="gender" name="gender" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        
        <div>
            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
            <input type="text" id="contact" name="contact" placeholder="Phone Number" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 transition duration-300">
                Add Patient
            </button>
            <a href="view_patients.php" class="bg-gray-300 text-gray-700 py-2 px-6 rounded-md hover:bg-gray-400 transition duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>