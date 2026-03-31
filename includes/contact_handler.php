<?php
require_once 'db.php';

// Response header
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $service = $_POST['service'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $email, $phone, $service, $message])) {
                echo json_encode(['status' => 'success', 'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save message. Please try again.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields (Name, Email, Message).']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
