<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php'; // Ensure the user is logged in

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_id'])) {
    $user_id = $_SESSION['user_id'];
    $place_id = $_POST['place_id'];

    try {
        // Prevent duplicate entries
        $checkStmt = $pdo->prepare("SELECT * FROM mytrip WHERE UserId = ? AND PlaceId = ?");
        $checkStmt->execute([$user_id, $place_id]);

        if ($checkStmt->rowCount() == 0) { // If no existing trip, insert it
            $stmt = $pdo->prepare("INSERT INTO mytrip (UserId, PlaceId, DateOfVisit) VALUES (?, ?, CURDATE())");
            $stmt->execute([$user_id, $place_id]);

            // Redirect to index.php with success message
            header("Location: ../index.php?added=1");
        } else {
            // Redirect with already added message
            header("Location: /index.php?exists=1");
        }
    } catch (PDOException $e) {
        // Redirect with error message
        header("Location: /index.php?error=1");
    }
    exit();
} else {
    // Redirect if accessed directly
    header("Location: ../index.php");
    exit();
}
