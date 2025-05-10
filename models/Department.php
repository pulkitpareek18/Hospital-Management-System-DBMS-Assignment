<?php
require_once __DIR__ . '/../config/db.php';

class Department {
    public static function add($name) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO departments (name) VALUES (?)");
        $stmt->execute([$name]);
        return $pdo->lastInsertId();
    }

    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM departments ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM departments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $name) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE departments SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM departments WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>