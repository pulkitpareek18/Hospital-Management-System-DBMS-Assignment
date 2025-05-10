<?php
require_once '../includes/helpers.php';
require_once '../models/Appointment.php';

$activePage = 'appointments';
$basePath = getBasePath();
$pageTitle = 'Appointments';

$appointments = Appointment::all();

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-purple-600">Appointment List</h1>
            <a href="schedule_appointment.php" class="bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 flex items-center">
                <i class="fas fa-plus mr-2"></i> New Appointment
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($appointments)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No appointments found</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($appointments as $a): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap"><?= $a['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium"><?= $a['patient_name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $a['doctor_name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $a['appointment_date'] ?></td>
                            <td class="px-6 py-4 max-w-xs truncate"><?= $a['reason'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="edit_appointment.php?id=<?= $a['id'] ?>" class="text-blue-500 hover:text-blue-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_appointment.php?id=<?= $a['id'] ?>" class="text-red-500 hover:text-red-700" 
                                       onclick="return confirm('Are you sure you want to delete this appointment?');" title="Delete">
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
            <a href="../index.php" class="text-red-500 hover:underline">← Back to Home</a>
        </div>
    </div>
</body>
</html>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>