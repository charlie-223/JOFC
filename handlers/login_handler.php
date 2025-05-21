<?php
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(['success' => true, 'redirect' => 'dashboard.html']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid email or password']);
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Login failed']);
    }
}
?>
