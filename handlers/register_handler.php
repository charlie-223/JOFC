<?php
header('Content-Type: application/json');
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['success' => false, 'error' => 'Email already exists']);
            exit;
        }

        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, $password]);

        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
