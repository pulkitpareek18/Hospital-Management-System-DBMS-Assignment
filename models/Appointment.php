<?php
require_once __DIR__ . '/../config/db.php';

class Appointment {
    public static function schedule($patient_id, $doctor_id, $date, $reason) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, reason) VALUES (?, ?, ?, ?)");
        $stmt->execute([$patient_id, $doctor_id, $date, $reason]);
    }

    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT a.*, p.name as patient_name, d.name as doctor_name 
                             FROM appointments a
                             JOIN patients p ON a.patient_id = p.id
                             LEFT JOIN doctors d ON a.doctor_id = d.id
                             ORDER BY a.appointment_date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRecent($limit) {
        $db = self::getDB();
        $stmt = $db->prepare("
            SELECT a.*, p.name as patient_name, d.name as doctor_name 
            FROM appointments a
            JOIN patients p ON a.patient_id = p.id
            JOIN doctors d ON a.doctor_id = d.id
            ORDER BY a.appointment_date DESC
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT a.*, p.name as patient_name, d.name as doctor_name 
                              FROM appointments a
                              JOIN patients p ON a.patient_id = p.id
                              LEFT JOIN doctors d ON a.doctor_id = d.id
                              WHERE a.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $patient_id, $doctor_id, $date, $reason) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE appointments SET patient_id = ?, doctor_id = ?, appointment_date = ?, reason = ? WHERE id = ?");
        $stmt->execute([$patient_id, $doctor_id, $date, $reason, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>