<?php
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $category = $_POST['category'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO events (title, description, event_date, start_time, end_time, category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $event_date, $start_time, $end_time, $category]);
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date");
        $events = $stmt->fetchAll();
        echo json_encode(['success' => true, 'events' => $events]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
