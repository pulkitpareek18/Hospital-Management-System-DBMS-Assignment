<?php
require_once '../includes/helpers.php';
require_once '../models/Department.php';

$activePage = 'departments';
$basePath = getBasePath();
$pageTitle = 'Departments';

$departments = Department::all();

ob_start();
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-indigo-600">Department List</h1>
    <a href="add_department.php" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Department
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($departments)): ?>
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No departments found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($departments as $dept): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap"><?= $dept['id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium"><?= $dept['name'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="edit_department.php?id=<?= $dept['id'] ?>" class="text-blue-500 hover:text-blue-700" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_department.php?id=<?= $dept['id'] ?>" class="text-red-500 hover:text-red-700" 
                               onclick="return confirm('Are you sure you want to delete this department?');" title="Delete">
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