<?php
require_once '../includes/helpers.php';
require_once '../models/Patient.php';

$activePage = 'patients';
$basePath = getBasePath();
$pageTitle = 'Patients';

$patients = Patient::all();

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-blue-600">Patient List</h1>
            <a href="add_patient.php" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i> Add New Patient
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($patients)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No patients found</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($patients as $patient): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap"><?= $patient['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium"><?= $patient['name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $patient['age'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $patient['gender'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $patient['contact'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="edit_patient.php?id=<?= $patient['id'] ?>" class="text-blue-500 hover:text-blue-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="schedule_appointment.php?patient_id=<?= $patient['id'] ?>" class="text-purple-500 hover:text-purple-700" title="Schedule Appointment">
                                        <i class="fas fa-calendar-plus"></i>
                                    </a>
                                    <a href="delete_patient.php?id=<?= $patient['id'] ?>" class="text-red-500 hover:text-red-700" 
                                       onclick="return confirm('Are you sure you want to delete this patient?');" title="Delete">
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

        <div class="mt-6">
            <a href="../index.php" class="text-yellow-500 hover:underline">← Back to Home</a>
        </div>
    </div>
</body>
</html>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>