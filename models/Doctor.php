<?php
require_once __DIR__ . '/../config/db.php';

class Doctor {
    public static function add($name, $specialization, $department_id) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO doctors (name, specialization, department_id) VALUES (?, ?, ?)");
        $stmt->execute([$name, $specialization, $department_id]);
        return $pdo->lastInsertId();
    }

    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT d.*, dept.name as department FROM doctors d 
                            LEFT JOIN departments dept ON d.department_id = dept.id
                            ORDER BY d.name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT d.*, dept.name as department FROM doctors d 
                              LEFT JOIN departments dept ON d.department_id = dept.id
                              WHERE d.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $name, $specialization, $department_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE doctors SET name = ?, specialization = ?, department_id = ? WHERE id = ?");
        $stmt->execute([$name, $specialization, $department_id, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM doctors WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>