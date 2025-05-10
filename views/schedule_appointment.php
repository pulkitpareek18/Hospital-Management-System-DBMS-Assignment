<?php
require_once '../includes/helpers.php';
require_once '../models/Appointment.php';
require_once '../models/Patient.php';
require_once '../models/Doctor.php';

$activePage = 'appointments';
$basePath = getBasePath();
$pageTitle = 'Schedule Appointment';

$patients = Patient::all();
$doctors = Doctor::all();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Appointment::schedule($_POST['patient_id'], $_POST['doctor_id'], $_POST['appointment_date'], $_POST['reason']);
    $message = showAlert("Appointment scheduled successfully!");
}

ob_start();
?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-purple-600 mb-6">Schedule New Appointment</h1>
    
    <?= $message ?>
    
    <form method="post" class="space-y-4">
        <div>
            <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
            <select id="patient_id" name="patient_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">-- Select Patient --</option>
                <?php foreach ($patients as $patient): ?>
                <option value="<?= $patient['id'] ?>"><?= $patient['name'] ?> (<?= $patient['age'] ?> yrs)</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
            <select id="doctor_id" name="doctor_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">-- Select Doctor --</option>
                <?php foreach ($doctors as $doctor): ?>
                <option value="<?= $doctor['id'] ?>"><?= $doctor['name'] ?> (<?= $doctor['specialization'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-1">Appointment Date</label>
            <input type="date" id="appointment_date" name="appointment_date" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        
        <div>
            <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Reason for Visit</label>
            <textarea id="reason" name="reason" placeholder="Describe reason for appointment" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 h-24"></textarea>
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="bg-purple-500 text-white py-2 px-6 rounded-md hover:bg-purple-600 transition duration-300">
                Schedule Appointment
            </button>
            <a href="view_appointments.php" class="bg-gray-300 text-gray-700 py-2 px-6 rounded-md hover:bg-gray-400 transition duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php
$pageContent = ob_get_clean();
require_once '../includes/layout.php';
?>