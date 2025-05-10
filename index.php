<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/helpers.php';
require_once 'models/Department.php';
require_once 'models/Doctor.php';
require_once 'models/Patient.php';
require_once 'models/Appointment.php';

$activePage = 'dashboard';
$basePath = getBasePath();
$pageTitle = 'Dashboard';

// Get counts for dashboard
$patientCount = count(Patient::all());
$doctorCount = count(Doctor::all());
$deptCount = count(Department::all());
$appointmentCount = count(Appointment::all());

// Simple solution that bypasses potential issues with layout.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white py-6 flex-shrink-0 hidden md:block">
            <div class="px-6">
                <h1 class="text-2xl font-bold mb-6">HMS Dashboard</h1>
                <nav>
                    <ul>
                        <li class="mb-3">
                            <a href="<?= $basePath ?>" class="flex items-center px-4 py-2 rounded <?= $activePage === 'dashboard' ? 'bg-blue-900' : 'hover:bg-blue-700' ?>">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="<?= $basePath ?>views/view_patients.php" class="flex items-center px-4 py-2 rounded <?= $activePage === 'patients' ? 'bg-blue-900' : 'hover:bg-blue-700' ?>">
                                <i class="fas fa-user-injured mr-3"></i>
                                <span>Patients</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="<?= $basePath ?>views/view_doctors.php" class="flex items-center px-4 py-2 rounded <?= $activePage === 'doctors' ? 'bg-blue-900' : 'hover:bg-blue-700' ?>">
                                <i class="fas fa-user-md mr-3"></i>
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="<?= $basePath ?>views/view_departments.php" class="flex items-center px-4 py-2 rounded <?= $activePage === 'departments' ? 'bg-blue-900' : 'hover:bg-blue-700' ?>">
                                <i class="fas fa-hospital mr-3"></i>
                                <span>Departments</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="<?= $basePath ?>views/view_appointments.php" class="flex items-center px-4 py-2 rounded <?= $activePage === 'appointments' ? 'bg-blue-900' : 'hover:bg-blue-700' ?>">
                                <i class="fas fa-calendar-alt mr-3"></i>
                                <span>Appointments</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center py-4 px-6">
                    <div>
                        <button id="sidebarToggle" class="md:hidden text-gray-500 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div>
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-user-circle text-2xl"></i>
                        </a>
                    </div>
                </div>
            </header>
            
            <!-- Main Content Area -->
            <div class="container mx-auto px-4 py-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="transform transition duration-300 hover:scale-105">
                        <a href="views/add_patient.php" class="block bg-blue-500 text-white rounded-lg p-6 text-center hover:bg-blue-600 shadow-md">
                            <i class="fas fa-user-plus text-3xl mb-2"></i>
                            <h3 class="text-lg font-semibold">Add Patient</h3>
                        </a>
                    </div>
                    <div class="transform transition duration-300 hover:scale-105">
                        <a href="views/add_doctor.php" class="block bg-green-500 text-white rounded-lg p-6 text-center hover:bg-green-600 shadow-md">
                            <i class="fas fa-user-md text-3xl mb-2"></i>
                            <h3 class="text-lg font-semibold">Add Doctor</h3>
                        </a>
                    </div>
                    <div class="transform transition duration-300 hover:scale-105">
                        <a href="views/add_department.php" class="block bg-indigo-500 text-white rounded-lg p-6 text-center hover:bg-indigo-600 shadow-md">
                            <i class="fas fa-hospital text-3xl mb-2"></i>
                            <h3 class="text-lg font-semibold">Add Department</h3>
                        </a>
                    </div>
                    <div class="transform transition duration-300 hover:scale-105">
                        <a href="views/schedule_appointment.php" class="block bg-purple-500 text-white rounded-lg p-6 text-center hover:bg-purple-600 shadow-md">
                            <i class="fas fa-calendar-plus text-3xl mb-2"></i>
                            <h3 class="text-lg font-semibold">Schedule Appointment</h3>
                        </a>
                    </div>
                    <div class="transform transition duration-300 hover:scale-105">
                        <a href="views/view_patients.php" class="block bg-yellow-500 text-white rounded-lg p-6 text-center hover:bg-yellow-600 shadow-md">
                            <i class="fas fa-user-friends text-3xl mb-2"></i>
                            <h3 class="text-lg font-semibold">View Patients</h3>
                        </a>
                    </div>
                    <div class="transform transition duration-300 hover:scale-105">
                        <a href="views/view_appointments.php" class="block bg-red-500 text-white rounded-lg p-6 text-center hover:bg-red-600 shadow-md">
                            <i class="fas fa-calendar-alt text-3xl mb-2"></i>
                            <h3 class="text-lg font-semibold">View Appointments</h3>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="rounded-full bg-blue-100 p-4 mr-4">
                            <i class="fas fa-user text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Patients</h3>
                            <p class="text-2xl font-bold"><?= $patientCount ?></p>
                        </div>
                        <div class="ml-auto">
                            <a href="views/add_patient.php" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="rounded-full bg-green-100 p-4 mr-4">
                            <i class="fas fa-user-md text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Doctors</h3>
                            <p class="text-2xl font-bold"><?= $doctorCount ?></p>
                        </div>
                        <div class="ml-auto">
                            <a href="views/add_doctor.php" class="text-green-500 hover:text-green-700">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="rounded-full bg-indigo-100 p-4 mr-4">
                            <i class="fas fa-hospital text-indigo-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Departments</h3>
                            <p class="text-2xl font-bold"><?= $deptCount ?></p>
                        </div>
                        <div class="ml-auto">
                            <a href="views/add_department.php" class="text-indigo-500 hover:text-indigo-700">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="rounded-full bg-purple-100 p-4 mr-4">
                            <i class="fas fa-calendar-alt text-purple-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Appointments</h3>
                            <p class="text-2xl font-bold"><?= $appointmentCount ?></p>
                        </div>
                        <div class="ml-auto">
                            <a href="views/schedule_appointment.php" class="text-purple-500 hover:text-purple-700">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile sidebar toggle script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.w-64');
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>