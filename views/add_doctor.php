<?php
require_once '../includes/helpers.php';
require_once '../models/Doctor.php';
require_once '../models/Department.php';

$activePage = 'doctors';
$basePath = getBasePath();
$pageTitle = 'Add Doctor';

$departments = Department::all();
$message = '';
$showDepartmentForm = false;

// Handle new department submission via AJAX
if (isset($_POST['add_department'])) {
    $departmentId = Department::add($_POST['department_name']);
    if ($departmentId) {
        echo json_encode(['success' => true, 'id' => $departmentId, 'name' => $_POST['department_name']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding department']);
    }
    exit;
}

// Handle doctor form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['add_department'])) {
    // Check if creating new department
    $departmentId = $_POST['department_id'];
    if ($departmentId === 'new' && !empty($_POST['new_department'])) {
        $departmentId = Department::add($_POST['new_department']);
    }
    
    $doctorId = Doctor::add($_POST['name'], $_POST['specialization'], $departmentId);
    if ($doctorId) {
        $message = showAlert("Doctor added successfully!");
    } else {
        $message = showAlert("Error adding doctor.", "error");
    }
    
    // Refresh departments list
    $departments = Department::all();
}

ob_start();
?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-green-600 mb-6">Add New Doctor</h1>
    
    <?= $message ?>
    
    <form method="post" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Doctor Name</label>
            <input type="text" id="name" name="name" placeholder="Full Name" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        
        <div>
            <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
            <input type="text" id="specialization" name="specialization" placeholder="Specialization" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        
        <div>
            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
            <div class="flex space-x-2">
                <select id="department_id" name="department_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
                    <?php endforeach; ?>
                    <option value="new">+ Add New Department</option>
                </select>
                <button type="button" id="addDeptBtn" class="bg-indigo-500 text-white px-4 rounded-md hover:bg-indigo-600">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        
        <!-- New department form (hidden by default) -->
        <div id="newDepartmentForm" class="hidden p-4 border border-dashed border-gray-300 rounded-md bg-gray-50">
            <h3 class="font-medium text-gray-700 mb-2">Add New Department</h3>
            <div class="flex space-x-2">
                <input type="text" id="new_department" name="new_department" placeholder="Department Name" 
                       class="flex-grow px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="button" id="saveDeptBtn" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                    Save
                </button>
                <button type="button" id="cancelDeptBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
        
        <div class="flex space-x-4 pt-4">
            <button type="submit" class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 transition duration-300">
                Add Doctor
            </button>
            <a href="view_doctors.php" class="bg-gray-300 text-gray-700 py-2 px-6 rounded-md hover:bg-gray-400 transition duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const departmentSelect = document.getElementById('department_id');
    const newDepartmentForm = document.getElementById('newDepartmentForm');
    const addDeptBtn = document.getElementById('addDeptBtn');
    const saveDeptBtn = document.getElementById('saveDeptBtn');
    const cancelDeptBtn = document.getElementById('cancelDeptBtn');
    const newDepartmentInput = document.getElementById('new_department');
    
    // Show new department form when "+ Add New Department" is selected
    departmentSelect.addEventListener('change', function() {
        if (this.value === 'new') {
            newDepartmentForm.classList.remove('hidden');
            newDepartmentInput.focus();
        } else {
            newDepartmentForm.classList.add('hidden');
        }
    });
    
    // Show new department form when "+" button is clicked
    addDeptBtn.addEventListener('click', function() {
        newDepartmentForm.classList.remove('hidden');
        departmentSelect.value = 'new';
        newDepartmentInput.focus();
    });
    
    // Cancel adding new department
    cancelDeptBtn.addEventListener('click', function() {
        newDepartmentForm.classList.add('hidden');
        departmentSelect.value = '';
        newDepartmentInput.value = '';
    });
    
    // Save new department using AJAX
    saveDeptBtn.addEventListener('click', function() {
        const departmentName = newDepartmentInput.value.trim();
        if (!departmentName) {
            alert('Please enter a department name');
            return;
        }
        
        // Create form data and send AJAX request
        const formData = new FormData();
        formData.append('department_name', departmentName);
        formData.append('add_department', 1);
        
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add new option to select and select it
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.name;
                
                // Insert before the "Add New" option which is the last one
                departmentSelect.insertBefore(option, departmentSelect.options[departmentSelect.options.length - 1]);
                
                // Select the new option
                departmentSelect.value = data.id;
                
                // Hide the new department form
                newDepartmentForm.classList.add('hidden');
                newDepartmentInput.value = '';
                
                // Show success message
                alert('Department added successfully!');
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the department');
        });
    });
});
</script>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>