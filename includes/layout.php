<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Hospital Management System' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white py-6 px-4 fixed h-full">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">HMS</h1>
                <p class="text-sm text-blue-200">Hospital Management</p>
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="<?= $basePath ?>index.php" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 <?= $activePage === 'dashboard' ? 'bg-blue-700' : '' ?>">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?= $basePath ?>views/view_patients.php" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 <?= $activePage === 'patients' ? 'bg-blue-700' : '' ?>">
                            <i class="fas fa-user mr-3"></i> Patients
                        </a>
                    </li>
                    <li>
                        <a href="<?= $basePath ?>views/view_doctors.php" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 <?= $activePage === 'doctors' ? 'bg-blue-700' : '' ?>">
                            <i class="fas fa-user-md mr-3"></i> Doctors
                        </a>
                    </li>
                    <li>
                        <a href="<?= $basePath ?>views/view_departments.php" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 <?= $activePage === 'departments' ? 'bg-blue-700' : '' ?>">
                            <i class="fas fa-hospital mr-3"></i> Departments
                        </a>
                    </li>
                    <li>
                        <a href="<?= $basePath ?>views/view_appointments.php" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 <?= $activePage === 'appointments' ? 'bg-blue-700' : '' ?>">
                            <i class="fas fa-calendar-alt mr-3"></i> Appointments
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 w-full">
            <!-- Top bar -->
            <div class="bg-white p-4 shadow-md flex justify-between items-center">
                <h2 class="text-xl font-semibold"><?= $pageTitle ?? 'Dashboard' ?></h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Administrator</span>
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="p-6">
                <?= $pageContent ?>
            </div>
        </div>
    </div>
</body>
</html>