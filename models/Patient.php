<?php
require_once __DIR__ . '/../config/db.php';

class Patient {
    public static function add($name, $age, $gender, $contact) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO patients (name, age, gender, contact) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $age, $gender, $contact]);
        return $pdo->lastInsertId();
    }

    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM patients ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $name, $age, $gender, $contact) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE patients SET name = ?, age = ?, gender = ?, contact = ? WHERE id = ?");
        $stmt->execute([$name, $age, $gender, $contact, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>