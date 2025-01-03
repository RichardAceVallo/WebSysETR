<?php
require_once('config.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
        $message = trim($_POST['message']);
        $stmt = $pdo->prepare("INSERT INTO messages (sender, message) VALUES ('Client', ?)");
        $stmt->execute([$message]);

        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
