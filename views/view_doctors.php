<?php
require_once '../includes/helpers.php';
require_once '../models/Doctor.php';

$activePage = 'doctors';
$basePath = getBasePath();
$pageTitle = 'Doctors';

$doctors = Doctor::all();

ob_start();
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-green-600">Doctor List</h1>
    <a href="add_doctor.php" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Doctor
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($doctors)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No doctors found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($doctors as $doctor): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap"><?= $doctor['id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium"><?= $doctor['name'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $doctor['specialization'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $doctor['department'] ?? '-' ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="edit_doctor.php?id=<?= $doctor['id'] ?>" class="text-blue-500 hover:text-blue-700" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_doctor.php?id=<?= $doctor['id'] ?>" class="text-red-500 hover:text-red-700" 
                               onclick="return confirm('Are you sure you want to delete this doctor?');" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>